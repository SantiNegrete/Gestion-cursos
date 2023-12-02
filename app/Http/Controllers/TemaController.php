<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use App\Models\Unidade;
use App\Models\Practica;
use App\Models\Calendario;
use App\Models\Instrumentacion;
use Illuminate\Http\Request;

class TemaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($unidadId)
    {
        $unidad = Unidade::find($unidadId);
        if (!$unidad) {
            // Manejar el caso en que la unidad no exista
            return redirect()->route('asignaturas.index')->with('error', 'Unidad no encontrada');
        }
    
        $temas = Tema::where('id_unidad', $unidadId)->get();
        return view('tema.index', compact('temas', 'unidad'));
    }


    public function create(Request $request)
    {
        $unidadId = $request->query('id_unidad');
        $unidad = Unidade::find($unidadId);
    
        if (!$unidad) {
            // Redirigir a una página con un mensaje de error
            return redirect()->route('asignaturas.index')->with('error', 'Unidad no encontrada.');
        }
    
        // Asegúrate de que estás llamando al método toArray() para convertir las colecciones a arrays
        $practica = Practica::pluck('descripcion', 'id')->toArray();
        $calendario = Calendario::pluck('nombre_semana', 'id')->toArray();
        $instrumentacion = Instrumentacion::pluck('tipo_instrumentacion', 'id')->toArray();
    
        return view('tema.create', compact('unidad', 'practica', 'calendario', 'instrumentacion'));
    }
    
    

    public function store(Request $request)
    {
        request()->validate([
            'id_unidad' => 'required',
            'temas.*' => 'required|string',
            'practica_id.*' => 'required|integer',
            'calendario_id.*' => 'required|integer',
            'instrumentacion_id.*' => 'required|integer',
        ]);
    
        $unidad = $request->input('id_unidad');
        $temas = $request->input('temas');
        $practicas = $request->input('practica_id');
        $semanas = $request->input('calendario_id');
        $instrumentaciones = $request->input('instrumentacion_id');
    
        if (count($temas) !== count($practicas) || count($temas) !== count($semanas) || count($temas) !== count($instrumentaciones)) {
            return redirect()->back()->with('error', 'La cantidad de temas, prácticas, semanas e instrumentaciones no coincide.');
        }
    
        for ($i = 0; $i < count($temas); $i++) {
            Tema::create([
                'id_unidad' => $unidad,
                'nombre' => $temas[$i],
                'practica_id' => $practicas[$i],
                'calendario_id' => $semanas[$i],
                'instrumentacion_id' => $instrumentaciones[$i]
            ]);
        }
    
        // Redirigir a la vista de índice de temas de la unidad específica
        return redirect()->route('temas.indexPorUnidad', ['unidadId' => $unidad])
            ->with('success', 'Tema(s) creado(s) exitosamente.');
    }
    

    public function show($id)
    {
        $tema = Tema::find($id);

        return view('tema.show', compact('tema'));
    }

    public function edit($id)
    {
        $tema = Tema::find($id);
        if (!$tema) {
            return redirect()->route('asignaturas.index')->with('error', 'Tema no encontrado');
        }
    
        $unidad = Unidade::find($tema->id_unidad);
        $practica = Practica::pluck('descripcion', 'id');
        $calendario = Calendario::pluck('nombre_semana', 'id');
        $instrumentacion = Instrumentacion::pluck('tipo_instrumentacion', 'id');
    
        return view('tema.edit', compact('tema', 'unidad', 'practica', 'calendario', 'instrumentacion'));
    }
    
    

    public function update(Request $request, $id)
    {
        $tema = Tema::find($id);
        if (!$tema) {
            return redirect()->route('temas.index')->with('error', 'Tema no encontrado');
        }
    
        $validatedData = $request->validate([
            'id_unidad' => 'required|exists:unidades,id',
            'nombre' => 'required|string',
            'practica_id' => 'required|exists:practicas,id',            
            'calendario_id' => 'required|exists:calendario,id',
            'instrumentacion_id' => 'required|exists:instrumentacion,id',
        ]);
    
        $tema->update($validatedData);
    
        return redirect()->route('temas.indexPorUnidad', ['unidadId' => $request->id_unidad]);
    }
    

    public function destroy($id)
    {
        $tema = Tema::find($id);
    
        if (!$tema) {
            return redirect()->route('asignaturas.index')
                ->with('error', 'Tema no encontrado.');
        }
    
        $unidadId = $tema->id_unidad; // Asegúrate de capturar el id de la unidad antes de eliminar el tema
        $tema->delete();
    
        return redirect()->route('temas.indexPorUnidad', ['unidadId' => $unidadId])
            ->with('success', 'Tema eliminado exitosamente.');
    }
    
    
    
    
    
}
