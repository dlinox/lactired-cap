<?php

namespace App\Models;

use Carbon\Carbon;
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

    public $headers =  [
        ['text' => "ID", 'value' => "acti_id", 'short' => false, 'order' => 'ASC'],
        ['text' => "Nombre", 'value' => "acti_tema", 'short' => false, 'order' => 'ASC'],
        ['text' => "Descripción", 'value' => "acti_descripcion", 'short' => false, 'order' => 'ASC'],
    ];


    protected $appends = ['fecha', 'estado'];


    public function getEstadoAttribute()
    {
        return $this->fechaEstado()[1];
    }

    public function getFechaAttribute()
    {
        return $this->fechaEstado()[0];
    }

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


    static public function getAll()
    {
        $all = self::all(
            'acti_id',
            'acti_tema',
            'acti_descripcion',
            'acti_fecha_inicio',
            'acti_fecha_fin',
            'acti_modalidad',
            'acti_estado',
            'acti_tipo_id',
            'acti_area_id',
            'acti_exam_id',
        );

        $all->load([
            'tipo:tipo_id,tipo_nombre',
            'area:area_id,area_nombre',
            'examen'
        ]);

        return $all;
    }

    static public function getSeccionActividad(){

    }

    function fechaEstado()
    {

        $fechaInicio = Carbon::parse($this->acti_fecha_inicio);
        $fechaFin = Carbon::parse($this->acti_fecha_fin);
        $hoy = Carbon::now();

        $diasRestantes = $fechaInicio->diffInDays($hoy);

        $fecha = "";
        $estado = null;

        if ($hoy < $fechaInicio) {
            // Aún falta para la fecha de inicio
            $diasRestantes = $fechaInicio->diffInDays($hoy);
            $fecha =  "Empieza en $diasRestantes día(s).";

            $estado = false;
        } elseif ($hoy >= $fechaInicio && $hoy <= $fechaFin) {
            // Estamos dentro del rango de fechas
            $diasRestantes = $hoy->diffInDays($fechaFin);
            $fecha =  "Termina en $diasRestantes día(s).";
            $estado = true;
        } else {
            // La fecha de fin ya ha pasado
            $estado = false;
            $fecha =  "Finalizó.";
        }
        return [$fecha, $estado];
    }
}
