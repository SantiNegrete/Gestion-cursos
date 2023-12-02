<?php

namespace App\Http\Controllers;

use App\Models\Calendario;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $calendarios = Calendario::paginate();

        return view('calendario.index', compact('calendarios'))
            ->with('i', (request()->input('page', 1) - 1) * $calendarios->perPage());
    }

    public function create()
    {
        $calendario = new Calendario();
        return view('calendario.create', compact('calendario'));
    }

    public function store(Request $request)
    {
        request()->validate(Calendario::$rules);

        $calendario = Calendario::create($request->all());

        return redirect()->route('calendario.index')
            ->with('success', 'Semana creada exitosamente.');
    }

    public function show($id)
    {
        $calendario = Calendario::find($id);

        return view('calendario.show', compact('calendario'));
    }

    public function edit($id)
    {
        $calendario = Calendario::find($id);

        return view('calendario.edit', compact('calendario'));
    }

    public function update(Request $request, Calendario $calendario)
    {
        request()->validate(Calendario::$rules);

        $calendario->update($request->all());

        return redirect()->route('calendario.index')
            ->with('success', 'Semana actualizada exitosamente');
    }

    public function destroy($id)
    {
        $calendario = Calendario::find($id)->delete();

        return redirect()->route('calendario.index')
            ->with('success', 'Semana eliminada exitosamente');
    }
}
