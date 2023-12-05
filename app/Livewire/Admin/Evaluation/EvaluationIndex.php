<?php

namespace App\Livewire\Admin\Evaluation;

use App\Models\CriteriosEvaluacion;
use Livewire\Component;
use Livewire\WithPagination;

class EvaluationIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search;

    public $numPage = 10;

    public function updatingSearch(){
        $this->resetPage();
    }   

    public function updatingNumPage(){
        $this->resetPage();
    }   

    public function delete($id){
        $evaluation = CriteriosEvaluacion::where('id', $id)->first();
        if ( $evaluation) {
            $evaluation->delete();
            session()->flash('success', 'Criterio Eliminado Exitosamente.');
        }
    }

    
   
    public function render()
    {
        $criteriosEvaluacions = CriteriosEvaluacion::where('descripcion', 'ILIKE' , '%' . $this->search . '%')->paginate($this->numPage);
        return view('livewire.admin.evaluation.evaluation-index', compact('criteriosEvaluacions'));
    }
}
