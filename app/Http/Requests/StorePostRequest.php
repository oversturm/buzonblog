<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Verifica si el usuario esta verificado antes de crear el post
        if ($this->user_id == auth()->user()->id) {
             return true;
        }else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:posts',
            'status'=> 'required|in:1,2',//Esta requerido pero solo se podra seleccionar 1 o 2 qur es la opcion de guardar como borrador o publicado
            'file'=>'image'
        ];
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
