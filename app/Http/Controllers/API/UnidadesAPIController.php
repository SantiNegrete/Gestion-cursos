<?php

namespace App\Http\Controllers\API;

use App\Models\Unidade;
use App\Models\Asignatura;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;

class UnidadesAPIController extends Controller
{
  

    public function index()
    {
        return response()->json([
            'unidades' => Unidade::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'asignatura_id' => 'required|exists:asignaturas,id',
            'nombre' => 'required|string',
            'objetivo' => 'required|string',
        ]);

        try {
            $unidade = Unidade::create($request->all());
            return response()->json($unidade, 201);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error al crear la unidad'], 400);
        }
    }

    public function show($id)
    {
        $unidade = Unidade::find($id);
        if (!$unidade) {
            return response()->json(['message' => 'Unidad no encontrada'], 404);
        }
        return response()->json($unidade);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'objetivo' => 'required|string',
            'asignatura_id' => 'required|exists:asignaturas,id',
        ]);

        $unidade = Unidade::find($id);
        if (!$unidade) {
            return response()->json(['message' => 'Unidad no encontrada'], 404);
        }

        try {
            $unidade->update($request->all());
            return response()->json($unidade);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error al actualizar la unidad'], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $unidade = Unidade::find($id);
            if (!$unidade) {
                return response()->json(['message' => 'Unidad no encontrada'], 404);
            }
            $unidade->delete();
            return response()->json(['message' => 'Unidad eliminada con éxito']);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error al eliminar la unidad'], 400);
        }
    }
}