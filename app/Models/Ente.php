<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Ente extends Model
{ 
    protected $fillable = ['nombre', 'descripcion', 'direccion', 'telefono', 'rif', 'encargado', 'correo', 'estado'];

    public function partidas() {
        return $this->hasMany(Partida::class);
    }

    public function formulaciones() {
        return $this->hasMany(Formulacion::class);
    }

    public function modificaciones() {
        return $this->hasMany(Modificacion::class);
    }
}

