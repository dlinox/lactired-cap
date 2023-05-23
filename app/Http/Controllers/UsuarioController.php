<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UsuarioController extends Controller
{
    protected $usuario;
    public function __construct()
    {
        $this->usuario = new Usuario();
    }
    public function index(Request $request)
    {

        $perPage = $request->input('perPage', 10);
        $query = Usuario::query();

        // Búsqueda por nombre de área
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('usua_nombre', 'like', '%' . $searchTerm . '%');
        }

        // Obtener resultados paginados
        $usuarios = $query->paginate($perPage)->appends($request->query());

        return Inertia::render('Usuarios/Index', [

            'usuarios' => $usuarios,
            'headers' => $this->usuario->headers,

            'filters' => [
                'area_estado' => $request->area_estado,
                'search' => $request->search,
            ],
            'perPageOptions' => [10, 25, 50, 100], // Opciones de cantidad de elementos por página
        ]);
    }

    public function store(UsuarioRequest $request)
    {
        $data = $request->all();
        Usuario::create($data);
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creada exitosamente.');
    }

    public function update(UsuarioRequest $request, Usuario $usuario)
    {
        $data = $request->all();
        $usuario->update($data);
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminada exitosamente.');
    }
}
