<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActividadRequest;
use App\Models\Actividad;
use App\Models\Area;
use App\Models\Examen;
use App\Models\Instructor;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ActividadController extends Controller
{
    protected $actividad;
    public function __construct()
    {
        $this->actividad = new Actividad();
    }
    public function index(Request $request)
    {

        return Inertia::render('Actividades/Index', [
            'actividades' => Actividad::all(),
            'areas' => Area::all(),
            'tipos' => Tipo::all(),
            'examenes' => Examen::all(),
            'instructores' => Instructor::all(),
        ]);
    }

    public function store(ActividadRequest $request)
    {
        $data = $request->all();
        Actividad::create($data);
        
        return back()->with('success', 'Recurso creada exitosamente.');
    }

}
