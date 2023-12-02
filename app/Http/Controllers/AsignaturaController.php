<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Calendario;
use App\Models\Instrumentacion;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $asignaturas = Asignatura::paginate();

        return view('asignatura.index', compact('asignaturas'))
            ->with('i', (request()->input('page', 1) - 1) * $asignaturas->perPage());
    }

    public function create()
    {
        $asignatura = new Asignatura();
        return view('asignatura.create', compact('asignatura'));
    }

    public function store(Request $request)
    {
        request()->validate(Asignatura::$rules);

        $asignatura = Asignatura::create($request->all());

        return redirect()->route('asignaturas.index')
            ->with('success', 'Asignatura creada exitosamente.');
    }

    public function show($id)
    {
        $asignatura = Asignatura::find($id);

        return view('asignatura.show', compact('asignatura'));
    }

    public function edit($id)
    {
        $asignatura = Asignatura::find($id);

        return view('asignatura.edit', compact('asignatura'));
    }

    public function update(Request $request, Asignatura $asignatura)
    {
        request()->validate(Asignatura::$rules);

        $asignatura->update($request->all());

        return redirect()->route('asignaturas.index')
            ->with('success', 'Asignatura actualizada con éxito');
    }

    public function destroy($id)
    {
        $asignatura = Asignatura::find($id)->delete();

        return redirect()->route('asignaturas.index')
            ->with('success', 'Asignatura eliminada con éxito');
    }


    
}
