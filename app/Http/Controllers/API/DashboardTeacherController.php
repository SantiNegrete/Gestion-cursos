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

        $temas->load('configuracionDocente');
        $temasRelacionDocentes = $temas->toArray();


        if ($temas) {
          foreach ($temas as $key => $value) {
              if ($value->configuracionDocente) {
      
                  // Mover esta parte dentro del bucle para asegurar que se aplique a cada tema
                  $instrumentacionForm =  json_decode($value->configuracionDocente->instrumentacion);
                 
              }
          }
      }

      // Iteramos sobre el arreglo de ids
foreach ($instrumentacionForm as $id) {
  // Convertimos el id a entero para asegurarnos de que sea un número
  $id = (int)$id;

  // Buscamos el registro en el modelo Instrumentacion
  $instrumentacion = Instrumentacion::find($id);

  // Si encontramos el registro, lo agregamos al arreglo
  if ($instrumentacion) {
    $instrumentacionEncontrada[] = $instrumentacion->toArray();
}
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
            'temasRelacionDocentes' => $temasRelacionDocentes,
           // 'instrumentacionForm' => $instrumentacionForm,
            'InstrumentacionesUnidad' => $instrumentacionEncontrada,
        
            


            


            
           
        ]);
        

       /* return response([
            'message' => '123'
        ]);*/
    }

    public function actualizar(Request $request)
    {
        // Puedes acceder a los datos enviados desde el frontend así:
        $datosJSON = $request->input('data');

        // Realiza la lógica de actualización o cualquier otra acción que necesites

        // Devuelve una respuesta, por ejemplo:
        return response()->json(['mensaje' => 'Actualización exitosa']);
    }




}
