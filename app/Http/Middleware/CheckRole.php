<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // El operador ... (splat/variadic) captura los parámetros extra separados por coma
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Verifica si el usuario está autenticado y si su rol está dentro del array de roles permitidos
        if (!Auth::check() || !in_array(Auth::user()->rol, $roles)) {
            return redirect('/')->withErrors(['errors' => 'No tiene permisos']);
        }

        return $next($request);
    }
}
