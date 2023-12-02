<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthAPIController extends Controller
{
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6|max:18'
        ]);
        if($validator->fails()) {
            return response()->json([
                'message' => 'Se requiere el correo y una contraseña    '
            ], 401);
        }
        $validated = $validator->validated();

        if (Auth::attempt($validated)) {
            return response()->json([
                'token' => $request->user()->createToken('Acceso')->plainTextToken
            ]);
        } else {
            return response()->json([
                'message' => 'Acceso denegado'
            ], 401);
        }
    }
}
