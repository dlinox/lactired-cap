<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamenRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $examId = $this->route('examen') ? $this->route('examen')->exam_id : null;

        return [
            'exam_nombre' => 'required|max:255|unique:examenes,exam_nombre,' . $examId . ',exam_id',
            'exam_duracion' => 'nullable|integer',
            'exam_nota_aprobatoria' => 'nullable|integer',
        ];
    }

    public function messages()
    {
        return [
            'exam_nombre.required' => 'El nombre del examen es obligatorio.',
            'exam_nombre.unique' => 'El nombre del examen ya está en uso.',
            'exam_nombre.max' => 'El nombre del examen no debe superar los 255 caracteres.',
            'exam_duracion.integer' => 'La duración del examen debe ser un valor entero.',
            'exam_nota_aprobatoria.integer' => 'La nota aprobatoria del examen debe ser un valor entero.',
        ];
    }
}
