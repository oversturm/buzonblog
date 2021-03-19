<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index(){
        //USi por la url estamos pasando la informacion de la pagina si la pasamos
        //Si la mandamos la almacenamos en en la variable key ,caddena post con la informacion de la pagina
        //Caso que no que me almacene solo post y seguira almacenandose en key porque sera dinamica
        if (request()->page) {
            $key = 'posts' . request()->page;
        } else {
            $key = 'posts';
        }


        if (Cache::has($key)) {

            $posts = Cache::get($key);

        } else {

            // Recupere los post cuando esten publicados ya que status en 1 era borrador y en 2 era publicado para generar la coleccion el metodo get
            $posts = Post::where('status', 2)->latest('id')->paginate(8);
            //Almacenamos en cache
            Cache::put($key, $posts);
        }




        return view('posts.index', compact('posts'));
    }

    public function show(Post $post){

         //Metodo de autorizacion Policy para impedir el paso a post que no estan publicados
        $this->authorize('publisher', $post);

        $similares = Post::where('category_id', $post->category_id)
                            ->where('status', 2)
                            ->where('id', '!=', $post->id)
                            ->latest('id')
                            ->take(4)
                            ->get();


        return view('posts.show', compact('post', 'similares'));
    }
    public function category(Category $category){

        $posts = Post::where('category_id', $category->id)
                    ->where('status', 2)
                    ->latest('id')
                    ->paginate(6);

        return view('posts.category', compact('posts', 'category'));
    }
    public function tag(Tag $tag){

        $posts = $tag->posts()
                    ->where('status', 2)
                    ->latest('id')
                    ->paginate(4);
        return view('posts.tag', compact('posts', 'tag'));

    }
}
