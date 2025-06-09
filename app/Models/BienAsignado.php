<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BienAsignado extends Model
{
    use HasFactory;

    protected $table = 'bienes_asignados';

    protected $fillable = [
        'departamento_id',
        'ente_id',
        'bien_id',
        'movimiento_id',
        'cantidad',
        'estado',
        'fecha_adquisicion',
        'codigo_inventario',
        'serial'
    ];

    // Relaciones
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    public function ente()
    {
        return $this->belongsTo(Ente::class, 'ente_id');
    }

    public function bien()
    {
        return $this->belongsTo(Bien::class, 'bien_id');
    }

    public function movimiento()
    {
        return $this->belongsTo(Movimiento::class, 'movimiento_id');
    }

     public function movimientos()
    {
        return $this->hasMany(HistorialMovimiento::class, 'bien_asignado_id');
    }
}
