<?php
namespace App\Exports;

use App\Models\Movimiento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalidasPorFechaExport implements FromCollection, WithHeadings, ShouldAutoSize
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

    public function collection()
    {
        return Movimiento::with(['enteOrigen', 'enteDestino', 'departamentoOrigen', 'departamentoDestino', 'user'])
            ->where('tipo', 'SALIDA')  // Cambiado a SALIDA
            ->whereBetween('fecha', [$this->desde, $this->hasta])
            ->where('departamento_origen_id', $this->departamento) // Suponiendo que salidas filtras por departamento origen
            ->where('ente_origen_id', $this->ente) // Suponiendo que salidas filtras por ente origen
            ->get()
            ->map(function ($movimiento) {
                return [
                    'Fecha' => $movimiento->fecha->format('Y-m-d'),
                    'Descripción' => $movimiento->descripcion,

                    'Monto' => $movimiento->monto,
                    'Ente Origen' => optional($movimiento->enteOrigen)->nombre, // Ente origen para salidas
                    'Ente Destino' => optional($movimiento->enteDestino)->nombre, // Ente origen para salidas
    
                    'Departamento Origen' => optional($movimiento->departamentoOrigen)->nombre, // Departamento origen para salidas
                    'Departamento Destino' => optional($movimiento->departamentoDestino)->nombre, // Ente origen para salidas
    
                    'Usuario' => optional($movimiento->user)->name,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Fecha',
            'Descripción',

            'Monto',
            'Ente Origen',
            'Ente Destino',
            'Departamento Origen',
            'Departamento Destino',

            'Usuario',
        ];
    }
}
