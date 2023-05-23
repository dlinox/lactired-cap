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

    protected $with = ['secciones'];

    public function secciones()
    {
        return $this->hasMany(Seccion::class, 'exam_id', 'exam_id');
    }
}
