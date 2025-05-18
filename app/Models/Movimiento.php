<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $table = 'movimientos';

    protected $fillable = [
        'tipo',
        'descripcion',
        'fecha',
        'factura',
        'monto',
        'ente_origen_id',
        'ente_destino_id',
        'departamento_origen_id',
        'departamento_destino_id',
        'observaciones',
        'proveedor_id',
        'user_id',
    ];

    // Casts para tipos de datos
    protected $casts = [
        'fecha' => 'date',
        'monto' => 'decimal:2',
    ];

    // Relaciones (opcional, depende de tu estructura)
    public function enteOrigen()
    {
        return $this->belongsTo(Ente::class, 'ente_origen_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function enteDestino()
    {
        return $this->belongsTo(Ente::class, 'ente_destino_id');
    }

    public function departamentoOrigen()
    {
        return $this->belongsTo(Departamento::class, 'departamento_origen_id');
    }

    public function departamentoDestino()
    {
        return $this->belongsTo(Departamento::class, 'departamento_destino_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function bienesMovimientos()
    {
        return $this->hasMany(BienMovimiento::class, 'movimiento_id');
    }
}
