<?php
namespace App\Exports;

use App\Models\Movimiento;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SalidasPorFechaExport implements FromView
{
    protected $desde;
    protected $hasta;
    protected $ente;
    protected $departamento;

    public function __construct($desde, $hasta, $ente, $departamento)
    {
        $this->desde = $desde;
        $this->hasta = $hasta;
        $this->ente = $ente;
        $this->departamento = $departamento;
    }

    public function view(): View
    {
        $datos = Movimiento::with(['enteOrigen', 'enteDestino', 'departamentoOrigen', 'departamentoDestino', 'user'])
            ->where('tipo', 'SALIDA')
            ->whereBetween('fecha', [$this->desde, $this->hasta])
            ->where('departamento_origen_id', $this->departamento)
            ->where('ente_origen_id', $this->ente)
            ->get()
            ->map(function ($movimiento) {
                return [
                    'Fecha' => $movimiento->fecha->format('Y-m-d'),
                    'Descripción' => $movimiento->descripcion,
                    'Monto' => $movimiento->monto,
                    'Ente Origen' => optional($movimiento->enteOrigen)->nombre,
                    'Ente Destino' => optional($movimiento->enteDestino)->nombre,
                    'Departamento Origen' => optional($movimiento->departamentoOrigen)->nombre,
                    'Departamento Destino' => optional($movimiento->departamentoDestino)->nombre,
                    'Usuario' => optional($movimiento->user)->name,
                ];
            });

        return view('exports.salidas', compact('datos'));
    }
}
