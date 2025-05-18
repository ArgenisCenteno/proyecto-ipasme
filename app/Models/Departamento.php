<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'encargado',
        'estado',
        'ente_id',
    ];

    /**
     * Relación: un departamento pertenece a un ente.
     */
    public function ente()
    {
        return $this->belongsTo(Ente::class);
    }
}
