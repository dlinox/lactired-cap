<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipo_nombre' => 'required|string|max:100|unique:tipos,tipo_nombre,' . ($this->tipo ? $this->tipo->tipo_id : 'NULL') . ',tipo_id',
            'tipo_descripcion' => 'nullable|string|max:200',
            'tipo_estado' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'tipo_nombre.required' => 'El nombre del tipo es obligatorio.',
            'tipo_nombre.string' => 'El nombre del tipo debe ser una cadena de caracteres.',
            'tipo_nombre.max' => 'El nombre del tipo no puede tener más de 100 caracteres.',
            'tipo_nombre.unique' => 'El nombre del tipo ya está en uso.',
            'tipo_descripcion.string' => 'La descripción del tipo debe ser una cadena de caracteres.',
            'tipo_descripcion.max' => 'La descripción del tipo no puede tener más de 200 caracteres.',
            'tipo_estado.boolean' => 'El estado del tipo debe ser un valor booleano.',
        ];
    }
}
