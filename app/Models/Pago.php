<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = ['clase_id', 'fecha_pago', 'importe'];


    //realaciones

    public function clase(): BelongsTo
    {
        return $this->belongsTo(Clase::class, 'clase_id');
    }
}
