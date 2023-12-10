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


    public function gestion($id_materia){
 

       

        $unidadId = null;
        $asignatura = Asignatura::findOrFail($id_materia);

       $unidades = $asignatura->unidades()->with('temas.calendario', 'temas.instrumentacion')->get();
      
        $calendarios = Calendario::all();
         
        $instrumentaciones = Instrumentacion::all();

        $configuracionDocente = ConfiguracionDocente::all();

      /*  $unidadActual = $unidadId ? $unidades->where('id', $unidadId)->first() : $unidades->first();
        $temas =$unidadActual->temas;*/


        if ($asignatura) {
            $unidades = $asignatura->unidades;
            $numUnidades = $asignatura->unidades()->pluck('id')->toArray();
            $unidadActual = $unidades->first();
            $temas = $unidadActual->temas;
            

          
        }

        

       // $configuracionesGuardadas = ConfiguracionDocente::where('docente_id', auth()->id())
                                                      //  ->where('asignatura_id', $asignatura->id)
                                                        //->get()
                                                        //->keyBy('tema_id');
    

        
        return response()->json([

            'asignatura' => $asignatura,
             'unidadActual' => $unidadActual,
           // 'unidadAnterior' => $unidadAnterior,//no
            //'unidadSiguiente' => $unidadSiguiente,//no
             'calendarios' => $calendarios,
            'instrumentaciones' => $instrumentaciones,
           // 'configuracionesGuardadas' => $configuracionesGuardadas,//mp
             'temas' => $temas,

            'unidades' =>  $unidades,
            'numUnidades'  => $numUnidades,

            'configuracionDocente' =>  $configuracionDocente,
        
            


            


            
           
        ]);
        

       /* return response([
            'message' => '123'
        ]);*/
    }
}
