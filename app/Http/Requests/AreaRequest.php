<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'area_nombre' => 'required|string|max:100|unique:areas,area_nombre,' . ($this->area ? $this->area->area_id : 'NULL') . ',area_id',
            'area_descripcion' => 'nullable|string|max:200',
            'area_estado' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'area_nombre.required' => 'El nombre del área es obligatorio.',
            'area_nombre.string' => 'El nombre del área debe ser una cadena de caracteres.',
            'area_nombre.max' => 'El nombre del área no puede tener más de 100 caracteres.',
            'area_nombre.unique' => 'El nombre del área ya está en uso.',
            'area_descripcion.string' => 'La descripción del área debe ser una cadena de caracteres.',
            'area_descripcion.max' => 'La descripción del área no puede tener más de 200 caracteres.',
            'area_estado.boolean' => 'El estado del área debe ser un valor booleano.',
        ];
    }
}
