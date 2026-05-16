<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clase extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_idioma', 'horario', 'dia_semana', 'profesor_id', 'alumno_id'];

    //relaciones
    public function profesor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'profesor_id');
    }

    public function alumno(): BelongsTo
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    public function pago(): HasMany
    {
        return $this->hasMany(Pago::class);
    }
}
