<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $table = 'examenes';
    protected $primaryKey = 'exam_id';
    protected $fillable = ['exam_nombre', 'exam_duracion', 'exam_nota_aprobatoria'];

    protected $casts = [
        'exam_duracion' => 'integer',
        'exam_nota_aprobatoria' => 'integer',
    ];

    public $headers =  [
        ['text' => "ID", 'value' => "exam_id", 'short' => false, 'order' => 'ASC'],
        ['text' => "Nombre", 'value' => "exam_nombre", 'short' => false, 'order' => 'ASC'],
    ];

    

    //protected $with = ['secciones'];
    protected $withCount = ['secciones'];

    public function secciones()
    {
        return $this->hasMany(Seccion::class, 'exam_id', 'exam_id');
    }

    protected $hidden = [
        'exam_duracion',
        'exam_nota_aprobatoria',
        'created_at',
        'updated_at'
    ];
}
