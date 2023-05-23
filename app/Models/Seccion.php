<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;

    protected $table = 'secciones';
    protected $primaryKey = 'secc_id';
    protected $fillable = ['exam_id', 'secc_nombre', 'secc_nota_aprobatoria'];

    protected $casts = [
        'exam_id' => 'integer',
        'secc_nota_aprobatoria' => 'integer',
    ];

    public function examen()
    {
        return $this->belongsTo(Examen::class, 'exam_id', 'exam_id');
    }

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class, 'secc_id', 'secc_id');
    }

    public function recursos()
    {
        return $this->hasMany(Recurso::class, 'secc_id', 'secc_id');
    }
    
}
