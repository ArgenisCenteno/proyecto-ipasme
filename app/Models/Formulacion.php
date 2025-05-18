<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulacion extends Model
{
    protected $fillable = ['inicio', 'fin', 'estado', 'creado_por', 'ente_id'];

    public function ente() {
        return $this->belongsTo(Ente::class);
    }

    public function detalles() {
        return $this->hasMany(DetalleFormulacion::class);
    }
}
