<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\Actividad;
use App\Models\Opcion;
use App\Models\Participacion;
use App\Models\Pregunta;
use App\Models\Seccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PortalController extends Controller
{

    public function index()
    {
        return Inertia::render('Usuario/Home', [
            'actividades' => Actividad::getAll(),
        ]);
    }

    public function iniciarActividad(Request $request)
    {
        $actividad  = $request->actividad;


        $participacion = Participacion::where('part_acti_id', $actividad)->where('part_usua_id', Auth::user()->usua_id)->first();

        if ($participacion) {
            return redirect('/u/actividad/' . $actividad)->with('success', 'Participacion iniciada.');
        }

        $data = [
            'part_secciones_total' => $request->secciones,
            'part_acti_id' => $actividad,
            'part_usua_id' => Auth::user()->usua_id,
        ];

        Participacion::create($data);

        return redirect('/u/actividad/' . $actividad)->with('success', 'Participacion iniciada.');
    }

    public function participarActividad($actividad)
    {
        $participacion = Participacion::where('part_acti_id', $actividad)->where('part_usua_id', Auth::user()->usua_id)->first();

        if ($participacion) {



            $_actividad = Actividad::with([
                'tipo:tipo_id,tipo_nombre',
                'examen' =>  function ($query) {
                    $query->select('exam_id', 'exam_nombre')->withCount('secciones');
                },
                'area:area_id,area_nombre'
            ])->find($actividad);

            $seccion = $participacion->part_seccion_actual == 0
                ? null
                : Seccion::where('exam_id', $_actividad->examen->exam_id)->orderby('secc_id')->get()[$participacion->part_seccion_actual - 1];

            return Inertia::render('Usuario/Actividad', [
                'actividad' => $_actividad,
                'participacion' => $participacion,
                'seccion' => $seccion,

            ]);
        }

        return redirect('/u')->withErrors('success', 'No es participante.');
    }

    public function siguienteSeccion(Request $request)
    {
        $participacion = Participacion::where('part_acti_id', $request->acti_id)->where('part_usua_id', Auth::user()->usua_id)->first();

        if ($participacion) {

            if ($request->preguntas) {

                $errors =  $this->validarRespuesta($request);

                if ($errors > 0) {
                    return back()->withErrors(['error' => '--------------- Respuesta incorrectas: ' . $errors, 'details' => 'Estimado usuario,
                    Hemos revisado sus respuestas y lamentamos informarle que algunas de ellas no son correctas.']);
                }
            }

            if ($participacion->part_seccion_actual === $participacion->part_secciones_total) {
                $participacion->update(['part_finalizada' => 1]);
            } else {
                $participacion->update(['part_seccion_actual' => $participacion->part_seccion_actual + 1]);
            }
        }

        $this->participarActividad($request->acti_id);
    }

    private function validarRespuesta($repuesta)
    {

        $errors = 0;
        foreach ($repuesta->preguntas as  $pregunta) {
            $opcionSeleccionadaId = $pregunta['respuesta'];

            $opcion = Opcion::where('preg_id', $pregunta['preg_id'])
                ->where('opci_id', $opcionSeleccionadaId)
                ->where('opci_correcta', true)
                ->first();

            if (!$opcion) {
                $errors++;
            }
        }

        return $errors;
    }
}
