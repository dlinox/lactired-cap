<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participacion extends Model
{
    use HasFactory;

    protected $table = 'participaciones';
    protected $primaryKey = 'part_id';

    protected $fillable = [
        'part_seccion_actual',
        'part_secciones_total',
        'part_fechas',
        'part_finalizada',
        'part_acti_id',
        'part_usua_id',
    ];

    protected $casts = [
        'part_finalizada' => 'boolean',
    ];
}
