<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecursoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'recu_nombre' => 'required|string|max:100|unique:recursos,recu_nombre,' . ($this->recurso ? $this->recurso->recu_id : 'NULL') . ',recu_id',
            'recu_descripcion' => 'nullable|string|max:255',
            'recu_tipo' => 'nullable|string|max:15',
            'recu_url' => 'nullable|url',
            'recu_estado' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'recu_nombre.required' => 'El nombre del recurso es obligatorio.',
            'recu_nombre.string' => 'El nombre del recurso debe ser una cadena de caracteres.',
            'recu_nombre.max' => 'El nombre del recurso no puede tener más de 100 caracteres.',
            'recu_nombre.unique' => 'El nombre del recurso ya está en uso.',
            'recu_descripcion.string' => 'La descripción del recurso debe ser una cadena de caracteres.',
            'recu_descripcion.max' => 'La descripción del recurso no puede tener más de 255 caracteres.',
            'recu_tipo.string' => 'El tipo de recurso debe ser una cadena de caracteres.',
            'recu_tipo.max' => 'El tipo de recurso no puede tener más de 15 caracteres.',
            'recu_url.url' => 'La URL del recurso no es válida.',
            'recu_estado.boolean' => 'El estado del recurso debe ser un valor booleano.',
        ];
    }
}
