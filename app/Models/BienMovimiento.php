<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BienMovimiento extends Model
{
    use HasFactory;

    protected $table = 'bien_movimientos';

    protected $fillable = [
        'bien_id',
        'movimiento_id',
        'cantidad',
    ];

    // Relaciones
    public function bien()
    {
        return $this->belongsTo(Bien::class, 'bien_id');
    }

    public function movimiento()
    {
        return $this->belongsTo(Movimiento::class, 'movimiento_id');
    }
}
