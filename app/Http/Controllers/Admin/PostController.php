<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Http\Requests\PostRequest;

use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
     //MEtodo Constructor para proteger rutas
     public function __construct(){

        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.create')->only('create', 'store');
        $this->middleware('can:admin.posts.edit')->only('edit', 'update');
        $this->middleware('can:admin.posts.destroy')->only('destroy');

     }


    public function index()
    {
        return view('admin.posts.index');
    }


    public function create()
    {
        $categories = Category::pluck('name', 'id');//Parar mostrar las categorias utilizamos pluck en vez de all nos muestra solo los nombres y le añadimos id para que pueda ser leido por laravel Collective
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }


    public function store(PostRequest $request)
    {
        Storage::put('posts', $request->file('file'));

        $post = Post::create($request->all());

        if ($request->file('file')) {

            $url = Storage::put('posts', $request->file('file'));

            $post->image()->create([
                'url' => $url
            ]);
        }

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }
        return redirect()->route('admin.posts.edit', $post);
    }



    public function edit(Post $post)
    {
        //Metodo de autorizacion Policy para que un usuario no pueda editar post de otro usuario
        $this->authorize('author', $post);

        $categories = Category::pluck('name', 'id');//Parar mostrar las categorias utilizamos pluck en vez de all nos muestra solo los nombres y le añadimos id para que pueda ser leido por laravel Collective
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }


    public function update(PostRequest $request, Post $post)
    {
         //Metodo de autorizacion Policy para que un usuario no pueda actualizar post de otro usuario
         $this->authorize('author', $post);

        $post->update($request->all());

        if ($request->file('file')) {
            $url = Storage::put('posts', $request->file('file'));

            if ($post->image) {
                Storage::delete($post->image->url);

                $post->image->update([
                    'url' => $url
                ]);
            } else {
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }

        if ($request->tags) {
            $post->tags()->sync($request->tags);//El metodo sync sincronizar la coleccion, si el id esta registrado no lo va a registrar y si se encuentra lo va a eliminar
        }

        return redirect()->route('admin.posts.edit', $post)->with('info', 'El post se actualizo con exito');
    }

    public function destroy(Post $post)
    {
         //Metodo de autorizacion Policy para que un usuario no pueda borrar post de otro usuario
         $this->authorize('author', $post);

        $post->delete();

        return redirect()->route('admin.posts.index')->with('info', 'El post ha sido borrado con exito');
    }
}
