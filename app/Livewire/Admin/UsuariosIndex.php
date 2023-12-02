<?php

namespace App\Livewire\Admin;

use App\Models\Usuario;
use Livewire\Component;

use Livewire\WithPagination;
class UsuariosIndex extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }   

    
    public function render()
    {
        $usuarios = Usuario::where('name', 'LIKE' , '%' . $this->search . '%')
                    ->orWhere('email', 'LIKE' , '%' . $this->search . '%')->paginate();

        return view('livewire.admin.usuarios-index', compact('usuarios'));
    }
}
