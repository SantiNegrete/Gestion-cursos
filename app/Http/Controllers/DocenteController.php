<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Calendario;
use App\Models\Instrumentacion;
use App\Models\ConfiguracionDocente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function gestion(Asignatura $asignatura, $unidadId = null)
    {
        $unidades = $asignatura->unidades()->with('temas.calendario', 'temas.instrumentacion')->get();
        $calendarios = Calendario::all();
        $instrumentaciones = Instrumentacion::all();

        $unidadActual = $unidadId ? $unidades->where('id', $unidadId)->first() : $unidades->first();
        
        if(!$unidadActual) {
            return redirect()->back()->withErrors('Unidad no encontrada');
        }
    
        $index = $unidades->search(fn($unidad) => $unidad->id === $unidadActual->id);
        $unidadAnterior = $unidades->get($index - 1);
        $unidadSiguiente = $unidades->get($index + 1);

        $configuracionesGuardadas = ConfiguracionDocente::where('docente_id', auth()->id())
                                                        ->where('asignatura_id', $asignatura->id)
                                                        ->get()
                                                        ->keyBy('tema_id');
    
        return view('docente.gestionCurso', compact('asignatura', 'unidadActual', 'unidadAnterior', 'unidadSiguiente', 'calendarios', 'instrumentaciones', 'configuracionesGuardadas'));
    }

    public function guardarConfiguracion(Request $request, Asignatura $asignatura, $unidadId)
    {
        // Validar datos del request
        // $request->validate([
        //     'temas' => 'required|array',
        //     'temas.*.calendario_id' => 'required|exists:calendario,id',
        //     'evaluacion_competencia.calendario_id' => 'nullable|exists:calendario,id',
        //     'instrumentaciones' => 'array',
        //     'instrumentacion.*.instrumentacion_id' => 'nullable|exists:instrumentacion,id',
        // ]);
    

        // return "hola";
    // Guardar configuraciones de temas
    foreach ($request->input('temas', []) as $temaId => $data) {
        ConfiguracionDocente::updateOrCreate(
            // Llaves para buscar
            [
                'docente_id' => auth()->id(),
                'tema_id' => $temaId,
                'asignatura_id' => $asignatura->id,
                'unidad_id' => $unidadId,
            ],
            // Valores para actualizar o crear
            [
                'calendario_id' => $data['calendario_id'] ?? null,
                'instrumentacion_id' => null,
            ]
        );
    }
    
        // Guardar configuración de evaluación de la competencia
        ConfiguracionDocente::updateOrCreate(
            [
                'docente_id' => auth()->id(),
                'asignatura_id' => $asignatura->id,
                'unidad_id' => $unidadId,
                'tema_id' => null, // tema_id a null para la evaluación de la competencia
                'instrumentacion_id' => null, // instrumentacion_id a null también
            ],
            [
                'calendario_id' => $request->input('evaluacion_competencia.calendario_id') ?? null
            ]
        );
    
    // Guardar configuraciones de las instrumentaciones
    foreach ($request->input('instrumentaciones', []) as $instrumento => $data) {
        if (!empty($data['instrumentacion_id'])) {
            ConfiguracionDocente::updateOrCreate(
                // Llaves para buscar
                [
                    'docente_id' => auth()->id(),
                    'instrumentacion_id' => $data['instrumentacion_id'],
                    'asignatura_id' => $asignatura->id,
                    'unidad_id' => $unidadId,
                ],
                // Valores para actualizar o crear
                [
                    'calendario_id' => $data['calendario_id'] ?? null,
                    'tema_id' => null,
                ]
            );
        }
    }
    
        // Redirigir a la página con mensaje de éxito
        return redirect()->route('docente/gestionCurso', ['asignatura' => $asignatura->id, 'unidadId' => $unidadId])
                         ->with('success', 'Configuración guardada con éxito.');
    }

}
