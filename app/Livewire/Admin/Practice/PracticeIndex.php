<?php

namespace App\Livewire\Admin\Practice;

use App\Models\Practica;
use Livewire\Component;
use Livewire\WithPagination;

class PracticeIndex extends Component
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
        $user = Practica::where('id', $id)->first();
        if ( $user) {
            $user->delete();
            session()->flash('success', 'Practica Eliminado Exitosamente.');
        }
    }

    
   
    public function render()
    {
        $practicas = Practica::where('descripcion', 'ILIKE' , '%' . $this->search . '%')->paginate($this->numPage);
        return view('livewire.admin.practice.practice-index', compact('practicas'));
    }
}
