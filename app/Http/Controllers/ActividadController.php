<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActividadRequest;
use App\Models\Actividad;
use App\Models\Area;
use App\Models\Examen;
use App\Models\Instructor;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $perPage = $request->input('perPage', 10);
        $query = Actividad::query();

        // Búsqueda por nombre de área
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('acti_tema', 'like', '%' . $searchTerm . '%');
        }

        // Obtener resultados paginados
        $actividades = $query->paginate($perPage)->appends($request->query());


        return Inertia::render('Actividades/Index', [

            'headers' => $this->actividad->headers,
            'actividades' => $actividades,
            'areas' => Area::all(),
            'tipos' => Tipo::all(),
            'examenes' => Examen::all(),
            'instructores' => Instructor::all(),

            'filters' => [
                'search' => $request->search,
            ],
            'perPageOptions' => [10, 25, 50, 100], // Opciones de cantidad de elementos por página

        ]);
    }

    public function store(ActividadRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->all();
                Actividad::create($data);
                // return to_route('ventas.create')->with('success', 'Venta registrada con exito.');
                return back()->with('success', 'Actividad registrada con exito.');
            });
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => 'Se ha producido un error inesperado. Si el problema persiste, te recomendamos que te pongas en contacto con el administrador para obtener ayuda adicional.', 'details' => $th->getMessage()]);
        }
    }
}
