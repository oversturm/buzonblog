<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //Cuando utilizamos guarded en vez de fillable para asigancion masiva tenemos que colocar los campos que queremos EVITAR que se llenen por asignación masiva
    protected $guarded =['id','created_at','updated_at'];


    //Relacion uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    //Relaccion muchos a muchos
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    //Relaccion uno a uno polimorfica imagenes

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
}
