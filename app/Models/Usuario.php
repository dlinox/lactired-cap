<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Usuario extends Model
{
    use HasFactory;

    protected $primaryKey = 'usua_id';

    protected $fillable = [
        'usua_nombre',
        'usua_apellido',
        'usua_documento_tipo',
        'usua_documento_nro',
        'usua_email',
        'usua_password',
        'usua_estado',
    ];

    protected $hidden = [
        'usua_password',
    ];

    protected $casts = [
        'usua_estado' => 'boolean',
    ];
 
    protected function usuaPassword(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value),
        );
    }

    public $headers =  [
        ['text' => "ID", 'value' => "usua_id", 'short' => false, 'order' => 'ASC'],
        ['text' => "Nombre", 'value' => "usua_nombre", 'short' => false, 'order' => 'ASC'],
        ['text' => "Apellidos", 'value' => "usua_apellido", 'short' => false, 'order' => 'ASC'],
        ['text' => "Doc. Tipo", 'value' => "usua_documento_tipo", 'short' => false, 'order' => 'ASC'],
        ['text' => "Doc. Nro", 'value' => "usua_documento_nro", 'short' => false, 'order' => 'ASC'],
        ['text' => "Correo", 'value' => "usua_email", 'short' => false, 'order' => 'ASC'],
        ['text' => "Estado", 'value' => "usua_estado", 'short' => false, 'order' => 'ASC'],
    ];

    public function getFullNameAttribute()
    {
        return $this->usua_nombre . ' ' . $this->usua_apellido;
    }
}
