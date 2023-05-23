<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $table = 'preguntas';
    protected $primaryKey = 'preg_id';
    protected $fillable = ['secc_id', 'preg_enunciado'];

    public function seccion()
    {
        return $this->belongsTo(Seccion::class, 'secc_id', 'secc_id');
    }

    public function opciones()
    {
        return $this->hasMany(Opcion::class, 'preg_id', 'preg_id');
    }
    
}
