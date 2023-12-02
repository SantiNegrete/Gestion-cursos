<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Models\Asignacione;
use App\Models\Usuario;
use App\Models\Asignatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsignacioneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $asignaciones = Asignacione::with(['usuario', 'asignatura'])->paginate();
    
        return view('asignacione.index', compact('asignaciones'))
            ->with('i', (request()->input('page', 1) - 1) * $asignaciones->perPage());
    }
    
    public function create()
    {
        $rolDocente = Role::where('name', 'Docente')->first();
    
        if ($rolDocente) {
            $profesores = Usuario::role('Docente')->pluck('name', 'id');
        } else {
            $profesores = collect();
        }
    
        $asignaturas = Asignatura::pluck('nombre', 'id');
        $asignacione = new Asignacione();
    
        return view('asignacione.create', compact('profesores', 'asignaturas', 'asignacione'));
    }
    
    public function store(Request $request)
    {
        request()->validate(Asignacione::$rules);

        $asignacione = Asignacione::create($request->all());

        return redirect()->route('asignaciones.index')
            ->with('success', 'Asignación creada exitosamente.');
    }

    public function show($id)
    {
        $asignacione = Asignacione::find($id);

        return view('asignacione.show', compact('asignacione'));
    }

    public function edit($id)
    {
        $asignacione = Asignacione::find($id);
        $profesores = Usuario::pluck('name', 'id');
        $asignaturas = Asignatura::pluck('nombre', 'id');
    
        return view('asignacione.edit', compact('asignacione', 'profesores', 'asignaturas'));
    }
    
    public function update(Request $request, Asignacione $asignacione)
    {
        request()->validate(Asignacione::$rules);

        $asignacione->update($request->all());

        return redirect()->route('asignaciones.index')
            ->with('success', 'Asignación actualizada con éxito');
    }

    public function destroy($id)
    {
        $asignacione = Asignacione::find($id)->delete();

        return redirect()->route('asignaciones.index')
            ->with('success', 'Asignación eliminada con éxito');
    }

    // Método nuevo para mostrar asignaturas del docente autenticado
    public function misAsignaturas()
    {
        $usuario = Auth::user(); // Obtiene el usuario autenticado
        
        // Comprueba si el usuario es un docente
        if ($usuario->hasRole('Docente')) {
            // Obtén solo las asignaturas asignadas al docente autenticado
            $asignaciones = Asignacione::with('asignatura')
                                       ->where('id_profesor', $usuario->id)
                                       ->get();
            
            // Devuelve la vista con las asignaturas asignadas al docente
            return view('docente.mis_asignaturas', compact('asignaciones'));
        } else {
            // Si no es docente, redirige a la ruta 'home' con un mensaje de error
            return redirect()->route('home')->with('error', 'No tienes acceso a esta sección');
        }
    }
}
