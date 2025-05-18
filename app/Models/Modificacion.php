<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modificacion extends Model
{
    protected $fillable = ['ente_id', 'partida_id', 'monto', 'tipo'];

    public function ente() {
        return $this->belongsTo(Ente::class);
    }

    public function partida() {
        return $this->belongsTo(Partida::class);
    }
}
