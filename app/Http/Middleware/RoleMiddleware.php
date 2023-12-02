<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  El rol necesario para acceder a la ruta
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Comprobar si el usuario está autenticado y tiene el rol requerido
        if (!Auth::check() || !Auth::user()->hasRole($role)) {
            // Aquí puedes personalizar la respuesta en caso de que el usuario no tenga el rol requerido.
            // Por ejemplo, podrías redirigir al usuario a la página de inicio o mostrar un mensaje de error.
            return redirect('/'); // Redirige a la página de inicio o a donde prefieras
        }

        return $next($request);
    }
}
