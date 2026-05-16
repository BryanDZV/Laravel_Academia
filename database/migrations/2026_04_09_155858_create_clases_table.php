<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Necesitamos: nombre_idioma, horario (time), dia_semana (string), y dos claves foráneas:

     *profesor_id (apunta a users). Si se borra el profesor, se borra la clase (onDelete cascade).

     *alumno_id (apunta a alumnos). Si se borra el alumno, se borra la clase.
     */
    public function up(): void
    {
        Schema::create('clases', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_idioma');
            $table->time('horario');
            $table->string('dia_semana');
            // Relaciones
            $table->foreignId('profesor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('alumno_id')->constrained('alumnos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clases');
    }
};
