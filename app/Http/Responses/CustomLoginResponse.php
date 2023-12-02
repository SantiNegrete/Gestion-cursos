<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class CustomLoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            // Redirigir al admin a su dashboard
            return redirect('/dash');
        } elseif ($user->hasRole('Docente')) {
            // Redirigir al docente a su página específica
            return redirect('/docente/mis-asignaturas');
        }

        // Redirección predeterminada
        return redirect('/ruta-predeterminada');
    }
}
