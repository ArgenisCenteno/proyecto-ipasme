<?php

namespace App\Http\Controllers;

use App\Models\BienAsignado;
use App\Models\HistorialMovimiento;
use App\Models\Movimiento;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function pdfBienInventario($id)
    {
        $bien = BienAsignado::with('bien', 'movimientos')->find($id);
        $movimientos = HistorialMovimiento::where('codigo_inventario', $bien->codigo_inventario)->orderBy('id', 'DESC')->get();
        $movimiento = Movimiento::find($bien->movimiento_id);

       // dd($movimientos->where('tipo', 'ENTRADA')->first());
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('bienes.pdf', compact('bien', 'movimientos', 'movimiento'));
        return $pdf->stream('bien.pdf');
    }
}
