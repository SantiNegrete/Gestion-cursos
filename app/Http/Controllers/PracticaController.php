<?php

namespace App\Http\Controllers;

use App\Models\Practica;
use Illuminate\Http\Request;

class PracticaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $practicas = Practica::paginate();

        return view('practica.index', compact('practicas'))
            ->with('i', (request()->input('page', 1) - 1) * $practicas->perPage());
    }

    public function create()
    {
        $practica = new Practica();
        return view('practica.create', compact('practica'));
    }

    public function store(Request $request)
    {
        request()->validate(Practica::$rules);

        $practica = Practica::create($request->all());

        return redirect()->route('practicas.index')
            ->with('success', 'Práctica creada con éxito.');
    }

    public function show($id)
    {
        $practica = Practica::find($id);

        return view('practica.show', compact('practica'));
    }

    public function edit($id)
    {
        $practica = Practica::find($id);
        return view('practica.edit', compact('practica'));
    }

    public function update(Request $request, Practica $practica)
    {
        request()->validate(Practica::$rules);

        $practica->update($request->all());

        return redirect()->route('practicas.index')
            ->with('success', 'Práctica actualizada con éxito');
    }

    public function destroy($id)
    {
        $practica = Practica::find($id)->delete();

        return redirect()->route('practicas.index')
            ->with('success', 'Práctica eliminada exitosamente');
    }
}
