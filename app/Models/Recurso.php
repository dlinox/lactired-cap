<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    use HasFactory;

    protected $primaryKey = 'recu_id';
    protected $fillable = [
        'recu_nombre',
        'recu_descripcion',
        'recu_tipo',
        'recu_url',
        'recu_estado',
    ];

    protected $casts = [
        'recu_estado' => 'boolean',
    ];

    public $headers =  [
        ['text' => "ID", 'value' => "recu_id", 'short' => false, 'order' => 'ASC'],
        ['text' => "Nombre", 'value' => "recu_nombre", 'short' => false, 'order' => 'ASC'],
        ['text' => "Descripción", 'value' => "recu_descripcion", 'short' => false, 'order' => 'ASC'],
        ['text' => "Tipo", 'value' => "recu_tipo", 'short' => false, 'order' => 'ASC'],
        ['text' => "Recurso", 'value' => "recu_url", 'short' => false, 'order' => 'ASC'],
        ['text' => "Estado", 'value' => "recu_estado", 'short' => false, 'order' => 'ASC'],
    ];

    public function seccion()
    {
        return $this->belongsTo(Seccion::class, 'secc_id', 'secc_id');
    }
}
