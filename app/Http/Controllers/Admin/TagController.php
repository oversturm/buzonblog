<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    //MEtodo Constructor para proteger rutas
    public function __construct(){

        $this->middleware('can:admin.tags.index')->only('index');
        $this->middleware('can:admin.tags.create')->only('create', 'store');
        $this->middleware('can:admin.tags.edit')->only('edit', 'update');
        $this->middleware('can:admin.tags.destroy')->only('destroy');

     }

    public function index()
    {
        $tags = Tag::all();

        return view('admin.tags.index', compact('tags'));
    }


    public function create()
    {
        $colors = [
            'red' => 'Color rojo',
            'yelllow' => 'Color Amarillo',
            'green'=>'Color Verde',
            'blue'=>'Color azul',
            'indigo'=>'Color indigo',
            'purple'=>'Color morado',
            'pink'=>'Color rosado'
        ];

        return view('admin.tags.create',compact('colors'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:tags',
            'color'=>'required'
        ]);
        $tag = Tag::create($request->all());
        return redirect()->route('admin.tags.edit', compact('tag'))->with('info', 'La etiqueta se creo con éxito');;//no olvidar habiliar la asignacion masiva
    }


    public function edit(Tag $tag)
    {
        $colors = [
            'red' => 'Color rojo',
            'yelllow' => 'Color Amarillo',
            'green'=>'Color Verde',
            'blue'=>'Color azul',
            'indigo'=>'Color indigo',
            'purple'=>'Color morado',
            'pink'=>'Color rosado'
        ];

        return view('admin.tags.edit', compact('tag', 'colors'));
    }


    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name'=>'required',
            'slug'=> "required|unique:tags,slug,$tag->id", //Lo ponemos con comillas dobles y añadimos para poder actualizar el registro y con ello el slug
            'color'=>'required'
        ]);
        $tag->update($request->all());

        return redirect()->route('admin.tags.edit', $tag)->with('info', 'La etiqueta se actualizo con éxito');
    }


    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.tags.index')->with('info', 'La etiqueta se elimino con éxito');
    }



}
