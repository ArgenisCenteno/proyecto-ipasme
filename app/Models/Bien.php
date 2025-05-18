<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    use HasFactory;

    // Definir la tabla asociada
    protected $table = 'bienes';

    // Definir los campos que pueden ser llenados de forma masiva
    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria_id',
        'codigo_inventario',
        'inventario_inicial',
        'departamento_id',
        'estado',
        'fecha_adquisicion',
        'proveedor',
        'unidad_medida',
    ];

    // Definir relaciones con otras tablas (modelo Categoria y Departamento)
    
    // Relación con la tabla categorias
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    // Relación con la tabla departamentos
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    // Si deseas tener un atributo 'inventario' como el total de bienes disponibles
    /*public function getInventarioDisponibleAttribute()
    {
        // Supongamos que tenemos un campo 'inventario_final' que actualiza el inventario disponible
        return $this->inventario_inicial - $this->registrosDeSalida()->sum('cantidad');
    }*/

}
