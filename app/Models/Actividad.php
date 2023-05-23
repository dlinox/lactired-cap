<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;
    protected $table = "actividades";
    protected $primaryKey = 'acti_id';

    protected $casts = [
        'acti_fecha_inicio' => 'date',
        'acti_fecha_fin' => 'date',
        'acti_estado' => 'boolean',
    ];

    protected $fillable = [
        'acti_tema',
        'acti_descripcion',
        'acti_fecha_inicio',
        'acti_fecha_fin',
        'acti_modalidad',
        'acti_anio',
        'acti_estado',
        'acti_tipo_id',
        'acti_area_id',
        'acti_inst_id',
        'acti_exam_id',
    ];

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'acti_tipo_id', 'tipo_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'acti_area_id', 'area_id');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'acti_inst_id', 'inst_id');
    }

    public function examen()
    {
        return $this->belongsTo(Examen::class, 'acti_exam_id', 'exam_id');
    }
}
