<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInsumoRequest extends FormRequest
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
        return [
            'txt_nombre' => 'required|string',
            'txt_descripcion' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'txt_nombre.required' => 'El campo Nombre es obligatorio.',
            'txt_nombre.string' => 'El campo Nombre debe ser de tipo texto.',
            'txt_descripcion.required' => 'El campo Descripción es obligatorio.',
            'txt_descripcion.string' => 'El campo Descripción debe ser de tipo texto.',
        ];
    }
}
