<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;


class PostsIndex extends Component
{

    use WithPagination;

    //Con esta opcion nos utilizara los estilos de bootstrap
    protected $paginationTheme = "bootstrap";

    //funcion creada para incluirla como un metodo de livewire y aplicado en render
    public $search;
    //Hace que se reinicie la pagina despues de cualquier busqueda
    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        //Utilizamos Like para dcrile que puede haber uan cadena antes y despues de la busqueda ejemplo si buscaramo solo php
        $posts = Post::where('user_id', auth()->user()->id)
                       ->where('name', 'LIKE','%' . $this->search . '%')
                       ->latest('id')->paginate();

        return view('livewire.admin.posts-index', compact('posts'));
    }
}
