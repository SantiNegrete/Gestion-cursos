<?php

namespace App\Http\Controllers;

use App\Models\Instrumentacion;
use App\Models\Asignacione;
use Illuminate\Http\Request;

class InstrumentacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $instrumentacions = Instrumentacion::paginate();

        return view('instrumentacion.index', compact('instrumentacions'))
            ->with('i', (request()->input('page', 1) - 1) * $instrumentacions->perPage());
    }

    public function create()
    {
        $instrumentacion = new Instrumentacion();
        $asignacion = Asignacione::pluck('id_profesor', 'id');
        return view('instrumentacion.create', compact('instrumentacion', 'asignacion'));
    }

    public function store(Request $request)
    {
        request()->validate(Instrumentacion::$rules);

        $instrumentacion = Instrumentacion::create($request->all());

        return redirect()->route('instrumentacion.index')
            ->with('success', 'Instrumentación creada exitosamente.');
    }

    public function show($id)
    {
        $instrumentacion = Instrumentacion::find($id);

        return view('instrumentacion.show', compact('instrumentacion'));
    }

    public function edit($id)
    {
        $instrumentacion = Instrumentacion::find($id);
        $asignacion = Asignacione::pluck('id_profesor', 'id');
        return view('instrumentacion.edit', compact('instrumentacion', 'asignacion'));
    }

    public function update(Request $request, Instrumentacion $instrumentacion)
    {
        request()->validate(Instrumentacion::$rules);

        $instrumentacion->update($request->all());

        return redirect()->route('instrumentacion.index')
            ->with('success', 'Instrumentación actualizada exitosamente');
    }

    public function destroy($id)
    {
        $instrumentacion = Instrumentacion::find($id)->delete();

        return redirect()->route('instrumentacion.index')
            ->with('success', 'Instrumentación eliminada exitosamente');
    }
}
