<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\LoginControllerForm;
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
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginControllerForm::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginControllerForm::class, 'login'])->name('login.post');
});

// Rutas privadas (Autenticados)
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('inicio');

    Route::post('/logout', [LoginControllerForm::class, 'logout'])->name('logout');

    //primer parametro plural del modelo, segundo parametro el controlador
    Route::resource('alumnos', AlumnoController::class);
});
