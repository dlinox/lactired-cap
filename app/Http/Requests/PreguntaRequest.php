<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PreguntaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'preg_enunciado' => 'required|max:255',
            'secc_id' => 'required|exists:secciones,secc_id',
            'preg_valor' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'preg_enunciado.required' => 'El enunciado de la pregunta es obligatorio.',
            'preg_enunciado.max' => 'El enunciado de la pregunta no debe exceder los 255 caracteres.',
            'secc_id.required' => 'El ID de la sección es obligatorio.',
            'secc_id.exists' => 'El ID de la sección proporcionado no existe.',
            'preg_valor.numeric' => 'El valor de la pregunta debe ser un valor numérico.',
        ];
    }
}
