<?php
namespace App\Exports;

use App\Models\Movimiento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class EntradasPorFechaExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $desde;
    protected $hasta;

    public function __construct($desde, $hasta, $ente, $departamento)
    {
        $this->desde = $desde;
        $this->hasta = $hasta;
        $this->ente = $ente;
        $this->departamento = $departamento;
    }

    public function collection()
    {
        return Movimiento::with(['enteOrigen', 'enteDestino', 'departamentoOrigen', 'departamentoDestino', 'user'])
            ->where('tipo', 'ENTRADA')
            ->whereBetween('fecha', [$this->desde, $this->hasta])
            ->where('departamento_destino_id', $this->departamento)
            ->where('ente_destino_id', $this->ente)
            ->get()
            ->map(function ($movimiento) {
               // dd($movimiento);
                return [
                    'Fecha' => $movimiento->fecha->format('Y-m-d'),
                    'Descripción' => $movimiento->descripcion,
                    'Factura' => $movimiento->factura,
                    'Monto' => $movimiento->monto,
                    'Ente' => optional($movimiento->enteDestino)->nombre,
                    'Departamento' => optional($movimiento->departamentoDestino)->nombre,
                    'Usuario' => optional($movimiento->user)->name,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Fecha',
            'Descripción',
            'Factura',
            'Monto',
            'Ente',
            'Departamento',
            'Usuario',
        ];
    }
}
