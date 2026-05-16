<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumno>
 */
class AlumnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *Factory para Alumnos: Crea una Factory para el modelo Alumno.

     *Usa faker para generar: nombre, apellidos y email.

     *Para el campo nivel, haz que elija uno aleatorio entre: basico, intermedio, avanzado.

     *Para es_becado, que genere un valor booleano al azar.
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //rellenamos con requsitos
            'nombre' => fake()->firstName(),
            'apellidos' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'nivel' => fake()->randomElement(['basico', 'intermedio', 'avanzado']),
            'es_becado' => fake()->boolean(20), // 20% de probabilidades de ser becado


        ];
        /*es lo mismo otra convecion */
        //     return [
        //     'nombre'    => $this->faker->firstName(),
        //     'apellidos' => $this->faker->lastName(),
        //     'email'     => $this->faker->unique()->safeEmail(),
        //     'nivel'     => $this->faker->randomElement(['basico', 'intermedio', 'avanzado']),
        //     'es_becado' => $this->faker->boolean(20),
        // ];
    }
}
