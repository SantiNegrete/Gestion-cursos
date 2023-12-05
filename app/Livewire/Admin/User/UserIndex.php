<?php

namespace App\Livewire\Admin\User;

use App\Models\Usuario;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
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
        $user = Usuario::where('id', $id)->first();
        if ( $user) {
            $user->delete();
            session()->flash('success', 'Usuario Eliminado Exitosamente.');
        }
    }

    
   
    public function render()
    {
        $usuarios = Usuario::where('name', 'ILIKE' , '%' . $this->search . '%')->paginate($this->numPage);
        return view('livewire.admin.user.user-index', compact('usuarios'));
    }
}
