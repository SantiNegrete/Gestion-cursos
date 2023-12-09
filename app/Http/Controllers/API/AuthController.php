<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller; // Agrega la importación del controlador base
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Usuario;
use \stdClass;

class AuthController extends Controller {


    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
    
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'No autorizado'], 401);
        }
    
        $usuario = Usuario::where('email', $request->input('email'))->firstOrFail();
        $token = $usuario->createToken('auth_token')->plainTextToken;



        if ($usuario->hasRole('Docente')) {
            return response()->json([
                'message' => '¡Hola, ' . $usuario->name . '!',
                'token' => $token,
            ]);
        }
        else{
            return response()->json(['message' => 'No autorizado para acceder'], 403);

        }
    
       
    }

    
}
