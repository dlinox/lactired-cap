<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActividadRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('actividad') ? $this->route('actividad')->acti_id : null;

        return [
            'acti_tema' => 'required|string|unique:actividades,acti_tema,' . $id . ',acti_id|max:255',
            'acti_descripcion' => 'nullable|string',
            'acti_fecha_inicio' => 'nullable|date',
            'acti_fecha_fin' => 'nullable|date|after_or_equal:acti_fecha_inicio',
            'acti_anio' => 'nullable|digits:4',
            'acti_estado' => 'nullable|boolean',
            'acti_modalidad' => 'required|in:VIRTUAL,PRESENCIAL',
            'acti_tipo_id' => 'required|exists:tipos,tipo_id',
            'acti_area_id' => 'required|exists:areas,area_id',
            'acti_inst_id' => 'nullable|exists:instructores,inst_id',
            'acti_exam_id' => 'nullable|exists:examenes,exam_id',
        ];
    }

    public function messages()
    {
        return [
            'acti_tema.required' => 'El tema de la actividad es obligatorio.',
            'acti_tema.string' => 'El tema de la actividad debe ser una cadena de caracteres.',
            'acti_tema.unique' => 'El tema de la actividad ya está en uso.',
            'acti_tema.max' => 'El tema de la actividad no puede tener más de 255 caracteres.',
            'acti_descripcion.string' => 'La descripción de la actividad debe ser una cadena de caracteres.',
            'acti_fecha_inicio.date' => 'La fecha de inicio de la actividad debe ser una fecha válida.',
            'acti_fecha_fin.date' => 'La fecha de fin de la actividad debe ser una fecha válida.',
            'acti_fecha_fin.after_or_equal' => 'La fecha de fin de la actividad debe ser igual o posterior a la fecha de inicio.',
            'acti_anio.digits' => 'El año de la actividad debe tener 4 dígitos.',
            'acti_estado.boolean' => 'El estado de la actividad debe ser un valor booleano.',
            'acti_modalidad.required' => 'La modalidad es requerida.',
            'acti_modalidad.in' => 'La modalidad seleccionada no es válida.',
            'acti_tipo_id.required' => 'El tipo es requerido.',
            'acti_tipo_id.exists' => 'El tipo seleccionado no existe.',
            'acti_area_id.required' => 'El área es requerida.',
            'acti_area_id.exists' => 'El área seleccionada no existe.',
            'acti_inst_id.exists' => 'El instructor seleccionado no existe.',
            'acti_exam_id.exists' => 'El examen seleccionado no existe.',
        ];
    }
}
