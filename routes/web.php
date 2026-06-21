<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\LoginControllerForm;
// Eliminar import no usado de ProfesorController
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Rutas públicas (Huéspedes)
Route::get('/', [LoginControllerForm::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginControllerForm::class, 'login'])->name('login.post');

// Rutas privadas (Autenticados)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginControllerForm::class, 'logout'])->name('logout');

    // Rutas compartidas (Profesor y Admin)
    Route::middleware('role:admin,profesor')->group(function () {
        // Solo extraemos el index, que ambos pueden ver
        Route::get('/alumnos', [AlumnoController::class, 'index'])->name('alumnos.index');
    });

    // Rutas exclusivas para administradores
    Route::middleware('role:admin')->group(function () {
        // Excluimos el 'index' para no duplicar la URI ni el nombre de ruta
        Route::resource('alumnos', AlumnoController::class)->except(['index']);
    });
});
