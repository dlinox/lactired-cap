<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $primaryKey = 'area_id';

    protected $fillable = [
        'area_nombre',
        'area_descripcion',
        'area_estado',
    ];

    protected $casts = [
        'area_estado' => 'boolean',
    ];

    public $headers =  [
        ['text' => "ID", 'value' => "area_id", 'short' => false, 'order' => 'ASC'],
        ['text' => "Nombre", 'value' => "area_nombre", 'short' => false, 'order' => 'ASC'],
        ['text' => "Descripción", 'value' => "area_descripcion", 'short' => false, 'order' => 'ASC'],
        ['text' => "Estado", 'value' => "area_estado", 'short' => false, 'order' => 'ASC'],
    ];


    // Función para crear un nuevo registro de área
    public static function createArea($data)
    {
        return self::create($data);
    }

    // Función para obtener todos los registros de áreas
    public static function getAllAreas()
    {
        return self::all();
    }

    // Función para obtener un registro de área por su ID
    public static function getAreaById($id)
    {
        return self::findOrFail($id);
    }

    // Función para actualizar un registro de área
    public function updateArea($data)
    {
        return $this->update($data);
    }

    // Función para eliminar un registro de área
    public function deleteArea()
    {
        return $this->delete();
    }
}
