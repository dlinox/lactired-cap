<?php

namespace App\Http\Controllers;

use App\Http\Requests\AreaRequest;
use App\Models\Area;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AreaController extends Controller
{

    protected $area;
    public function __construct()
    {
        $this->area = new Area();
    }
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $query = Area::query();

        // Filtro por área estado
        if ($request->has('area_estado')) {
            $areaEstado = $request->area_estado;
            $query->where('area_estado', $areaEstado);
        }

        // Búsqueda por nombre de área
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('area_nombre', 'like', '%' . $searchTerm . '%');
        }

        // Obtener resultados paginados
        $areas = $query->paginate($perPage)->appends($request->query());

        return Inertia::render('Areas/Index', [
            'areas' => $areas,
            'headers' => $this->area->headers,
            'filters' => [
                'area_estado' => $request->area_estado,
                'search' => $request->search,
            ],
            'perPageOptions' => [10, 25, 50, 100], // Opciones de cantidad de elementos por página
        ]);
    }

    public function create()
    {
        return Inertia::render('Areas/Create');
    }

    public function store(AreaRequest $request)
    {
        $data = $request->all();
        Area::create($data);
        return redirect()->route('admin.areas.index')->with('success', 'Área creada exitosamente.');
    }

    public function edit(Area $area)
    {
        return Inertia::render('Areas/Edit', [
            'area' => $area,
        ]);
    }

    public function update(AreaRequest $request, Area $area)
    {
        $data = $request->all();
        $area->update($data);
        return redirect()->route('admin.areas.index')->with('success', 'Área actualizada exitosamente.');
    }

    public function destroy(Area $area)
    {
        $area->delete();
        return redirect()->route('admin.areas.index')->with('success', 'Área eliminada exitosamente.');
    }
}
