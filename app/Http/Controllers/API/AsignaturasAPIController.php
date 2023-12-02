<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asignatura;
use Illuminate\Http\Request;

class AsignaturasAPIController extends Controller
{
    
 

    public function index()
    {
        return response()->json([
            'asignaturas' => Asignatura::all()
        ]);
        
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(Asignatura::$rules);
        $asignatura = Asignatura::create($validatedData);
        return response()->json($asignatura, 201);
    }

    public function show($id)
    {
        $asignatura = Asignatura::find($id);
        if (!$asignatura) {
            return response()->json(['message' => 'Asignatura no encontrada'], 404);
        }
        return response()->json($asignatura);
    }

    public function update(Request $request, $id)
    {
        $asignatura = Asignatura::find($id);
        $validatedData = $request->validate(Asignatura::$rules);
        $asignatura->update($validatedData);
        return response()->json($asignatura);
    }

    public function destroy($id)
    {
        $asignatura = Asignatura::find($id);
        if (!$asignatura) {
            return response()->json(['message' => 'Asignatura no encontrada'], 404);
        }
        $asignatura->delete();
        return response()->json(['message' => 'Asignatura eliminada con éxito']);
    }
}

