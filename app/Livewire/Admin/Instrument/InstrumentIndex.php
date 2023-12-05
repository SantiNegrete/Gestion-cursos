<?php

namespace App\Livewire\Admin\Instrument;

use App\Models\Instrumentacion;
use Livewire\Component;
use Livewire\WithPagination;

class InstrumentIndex extends Component
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
        $instrumentacion = Instrumentacion::where('id', $id)->first();
        if ( $instrumentacion) {
            $instrumentacion->delete();
            session()->flash('success', 'Instrumento Eliminado Exitosamente.');
        }
    }

    
   
    public function render()
    {
        $instrumentacions = Instrumentacion::where('tipo_instrumentacion', 'ILIKE' , '%' . $this->search . '%')->paginate($this->numPage);
        return view('livewire.admin.instrument.instrument-index', compact('instrumentacions'));
    }
}
