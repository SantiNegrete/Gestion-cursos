<?php

namespace App\Http\Controllers;

use App\Models\CriteriosEvaluacion;
use Illuminate\Http\Request;

class CriteriosEvaluacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $criteriosEvaluacions = CriteriosEvaluacion::paginate();

        return view('criterios.index', compact('criteriosEvaluacions'))
            ->with('i', (request()->input('page', 1) - 1) * $criteriosEvaluacions->perPage());
    }

    public function create()
    {
        $criteriosEvaluacion = new CriteriosEvaluacion();
        return view('criterios.create', compact('criteriosEvaluacion'));
    }

    public function store(Request $request)
    {
        request()->validate(CriteriosEvaluacion::$rules);

        $criteriosEvaluacion = CriteriosEvaluacion::create($request->all());

        return redirect()->route('criterios.index')
            ->with('success', 'Criterios de Evaluación creados exitosamente.');
    }

    public function show($id)
    {
        $criteriosEvaluacion = CriteriosEvaluacion::find($id);

        return view('criterios.show', compact('criteriosEvaluacion'));
    }

    public function edit($id)
    {
        $criteriosEvaluacion = CriteriosEvaluacion::find($id);

        return view('criterios.edit', compact('criteriosEvaluacion'));
    }

    public function update(Request $request, CriteriosEvaluacion $criteriosEvaluacion)
    {
        request()->validate(CriteriosEvaluacion::$rules);

        $criteriosEvaluacion->update($request->all());

        return redirect()->route('criterios.index')
            ->with('success', 'Criterios de Evaluación actualizados con éxito');
    }

    public function destroy($id)
    {
        $criteriosEvaluacion = CriteriosEvaluacion::find($id)->delete();

        return redirect()->route('criterios.index')
            ->with('success', 'Criterios de Evaluación eliminados con éxito');
    }
}
