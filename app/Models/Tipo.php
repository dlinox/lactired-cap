<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;
    protected $primaryKey = 'tipo_id';
    protected $fillable = [
        'tipo_nombre',
        'tipo_descripcion',
        'tipo_estado',
    ];

    public $headers =  [
        ['text' => "ID", 'value' => "tipo_id", 'short' => false, 'order' => 'ASC'],
        ['text' => "Nombre", 'value' => "tipo_nombre", 'short' => false, 'order' => 'ASC'],
        ['text' => "Descripción", 'value' => "tipo_descripcion", 'short' => false, 'order' => 'ASC'],
        ['text' => "Estado", 'value' => "tipo_estado", 'short' => false, 'order' => 'ASC'],
    ];
}
