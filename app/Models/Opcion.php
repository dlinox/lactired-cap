<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opcion extends Model
{
    use HasFactory;

    protected $table = 'opciones';
    protected $primaryKey = 'opci_id';
    protected $fillable = ['preg_id', 'opci_texto', 'opci_correcta'];

    protected $casts = [
        'opci_correcta' => 'boolean',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        //'opci_correcta',
    ];


    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'preg_id', 'preg_id');
    }
    
}
