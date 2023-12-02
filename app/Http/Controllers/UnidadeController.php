<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Models\Asignatura;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class UnidadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $unidades = Unidade::paginate();

        return view('unidade.index', compact('unidades'))
            ->with('i', (request()->input('page', 1) - 1) * $unidades->perPage());
    }

    public function create(Request $request)
    {
        $asignaturaId = $request->query('asignatura_id');
        $asignatura = Asignatura::find($asignaturaId);
    
        if (!$asignatura) {
            // Redirige a una página de error o lista de asignaturas con un mensaje de error
            return redirect()->route('asignaturas.index')->with('error', 'Asignatura no encontrada.');
        }
    
        return view('unidade.create', compact('asignatura'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'asignatura_id' => 'required|exists:asignaturas,id',
            'nombre' => 'required|array|min:1',
            'nombre.*' => 'required|string',
            'objetivo' => 'required|array|min:1',
            'objetivo.*' => 'required|string',
        ]);
    
        $asignaturaId = $request->input('asignatura_id');
        $nombres = $request->input('nombre');
        $objetivos = $request->input('objetivo');
    
        foreach ($nombres as $key => $nombre) {
            $objetivo = $objetivos[$key];
    
            Unidade::create([
                'asignatura_id' => $asignaturaId,
                'nombre' => $nombre,
                'objetivo' => $objetivo,
            ]);
        }
    
        return redirect()->route('asignaturas.index')
            ->with('success', 'Unidad creada con éxito.');
    }
    

    public function show($id)
    {
        $unidade = Unidade::find($id);

        return view('unidade.show', compact('unidade'));
    }

    public function edit($id)
    {
        $unidade = Unidade::find($id);
        $asignatura = Asignatura::pluck('nombre', 'id');
    
        
        $unidades = Unidade::where('asignatura_id', $unidade->asignatura_id)->get();
    
        return view('unidade.edit', compact('unidade', 'asignatura', 'unidades'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'objetivo' => 'required|string',
            'asignatura_id' => 'required|exists:asignaturas,id', // Asegúrate de enviar este campo desde el formulario
        ]);
    
        $unidade = Unidade::find($id);
    
        if (!$unidade) {
            return redirect()->route('unidades.index')->with('error', 'Unidad no encontrada.');
        }
    
        // Actualizar la unidad
        $unidade->nombre = $request->nombre;
        $unidade->objetivo = $request->objetivo;
        $unidade->asignatura_id = $request->asignatura_id; // Asegúrate de que este campo se esté enviando desde el formulario
        $unidade->save();
    
        return redirect()->route('asignaturas.index')->with('success', 'Unidad actualizada con éxito.');
    }
    

    public function destroy($id)
    {
        try {
            $unidad = Unidade::find($id);
            if (!$unidad) {
                return redirect()->route('asignaturas.index')
                    ->with('success', 'Unidad no encontrada.');
            }
    
            $unidad->delete();
        } catch (QueryException $e) {
            return redirect()->route('asignaturas.index')
                ->with('success', 'No se puede eliminar la unidad porque tiene temas relacionados.');
        }
    
        return redirect()->route('asignaturas.index')
            ->with('success', 'Unidad eliminada exitosamente');
    }
}
