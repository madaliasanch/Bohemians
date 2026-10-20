<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado y si es administrador
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request);
        }

        // Si no es administrador, redirigir al inicio con mensaje
        return redirect()->route('home')->with('error', 'No tienes permisos de administrador.');
    }
}