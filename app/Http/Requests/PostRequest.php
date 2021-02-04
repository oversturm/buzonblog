<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $post = $this->route()->parameter('post');//Se crea para poner otra regla de validacion en el slug cuando se edite el registro

        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:posts',
            'status'=> 'required|in:1,2',//Esta requerido pero solo se podra seleccionar 1 o 2 qur es la opcion de guardar como borrador o publicado
            'file'=>'image'
        ];
        //Regla de validacion para editar un registro y poder modificar el slug
        if ($post) {
            $rules['slug'] = 'required|unique:posts,slug,' . $post->id;
        }


        //Cuando mandemos el valor de 2 se fusionaarna las reglas de validadcion
        if($this->status == 2){
            $rules = array_merge($rules, [
                    'category_id' => 'required',
                    'tags' => 'required',
                    'extract'=> 'required',
                    'body' => 'required'
            ]);
        }

        return $rules;
    }
}
