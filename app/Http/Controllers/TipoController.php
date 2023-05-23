<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoRequest;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TipoController extends Controller
{
    protected $tipo;
    public function __construct()
    {
        $this->tipo = new Tipo();
    }
    public function index(Request $request)
    {

        $perPage = $request->input('perPage', 10);
        $query = Tipo::query();

        // Búsqueda por nombre de área
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('tipo_nombre', 'like', '%' . $searchTerm . '%');
        }

        // Obtener resultados paginados
        $tipos = $query->paginate($perPage)->appends($request->query());


        return Inertia::render('Tipos/Index', [
            'tipos' => $tipos,
            'headers' => $this->tipo->headers,
            'filters' => [
                'tipo_estado' => $request->tipo_estado,
                'search' => $request->search,
            ],
            'perPageOptions' => [10, 25, 50, 100], // Opciones de cantidad de elementos por página
        ]);
    }

    public function store(TipoRequest $request)
    {
        $data = $request->all();
        Tipo::create($data);
        return redirect()->route('admin.tipos.index')->with('success', 'Área creada exitosamente.');
    }

    public function update(TipoRequest $request, Tipo $tipo)
    {
        $data = $request->all();
        $tipo->update($data);
        return redirect()->route('admin.tipos.index')->with('success', 'Área actualizada exitosamente.');
    }

    public function destroy(Tipo $tipo)
    {
        $tipo->delete();
        return redirect()->route('admin.tipos.index')->with('success', 'Área eliminada exitosamente.');
    }
}
