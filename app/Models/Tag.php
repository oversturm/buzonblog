<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

     // Activar la asignacion masiva para guardar la informacion en la bbdd
    protected $fillable = [
        'name',
        'slug',
        'color'
    ];

    //Relacion muchos a muchos
    public function posts(){
        return $this->belongsToMany(Post::class);
    }

     //Cambiar los id de las rutas por los slug

     public function getRouteKeyName()
     {
         return "slug";
     }
}
