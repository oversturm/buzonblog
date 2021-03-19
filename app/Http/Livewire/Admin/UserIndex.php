<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

use Livewire\WithPagination;

class UserIndex extends Component
{
    //Crear la paginacion llamando con livewire
    use WithPagination;

    //funcion creada para incluirla como un metodo de livewire y aplicado en render
    public $search;
    //Hace que se reinicie la pagina despues de cualquier busqueda
    public function updatingSearch(){
        $this->resetPage();
    }


    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $users= User::where('name', 'LIKE', '%'. $this->search . '%')
                    ->orWhere('email', 'LIKE', '%'. $this->search . '%')
                    ->paginate();

        return view('livewire.admin.user-index', compact('users'));
    }
}
