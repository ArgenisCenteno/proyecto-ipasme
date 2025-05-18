<?php
namespace App\Exports;

use App\Models\BienAsignado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BienesPorDepartamentoExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $enteId;
    protected $departamentoId;

    public function __construct($enteId, $departamentoId)
    {
        $this->enteId = $enteId;
        $this->departamentoId = $departamentoId;
    }

    public function collection()
    {
        return BienAsignado::with(['bien'])
            ->where('estado', '!=','Inactivo')
             ->where('estado', '!=','Descartado')
            ->where('ente_id', $this->enteId)
            ->where('departamento_id', $this->departamentoId)
            ->get()
            ->map(function ($item) {
                return [
                    'Código' => $item->codigo_inventario,
                    'Bien' => $item->bien->nombre ?? '',
                    'Categoría' => $item->bien->categoria->nombre ?? '',
                    'Adquisición' => $item->movimiento->fecha ?? '',
                    'Estado' => $item->estado,
                    'Departamento' => $item->departamento->nombre ?? '',
                    'Ente' => $item->ente->nombre ?? '',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Código',
            'Bien',
            'Categoría',
            'Adquisición',
            'Estado',
            'Departamento',
            'Ente',
        ];
    }
}
