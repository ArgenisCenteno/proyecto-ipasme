<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // Especificar los atributos que son asignables en masa
    protected $fillable = ['nombre', 'estado'];
 
    public static function activos()
    {
        return self::where('estado', true)->get();
    }
}
