<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Asignacione;

use App\Models\Calendario;
use App\Models\Instrumentacion;
use App\Models\ConfiguracionDocente;
use App\Models\Asignatura;



class DashboardTeacherController extends Controller
{
    public function dashboardTeacher(Request $request){

        $user = Auth::user();


      $materias = Asignacione::with('asignatura')
        ->where('id_profesor', $user->id)
        ->get();

      
      return response()->json([

        'user' => $user,
        'materias' => $materias,
    ]);
    

    }


    public function gestion(Request $request){
 
        $unidadId = null;
        $asignatura = Asignatura::findOrFail(2);

       $unidades = $asignatura->unidades()->with('temas.calendario', 'temas.instrumentacion')->get();
      
        $calendarios = Calendario::all();
         
        $instrumentaciones = Instrumentacion::all();

        $unidadActual = $unidadId ? $unidades->where('id', $unidadId)->first() : $unidades->first();
        $temas =$unidadActual->temas;

         
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
    

        
        return response()->json([

            'asignatura' => $asignatura,
           'unidadActual' => $unidadActual,
            'unidadAnterior' => $unidadAnterior,
            'unidadSiguiente' => $unidadSiguiente,
            'calendarios' => $calendarios,
            'instrumentaciones' => $instrumentaciones,
            'configuracionesGuardadas' => $configuracionesGuardadas,
            'temas' => $temas,


            
           
        ]);

       /* return response([
            'message' => '123'
        ]);*/
    }
}
