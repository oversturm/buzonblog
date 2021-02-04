<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{

    public function creating(Post $post)
    {
        //Antes de que se cree el post de esta forma cada vez que se crea post se le asigne el id del usuario atentificado
        //El In es para poder ejecuar los seeder y que nos coja los id aleatoriamente cuano ejecutemos de consola
        if(! \App::runningInConsole()){

            $post->user_id = auth()->user()->id;
        }

    }

    public function deleting(Post $post)
    {
        //Este evento se va ha activar justo antes de que se elimine el post
        if($post->image)
        Storage::delete($post->image->url);
    }


}
