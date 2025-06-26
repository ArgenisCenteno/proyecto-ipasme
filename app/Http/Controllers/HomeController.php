<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\BienAsignado;
use App\Models\Departamento;
use App\Models\Movimiento;
use Carbon\Carbon;
use DB;
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
$stockMinimo = 5;

$bienesBajoStock = BienAsignado::where('cantidad', '<', 5)->get();
       



        return view('home', compact( 'bienesBajoStock','descartados', 'meses', 'desaparecidos', 'entradas', 'salidas', 'departamentos', 'bienes'));
    }
}
