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
            return redirect()->route('inicio'); // Redirige a tu ruta
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
        return redirect('/login');
    }
}
