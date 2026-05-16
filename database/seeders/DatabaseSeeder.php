<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Alumno;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Seeder Principal (DatabaseSeeder): Configúralo para que realice lo siguiente:

     *Un Administrador fijo: Crea un usuario con login admin, password admin (recuerda usar Hash::make), DNI 12345678A y rol admin. Esto es vital para que siempre puedas entrar al sistema.

     *3 Profesores: Crea 3 usuarios con datos aleatorios pero asegúrate de que el campo rol sea profesor.

     *15 Alumnos: Usa la Factory que creaste en el paso anterior para insertar 15 alumnos de golpe.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // 1. Crear el Administrador fijo
        User::create([
            'login' => 'admin',
            'nombre' => 'Admin',
            'apellidos' => 'Academia',
            'dni' => '12345678A',
            'password' => Hash::make('admin'),
            'rol' => 'admin',
        ]);
        // 2. Crear 3 Profesores usando un bucle (o Factory si la has adaptado) SP
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'login' => "profe$i",
                'nombre' => "Profesor $i",
                'apellidos' => "Apellido $i",
                'dni' => "0000000{$i}B",
                'password' => Hash::make('1234'),
                'rol' => 'profesor',
            ]);
        }

        /*PARA ESTE HAY Q HACER EL SUER FACTORY  */
        // User::factory()
        //     ->count(3)
        //     ->sequence(fn($sequence) => [
        //         'login' => 'profe' . ($sequence->index + 1),
        //         'nombre' => 'Profesor ' . ($sequence->index + 1),
        //         'apellidos' => 'Apellido ' . ($sequence->index + 1),
        //         'dni' => '0000000' . ($sequence->index + 1) . 'B',
        //     ])
        //     ->create([
        //         'password' => Hash::make('1234'),
        //         'rol' => 'profesor',
        //     ]);


        //usuarios factoria
        Alumno::factory(15)->create();
    }
}
