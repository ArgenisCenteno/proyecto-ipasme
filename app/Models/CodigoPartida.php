<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodigoPartida extends Model
{
    protected $table = 'codigos_partidas';
    protected $fillable = ['codigo', 'nombre', 'status'];

    public function partidas() {
        return $this->hasMany(Partida::class, 'codigo_partida_id');
    }
}
