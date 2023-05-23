<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstructorRequest;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InstructorController extends Controller
{
    protected $instructor;
    public function __construct()
    {
        $this->instructor = new Instructor();
    }
    public function index(Request $request)
    {

        $perPage = $request->input('perPage', 10);
        $query = Instructor::query();

        // Búsqueda por nombre de área
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('inst_nombre', 'like', '%' . $searchTerm . '%');
        }
        // Obtener resultados paginados
        $instructores = $query->paginate($perPage)->appends($request->query());

        return Inertia::render('Instructores/Index', [
            'instructores' => $instructores,
            'headers' => $this->instructor->headers,
            'filters' => [
                'area_estado' => $request->area_estado,
                'search' => $request->search,
            ],
            'perPageOptions' => [10, 25, 50, 100], // Opciones de cantidad de elementos por página
        ]);
    }

    public function store(InstructorRequest $request)
    {
        $data = $request->all();
        Instructor::create($data);
        return redirect()->route('admin.instructores.index')->with('success', 'Instructor creado exitosamente.');
    }

    public function update(InstructorRequest $request, Instructor $instructor)
    {
        $data = $request->all();
        $instructor->update($data);
        return redirect()->route('admin.instructores.index')->with('success', 'Instructor actualizado exitosamente.');
    }

    public function destroy(Instructor $instructor)
    {
        $instructor->delete();
        return redirect()->route('admin.instructores.index')->with('success', 'Instructor eliminado exitosamente.');
    }
}
