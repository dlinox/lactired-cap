<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    // protected $connection = 'lnx_lactired_app';
    protected $connection = 'app_lactired';
    protected $primaryKey = "empl_id";
    protected $fillable = [
        'empl_paterno',
        'empl_materno',
        'empl_nombres',
        'empl_dni',
        'empl_telefono',
        'empl_email',
        'empl_fecha_nac',
        'empl_sexo',
        'empl_fecha_inicio_actividad',
        'empl_carg_id',
        'empl_gins_id',
        'empl_prof_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'empl_fecha_nac' => 'date',
        'empl_fecha_inicio_actividad' => 'date',
    ];
}
