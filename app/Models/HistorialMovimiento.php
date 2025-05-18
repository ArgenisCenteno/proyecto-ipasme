<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMovimiento extends Model
{
    use HasFactory;

    protected $table = 'historial_movimientos';

    protected $fillable = [
        'ente_origen_id',
        'ente_destino_id',
        'departamento_origen_id',
        'departamento_destino_id',
        'bien_id',
        'bien_asignado_id',
        'tipo',
        'codigo_inventario'
    ];

    // Relaciones

    public function enteOrigen()
    {
        return $this->belongsTo(Ente::class, 'ente_origen_id');
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

    public function bien()
    {
        return $this->belongsTo(Bien::class);
    }

    public function bienAsignado()
    {
        return $this->belongsTo(BienAsignado::class);
    }
}
