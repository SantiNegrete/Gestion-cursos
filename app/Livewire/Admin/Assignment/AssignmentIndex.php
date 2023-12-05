<?php

namespace App\Livewire\Admin\Assignment;

use App\Models\Asignacione;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Component;
use Livewire\WithPagination;

class AssignmentIndex extends Component
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
        $asignacione = Asignacione::where('id', $id)->first();
        if ( $asignacione) {
            $asignacione->delete();
            session()->flash('success', 'Asignacion Eliminado Exitosamente.');
        }
    }

    
   
    public function render()
    {
        $asignaciones = Asignacione::where('id_profesor', 'ILIKE' , '%' . $this->search . '%')->paginate($this->numPage);
        return view('livewire.admin.assignment.assignment-index', compact('asignaciones'));
    }
}
