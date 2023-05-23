<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpcionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'opci_texto' => 'required|max:150',
            'opci_correcta' => 'boolean',
            'preg_id' => 'required|exists:preguntas,preg_id',
        ];
    }

    public function messages()
    {
        return [
            'opci_texto.required' => 'El texto de la opción es obligatorio.',
            'opci_texto.max' => 'El texto de la opción no debe exceder los 150 caracteres.',
            'opci_correcta.boolean' => 'El valor de "correcta" debe ser verdadero o falso.',
            'preg_id.required' => 'El ID de la pregunta es obligatorio.',
            'preg_id.exists' => 'El ID de la pregunta proporcionado no existe.',
        ];
    }
}
