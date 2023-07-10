<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamenRequest;
use App\Models\Examen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ExamenController extends Controller
{

    protected $examen;
    public function __construct()
    {
        $this->examen = new Examen();
    }


    public function index(Request $request)
    {

        $perPage = $request->input('perPage', 10);
        $query = Examen::query();

        // Búsqueda por nombre de área
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('exam_nombre', 'like', '%' . $searchTerm . '%');
        }

        // Obtener resultados paginados
        $examenes = $query->paginate($perPage)->appends($request->query());


        return Inertia::render('Examenes/Index', [
            'examenes' => $examenes,
            'headers' => $this->examen->headers,

            'filters' => [

                'search' => $request->search,
            ],
            'perPageOptions' => [10, 25, 50, 100], // Opciones de cantidad de elementos por página
        ]);
    }


    public function create()
    {

        return Inertia::render('Examenes/Create');
    }


    public function store(StoreExamenRequest $request)
    {

        try {
            DB::transaction(function () use ($request) {

                // Validar los datos del examen
                $validatedData = $request->validated();

                // Crear un nuevo examen con los datos validados
                $examen = Examen::create([
                    'exam_nombre' => $validatedData['exam_nombre'],
                    'exam_duracion' => $validatedData['exam_duracion'],
                    'exam_nota_aprobatoria' => $validatedData['exam_nota_aprobatoria'],
                ]);

                // Agregar secciones al examen
                foreach ($validatedData['secciones'] as $seccionData) {
                    $seccion = $examen->secciones()->create([
                        'secc_nombre' => $seccionData['secc_nombre'],
                        'secc_nota_aprobatoria' => $seccionData['secc_nota_aprobatoria'],
                    ]);

                    // Agregar recursos a la sección (si existen)
                    if (isset($seccionData['recursos'])) {
                        foreach ($seccionData['recursos'] as $recursoData) {
                            $seccion->recursos()->create([
                                'recu_nombre' => $recursoData['recu_nombre'],
                                'recu_descripcion' => $recursoData['recu_descripcion'],
                                'recu_tipo' => $recursoData['recu_tipo'],
                                'recu_url' => $recursoData['recu_url'],
                                'recu_estado' => $recursoData['recu_estado'],
                            ]);
                        }
                    }

                    // Agregar preguntas a la sección (si existen)
                    if (isset($seccionData['preguntas'])) {
                        foreach ($seccionData['preguntas'] as $preguntaData) {
                            $pregunta = $seccion->preguntas()->create([
                                'preg_enunciado' => $preguntaData['preg_enunciado'],
                            ]);

                            // Agregar opciones a la pregunta
                            foreach ($preguntaData['opciones'] as $opcionData) {
                                $pregunta->opciones()->create([
                                    'opci_texto' => $opcionData['opci_texto'],
                                    'opci_correcta' => $opcionData['opci_correcta'],
                                ]);
                            }
                        }
                    }
                }
           
                return redirect('admin.examenes.index')->with('success', 'Examen registrado con exito.');
            });
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => 'Se ha producido un error inesperado. Si el problema persiste, te recomendamos que te pongas en contacto con el administrador para obtener ayuda adicional.', 'details' => $th->getMessage()]);
        }
    }

    public function show(Examen $examen)
    {
        //
    }


    public function edit(Examen $examen)
    {
        //
    }


    public function update(Request $request, Examen $examen)
    {
        //
    }

    public function destroy(Examen $examen)
    {
        //
    }
}
