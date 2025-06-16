<?php

namespace App\Exports;

use App\Models\BienAsignado;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BienesPorDepartamentoExport implements FromView
{
    protected $enteId;
    protected $departamentoId;

    public function __construct($enteId, $departamentoId)
    {
        $this->enteId = $enteId;
        $this->departamentoId = $departamentoId;
    }

    public function view(): View
    {
        $bienes = BienAsignado::with(['bien', 'bien.categoria', 'movimiento', 'departamento', 'ente'])
            ->whereNotIn('estado', ['Inactivo', 'Descartado'])
            ->where('ente_id', $this->enteId)
            ->where('departamento_id', $this->departamentoId)
            ->get();

        return view('exports.bienes', [
            'bienes' => $bienes,
        ]);
    }
}
