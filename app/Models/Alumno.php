<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'nivel',
        'es_becado'

    ];

    public function clases(): HasMany
    {
        return $this->hasMany(Clase::class);
    }
}
