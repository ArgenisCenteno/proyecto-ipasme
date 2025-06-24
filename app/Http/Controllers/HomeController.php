<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\BienAsignado;
use App\Models\Departamento;
use App\Models\Movimiento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $entradas = Movimiento::where('tipo', 'ENTRADA')->count();
        $salidas = Movimiento::where('tipo', 'SALIDA')->count();
        $departamentos = Departamento::count();
        $bienes = BienAsignado::where('estado', 'activo')->count();
        $año = Carbon::now()->year;

        // Obtener entradas por mes del año actual
        $entradasPorMes = Movimiento::selectRaw('MONTH(fecha) as mes, COUNT(*) as total')
            ->whereYear('fecha', $año)
            ->where('tipo', 'ENTRADA')
            ->groupBy('mes')
            ->pluck('total', 'mes');

        // Obtener salidas por mes del año actual
        $salidasPorMes = Movimiento::selectRaw('MONTH(fecha) as mes, COUNT(*) as total')
            ->whereYear('fecha', $año)
            ->where('tipo', 'SALIDA')
            ->groupBy('mes')
            ->pluck('total', 'mes');

        // Construir estructura mensual
        $meses = collect(range(1, 12))->map(function ($mes) use ($entradasPorMes, $salidasPorMes) {
            return [
                'mes' => $mes,
                'entradas' => $entradasPorMes[$mes] ?? 0,
                'salidas' => $salidasPorMes[$mes] ?? 0,
            ];
        });

        $desaparecidos = BienAsignado::where('estado', 'desaparecido')->count();
        $descartados = BienAsignado::where('estado', 'descartado')->count();

       $stockMinimo = 5;
$departamentoId = 16; // El almacén que quieres evaluar

// Obtienes todos los bienes asignados a ese departamento que están activos
$asignados = BienAsignado::where('departamento_id', $departamentoId)
    ->where('estado', 'activo') // o el valor que indique activo
    ->get();

// Agrupas por bien_id para sumar cantidades
$stockPorBien = $asignados->groupBy('bien_id')->map(function ($items, $bienId) {
    return $items->sum('cantidad');
});

$alertas = [];

foreach ($stockPorBien as $bienId => $cantidadDisponible) {
    if ($cantidadDisponible <= $stockMinimo) {
        $bien = Bien::find($bienId);
        $alertas[] = [
            'bien' => $bien->nombre,
            'disponible' => $cantidadDisponible,
            'mensaje' => "Quedan solo {$cantidadDisponible} unidades de {$bien->nombre} en almacén, es necesario reponer.",
        ];
    }
}

        // Paginar el array $alertas
        $page = request()->get('page', 1);
        $perPage = 5; // Items por página, ajusta aquí

        $collection = collect($alertas);

        $currentPageItems = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        $paginatedAlertas = new LengthAwarePaginator(
            $currentPageItems,
            $collection->count(),
            $perPage,
            $page,
            ['path' => request()->url()
            , 'query' => request()->query()]
        );



        return view('home', compact('paginatedAlertas', 'descartados', 'meses', 'desaparecidos', 'entradas', 'salidas', 'departamentos', 'bienes'));
    }
}
