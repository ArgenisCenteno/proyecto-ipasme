<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores'; // o 'proveedores' si esa es la tabla en la BD

    protected $fillable = [
        'razon_social',
        'rif',
        'direccion',
        'telefono',
        'email',
        'estado',
    ];
}
