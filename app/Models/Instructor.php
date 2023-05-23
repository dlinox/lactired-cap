<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Instructor extends Model
{
    use HasFactory;

    protected $table = 'instructores';
    protected $primaryKey = 'inst_id';
    protected $fillable = [
        'inst_nombre',
        'inst_apellido',
        'inst_documento_tipo',
        'inst_documento_nro',
        'inst_email',
        'inst_estado',
    ];

    protected $hidden = [
        'inst_password',
    ];


    protected $casts = [
        'inst_estado' => 'boolean',
    ];

    protected $appends = ['nombre'];

    protected function instPassword(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make(Str::random(8)),
        );
    }

    public function getNombreAttribute()
    {
        return $this->inst_nombre . ' ' . $this->inst_apellido;
    }

    public $headers =  [
        ['text' => "ID", 'value' => "inst_id", 'short' => false, 'order' => 'ASC'],
        ['text' => "Nombre", 'value' => "inst_nombre", 'short' => false, 'order' => 'ASC'],
        ['text' => "Apellidos", 'value' => "inst_apellido", 'short' => false, 'order' => 'ASC'],
        ['text' => "Doc. Tipo", 'value' => "inst_documento_tipo", 'short' => false, 'order' => 'ASC'],
        ['text' => "Doc. Nro", 'value' => "inst_documento_nro", 'short' => false, 'order' => 'ASC'],
        ['text' => "Correo", 'value' => "inst_email", 'short' => false, 'order' => 'ASC'],
        ['text' => "Estado", 'value' => "inst_estado", 'short' => false, 'order' => 'ASC'],
    ];
}
