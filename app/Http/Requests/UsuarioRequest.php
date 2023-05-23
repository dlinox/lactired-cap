<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'usua_nombre' => 'required|string|max:120',
            'usua_apellido' => 'required|string|max:120',
            'usua_documento_tipo' => 'required|in:DNI,RUC,CE',
            'usua_documento_nro' => 'required|string|max:12|unique:usuarios,usua_documento_nro,' . ($this->usuario ? $this->usuario->usua_id : 'NULL') . ',usua_id',
            'usua_email' => 'required|email|unique:usuarios,usua_email,' . ($this->usuario ? $this->usuario->usua_id : 'NULL') . ',usua_id',
            'usua_password' => !$this->usuario ? 'required|string|min:8' : 'nullable|string|min:8',
            'usua_estado' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'usua_nombre.required' => 'El nombre del usuario es obligatorio.',
            'usua_nombre.string' => 'El nombre del usuario debe ser una cadena de caracteres.',
            'usua_nombre.max' => 'El nombre del usuario no puede tener más de 120 caracteres.',
            'usua_apellido.required' => 'El apellido del usuario es obligatorio.',
            'usua_apellido.string' => 'El apellido del usuario debe ser una cadena de caracteres.',
            'usua_apellido.max' => 'El apellido del usuario no puede tener más de 120 caracteres.',
            'usua_documento_tipo.required' => 'El tipo de documento del usuario es obligatorio.',
            'usua_documento_tipo.in' => 'El tipo de documento del usuario debe ser DNI, RUC o CE.',
            'usua_documento_nro.required' => 'El número de documento del usuario es obligatorio.',
            'usua_documento_nro.string' => 'El número de documento del usuario debe ser una cadena de caracteres.',
            'usua_documento_nro.max' => 'El número de documento del usuario no puede tener más de 12 caracteres.',
            'usua_documento_nro.unique' => 'El número de documento del usuario ya está en uso.',
            'usua_email.required' => 'El correo electrónico del usuario es obligatorio.',
            'usua_email.email' => 'El correo electrónico del usuario debe ser una dirección de correo válida.',
            'usua_email.unique' => 'El correo electrónico del usuario ya está en uso.',
            'usua_password.required' => 'La contraseña del usuario es obligatoria.',
            'usua_password.string' => 'La contraseña del usuario debe ser una cadena de caracteres.',
            'usua_password.min' => 'La contraseña del usuario debe tener al menos 8 caracteres.',
            'usua_estado.boolean' => 'El estado del usuario debe ser un valor booleano.',
        ];
    }
}
