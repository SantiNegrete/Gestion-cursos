<?php

namespace App\Livewire\Professor\Professor;

use App\Models\Asignatura;
use App\Models\Calendario;
use App\Models\ConfiguracionDocente;
use App\Models\Instrumentacion;
use App\Models\Unidade;
use Livewire\Component;

class ProfessorCreate extends Component
{
    public $calendarios = [], $instrumentaciones = [];
    public $unidades = [], $numUnidades = [], $temas = [];
    public $unidadActual, $configuracionesDocentes = [];

    public $asignatura;
    public $numUnidad = 1;
    public $configuracionDocente;

    public $calendarioForm, $temasForm = [], $instrumentacionForm = [];


    public  function mount($asignatura)
    {
        $this->calendarios = Calendario::all();
        $this->instrumentaciones = Instrumentacion::all();
        $this->asignatura =  Asignatura::where('id', $asignatura)->first();

        if ($this->asignatura) {
            $this->unidades = $this->asignatura->unidades;
            $this->numUnidades = $this->asignatura->unidades()->pluck('id')->toArray();
            $this->unidadActual = $this->unidades->first();
            $this->temas =    $this->unidadActual->temas;

            $this->cambiarUnidad($this->unidadActual->id);
        }

        // $this->temasForm = [];
        $this->configuracionDocente = new ConfiguracionDocente();
    }


    public function cambiarUnidad($numId)
    {
        $this->temasForm = [];
        $this->instrumentacionForm = [];
        $this->calendarioForm = '';

        $this->unidadActual  =  Unidade::where('id', $numId)->first();
        $this->temas =  $this->unidadActual->temas;

        if ($this->temas) {

            foreach ($this->temas as $key => $value) {
                if ($value->configuracionDocente) {
                    $this->temasForm[$value->id] = $value->configuracionDocente->fecha_tema;
                }
            }
            if ($value->configuracionDocente) {
                $this->instrumentacionForm =  json_decode($value->configuracionDocente->instrumentacion);
                $this->calendarioForm =  $value->configuracionDocente->calendario_id;
            }
        }
    }



    public function save()
    {
        $this->validate([
            // 'temasForm' => 'required|array',
            // 'instrumentacionForm' => 'required|array',
            'calendarioForm' => 'required',
        ]);

        foreach ($this->temas as $i => $tema) {

            $this->configuracionDocente = ConfiguracionDocente::where('tema_id', $tema->id)->first();
            $this->configuracionDocente ? $this->configuracionDocente  :  $this->configuracionDocente = new ConfiguracionDocente();




            $this->configuracionDocente->docente_id  = auth()->id();
            $this->configuracionDocente->tema_id   = $tema->id;
            $this->configuracionDocente->fecha_tema   = $this->temasForm[$tema->id];
            $this->configuracionDocente->asignatura_id  = $this->asignatura->id;
            $this->configuracionDocente->unidad_id  = $this->unidadActual->id;
            $this->configuracionDocente->calendario_id =  $this->calendarioForm;
            $this->configuracionDocente->instrumentacion =  json_encode($this->instrumentacionForm);

            $this->configuracionDocente->save();
        }


        session()->flash('success', 'Configuracion Docente guardado Exitosamente.');
    }


    public function render()
    {
        return view('livewire.professor.professor.professor-create');
    }
}