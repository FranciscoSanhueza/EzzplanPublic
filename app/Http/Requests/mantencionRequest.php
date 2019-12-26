<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class mantencionRequest extends FormRequest
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
                'title' => ['required','string'],
                'desc' => ['required','string'],
                'start' => ['required', 'date'],
                'startH' => ['required'],
                'end' => ['required', 'date'],
                'endH' => ['required'],
                'id' => ['required','numeric','exists:users,id'],
                'prioridad' => ['required','numeric','between:1,3','exists:prioridads,id'],
                'id' => Rule::exists('users')->where(function ($query) {
                    return $query->where('empresa_id', auth()->user()->empresa->id);
                }),
                'fases' => [
                    'required',
                    'exists:fases,id',
                ],
                'equipos' => ['required',
                    'exists:equipos,id',
                ],
                'trabajadores' => ['required',
                'exists:trabajadors,id'
                ],
                'insumos' => ['required',
                'exists:insumos,id'
                ],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'El campo Titulo es obligatorio.',
            'title.string' => 'El campo Titulo debe ser texto.',
            'desc.required' => 'El campo Descripcion es obligatorio.',
            'desc.string' => 'El campo Descripcion debe ser texto.',
            'start.required' => 'El campo Inicio es obligatorio.',
            'startH.required' => 'El campo Hora de inicio es obligatorio.',
            'end.required' => 'El campo Final es obligatorio.',
            'endH.required' => 'El campo Hora Final es obligatorio.',
            'id.exists' => 'Encargado no registrado',
            'id.required' => 'El campo Encargado es obligatorio.',
            'id.numeric' => 'El campo Encargado debe ser numerico.',
            'prioridad.between' => 'Prioridad no encontrada',

        ];
    }
}
