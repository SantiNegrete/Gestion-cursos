<?php

namespace App\Livewire\Admin\Role;

use Spatie\Permission\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class RoleIndex extends Component
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
        $user = Role::where('id', $id)->first();
        if ( $user) {
            $user->delete();
            session()->flash('success', 'Rol Eliminado Exitosamente.');
        }
    }

    
   
    public function render()
    {
        $roles = Role::where('name', 'ILIKE' , '%' . $this->search . '%')->paginate($this->numPage);
        return view('livewire.admin.role.role-index', compact('roles'));
    }
}
