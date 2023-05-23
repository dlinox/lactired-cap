<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstructorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'inst_nombre' => 'required|string|max:255',
            'inst_apellido' => 'required|string|max:255',
            'inst_documento_tipo' => 'required|in:DNI,RUC,CE',
            'inst_documento_nro' => 'required|string|max:12|unique:instructores,inst_documento_nro,' . ($this->instructor ? $this->instructor->inst_id : 'NULL') . ',inst_id',
            'inst_email' => 'required|email|unique:instructores,inst_email,' . ($this->instructor ? $this->instructor->inst_id : 'NULL') . ',inst_id',
            // 'inst_password' => 'required|string|min:8',
            'inst_estado' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'inst_nombre.required' => 'El nombre del instructor es obligatorio.',
            'inst_nombre.string' => 'El nombre del instructor debe ser una cadena de caracteres.',
            'inst_nombre.max' => 'El nombre del instructor no puede tener más de 255 caracteres.',
            'inst_apellido.required' => 'El apellido del instructor es obligatorio.',
            'inst_apellido.string' => 'El apellido del instructor debe ser una cadena de caracteres.',
            'inst_apellido.max' => 'El apellido del instructor no puede tener más de 255 caracteres.',
            'inst_documento_tipo.required' => 'El tipo de documento del instructor es obligatorio.',
            'inst_documento_tipo.in' => 'El tipo de documento del instructor debe ser DNI, RUC o CE.',
            'inst_documento_nro.required' => 'El número de documento del instructor es obligatorio.',
            'inst_documento_nro.string' => 'El número de documento del instructor debe ser una cadena de caracteres.',
            'inst_documento_nro.max' => 'El número de documento del instructor no puede tener más de 12 caracteres.',
            'inst_documento_nro.unique' => 'El número de documento del instructor ya está en uso.',
            'inst_email.required' => 'El correo electrónico del instructor es obligatorio.',
            'inst_email.email' => 'El correo electrónico del instructor debe ser una dirección de correo válida.',
            'inst_email.unique' => 'El correo electrónico del instructor ya está en uso.',
            // 'inst_password.required' => 'La contraseña del instructor es obligatoria.',
            // 'inst_password.string' => 'La contraseña del instructor debe ser una cadena de caracteres.',
            // 'inst_password.min' => 'La contraseña del instructor debe tener al menos 8 caracteres.',
            'inst_estado.boolean' => 'El estado del instructor debe ser un valor booleano.',
        ];
    }
}