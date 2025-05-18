<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFormulacion extends Model
{
    protected $table = 'detalles_formulacion';

    protected $fillable = ['formulacion_id', 'partida_id', 'ente_id', 'presupuesto', 'otros'];

    public function formulacion() {
        return $this->belongsTo(Formulacion::class);
    }

    public function partida() {
        return $this->belongsTo(Partida::class);
    }

    public function ente() {
        return $this->belongsTo(Ente::class);
    }
}
