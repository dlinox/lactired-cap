<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeccionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $seccId = $this->route('seccion') ? $this->route('seccion')->secc_id : null;

        return [
            // 'secc_nombre' => 'required|unique:secciones,secc_nombre,' . $seccId . ',secc_id,exam_id,' . $this->input('exam_id'),
            'secc_nombre' => 'required|max:255',
            'exam_id' => 'required|exists:examenes,exam_id',
            'secc_nota_aprobatoria' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'secc_nombre.required' => 'El nombre de la sección es obligatorio.',
            'secc_nombre.unique' => 'El nombre de la sección ya está en uso para este examen.',
            'secc_nombre.max' => 'El nombre de la sección no debe superar los 255 caracteres.',
            'exam_id.required' => 'El ID del examen es obligatorio.',
            'exam_id.exists' => 'El ID del examen proporcionado no existe.',
            'secc_nota_aprobatoria.numeric' => 'La nota aprobatoria de la sección debe ser un valor numérico.',
        ];
    }
}
