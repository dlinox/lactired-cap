<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecursoRequest;
use App\Models\Recurso;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecursoController extends Controller
{
    protected $recurso;
    public function __construct()
    {
        $this->recurso = new Recurso();
    }
    public function index(Request $request)
    {

        $perPage = $request->input('perPage', 10);
        $query = Recurso::query();

        // Búsqueda por nombre de área
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('recu_nombre', 'like', '%' . $searchTerm . '%');
        }

        // Obtener resultados paginados
        $recursos = $query->paginate($perPage)->appends($request->query());

        return Inertia::render('Recursos/Index', [

            'recursos' => $recursos,
            'headers' => $this->recurso->headers,

            'filters' => [
                'recu_estado' => $request->area_estado,
                'search' => $request->search,
            ],
            'perPageOptions' => [10, 25, 50, 100], // Opciones de cantidad de elementos por página
        ]);
    }

    public function store(RecursoRequest $request)
    {
        $data = $request->all();
        Recurso::create($data);
        
        return redirect()->route('admin.recursos.index')->with('success', 'Recurso creada exitosamente.');
    }

    public function update(RecursoRequest $request, Recurso $recurso)
    {
        $data = $request->all();
        $recurso->update($data);
        return redirect()->route('admin.recursos.index')->with('success', 'Recurso actualizada exitosamente.');
    }

    public function destroy(Recurso $recurso)
    {
        $recurso->delete();
        return redirect()->route('admin.recursos.index')->with('success', 'Recurso eliminada exitosamente.');
    }
}
