<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    protected $table = 'partidas';
    protected $fillable = [
        'nombre_partida_id', 'codigo_partida_id', 'descripcion', 'estatus',
        'fondo_en_avance', 'fondo_en_anticipo', 'orden_de_pago',
        'fecha', 'slug', 'nivel', 'cash'
    ];

    public function nombrePartida() {
        return $this->belongsTo(CodigoPartida::class, 'nombre_partida_id');
    }

    public function codigoPartida() {
        return $this->belongsTo(CodigoPartida::class, 'codigo_partida_id');
    }

    public function formulaciones() {
        return $this->hasMany(DetalleFormulacion::class);
    }
}
