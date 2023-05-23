<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExamenRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {

        $examId = $this->route('examen') ? $this->route('examen')->exam_id : null;

        return [
            'exam_nombre' => 'required|max:255|unique:examenes,exam_nombre,' . $examId . ',exam_id',

            'exam_duracion' => 'required|integer',
            'exam_nota_aprobatoria' => 'required|integer',
            'secciones' => 'required|array',
            'secciones.*.secc_nombre' => 'required|string',
            'secciones.*.secc_nota_aprobatoria' => 'required|integer',
            'secciones.*.recursos' => 'nullable|array',
            'secciones.*.recursos.*.recu_nombre' => 'required|string',
            'secciones.*.recursos.*.recu_descripcion' => 'nullable|string',
            'secciones.*.recursos.*.recu_tipo' => 'required|string',
            'secciones.*.recursos.*.recu_url' => 'required|string',
            'secciones.*.recursos.*.recu_estado' => 'nullable|boolean',
            'secciones.*.preguntas' => 'required|array',
            'secciones.*.preguntas.*.preg_enunciado' => 'required|string',
            'secciones.*.preguntas.*.opciones' => 'required|array',
            'secciones.*.preguntas.*.opciones.*.opci_texto' => 'required|string',
            'secciones.*.preguntas.*.opciones.*.opci_correcta' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'exam_nombre.required' => 'El nombre del examen es obligatorio.',
            'exam_nombre.unique' => 'El nombre del examen ya está en uso.',
            'exam_nombre.max' => 'El nombre del examen no debe superar los 255 caracteres.',

            'exam_duracion.required' => 'La duración del examen es requerida.',
            'exam_duracion.integer' => 'La duración del examen debe ser un número entero.',
            'exam_nota_aprobatoria.required' => 'La nota aprobatoria del examen es requerida.',
            'exam_nota_aprobatoria.integer' => 'La nota aprobatoria del examen debe ser un número entero.',
            'secciones.required' => 'Las secciones son requeridas.',
            'secciones.array' => 'Las secciones deben ser un arreglo.',
            'secciones.*.secc_nombre.required' => 'El nombre de la sección es requerido.',
            'secciones.*.secc_nombre.string' => 'El nombre de la sección debe ser una cadena de caracteres.',
            'secciones.*.secc_nota_aprobatoria.required' => 'La nota aprobatoria de la sección es requerida.',
            'secciones.*.secc_nota_aprobatoria.integer' => 'La nota aprobatoria de la sección debe ser un número entero.',
            'secciones.*.recursos.array' => 'Los recursos deben ser un arreglo.',
            'secciones.*.recursos.*.recu_nombre.required' => 'El nombre del recurso es requerido.',
            'secciones.*.recursos.*.recu_nombre.string' => 'El nombre del recurso debe ser una cadena de caracteres.',
            'secciones.*.recursos.*.recu_descripcion.string' => 'La descripción del recurso debe ser una cadena de caracteres.',
            'secciones.*.recursos.*.recu_tipo.required' => 'El tipo del recurso es requerido.',
            'secciones.*.recursos.*.recu_tipo.string' => 'El tipo del recurso debe ser una cadena de caracteres.',
            'secciones.*.recursos.*.recu_url.required' => 'La URL del recurso es requerida.',
            'secciones.*.recursos.*.recu_url.string' => 'La URL del recurso debe ser una cadena de caracteres.',
            'secciones.*.recursos.*.recu_estado.boolean' => 'El estado del recurso debe ser verdadero o falso.',
            'secciones.*.preguntas.array' => 'Las preguntas deben ser un arreglo.',
            'secciones.*.preguntas.required' => 'Las preguntas son requeridas.',
            'secciones.*.preguntas.*.preg_enunciado.required' => 'El enunciado de la pregunta es requerido.',
            'secciones.*.preguntas.*.preg_enunciado.string' => 'El enunciado de la pregunta debe ser una cadena de caracteres.',
            'secciones.*.preguntas.*.opciones.array' => 'Las opciones deben ser un arreglo.',
            'secciones.*.preguntas.*.opciones.required' => 'Las opciones son requeridas.',
            'secciones.*.preguntas.*.opciones.*.opci_texto.required' => 'El texto de la opción es requerido.',
            'secciones.*.preguntas.*.opciones.*.opci_texto.string' => 'El texto de la opción debe ser una cadena de caracteres.',
            'secciones.*.preguntas.*.opciones.*.opci_correcta.required' => 'El valor de correcta de la opción es requerido.',
            'secciones.*.preguntas.*.opciones.*.opci_correcta.boolean' => 'El valor de correcta de la opción debe ser verdadero o falso.',
        ];
    }
}
