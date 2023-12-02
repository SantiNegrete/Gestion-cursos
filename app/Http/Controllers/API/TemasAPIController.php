<?php

namespace App\Http\Controllers\API;

use App\Models\Tema;
use App\Models\Unidade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemasAPIController extends Controller
{
  

    public function index($unidadId)
    {
        $unidad = Unidade::find($unidadId);
        if (!$unidad) {
            return response()->json(['message' => 'Unidad no encontrada'], 404);
        }

        $temas = Tema::where('id_unidad', $unidadId)->get();
        return response()->json($temas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_unidad' => 'required|exists:unidades,id',
            'nombre' => 'required|string',
            'practica_id' => 'required|exists:practicas,id',
            'calendario_id' => 'required|exists:calendarios,id',
            'instrumentacion_id' => 'required|exists:instrumentaciones,id',
        ]);

        $tema = Tema::create($request->all());

        return response()->json($tema, 201);
    }

    public function show($id)
    {
        $tema = Tema::find($id);
        if (!$tema) {
            return response()->json(['message' => 'Tema no encontrado'], 404);
        }

        return response()->json($tema);
    }

    public function update(Request $request, $id)
    {
        $tema = Tema::find($id);
        if (!$tema) {
            return response()->json(['message' => 'Tema no encontrado'], 404);
        }

        $request->validate([
            'id_unidad' => 'required|exists:unidades,id',
            'nombre' => 'required|string',
            'practica_id' => 'required|exists:practicas,id',
            'calendario_id' => 'required|exists:calendarios,id',
            'instrumentacion_id' => 'required|exists:instrumentaciones,id',
        ]);

        $tema->update($request->all());

        return response()->json($tema);
    }

    public function destroy($id)
    {
        $tema = Tema::find($id);
        if (!$tema) {
            return response()->json(['message' => 'Tema no encontrado'], 404);
        }

        $tema->delete();
        return response()->json(['message' => 'Tema eliminado con éxito']);
    }
}