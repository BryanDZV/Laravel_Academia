<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginControllerForm extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validar la entrada
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // 2. Intentar el login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Evita ataques de fijación de sesión
            //apunte la vista te redirige a una ruta segun el rol
            // el middleware protege las rutas
            //el flujo es se logean y cuando lo hace ya tiene un roll
            //entonces se le redirige a una ruta segun su roll y esa ruta tiene un middleware
            // que verifica el roll y le manda a donde corresponda y si no es el correcto lo redirige al login con error de permisos
            //redirecion a vistas por roll si las pidieran seria asr:
            // if (Auth::user()->rol === 'admin') {
            //     return redirect()->route('admin.dashboard'); // Redirige al dashboard de admin
            // } elseif (Auth::user()->rol === 'profesor') {
            //     return redirect()->route('profesor.dashboard'); // Redirige al dashboard de profesor
            // }


            return redirect()->route('alumnos.index'); // Redirige al listado de alumnos porque no esoty poniendo reireciones
        }

        // 3. Si falla, volver con error
        return back()->withErrors([
            'login' => 'Las credenciales no coinciden con nuestros registros.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
