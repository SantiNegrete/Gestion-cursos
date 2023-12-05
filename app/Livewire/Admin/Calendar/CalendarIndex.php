<?php

namespace App\Livewire\Admin\Calendar;

use App\Models\Calendario;
use Livewire\Component;
use Livewire\WithPagination;

class CalendarIndex extends Component
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
        $calendario = Calendario::where('id', $id)->first();
        if ( $calendario) {
            $calendario->delete();
            session()->flash('success', 'Calendario Eliminado Exitosamente.');
        }
    }

    
   
    public function render()
    {
        $calendarios = Calendario::where('nombre_semana', 'ILIKE' , '%' . $this->search . '%')->paginate($this->numPage);
        return view('livewire.admin.calendar.calendar-index', compact('calendarios'));
    }
}
