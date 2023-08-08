<?php

namespace App\Http\Controllers\Usuario\Auth;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Inertia\Inertia;


class AuthController extends Controller
{

    protected $redirectTo = '/u';

    public function __construct()
    {
        $this->middleware('guest:usuarios')->except('logout');
    }

    public function login()
    {
        return Inertia::render('Usuario/Auth/Login');
    }

    public function register()
    {
        return Inertia::render('Usuario/Auth/Register');
    }

    public function getEmpleado(Request $request)
    {
        $empleado  = Empleado::select('empl_id', 'empl_email', 'empl_nombres', 'plan_razon_social')
            ->join('planta_empleados', 'plem_empl_id', '=', 'empl_id')
            ->join('plantas', 'plem_plan_id', '=', 'plan_id')
            ->where('empl_dni', $request->dni)->first();

        if ($empleado) {

            $partes = explode("@", $empleado->empl_email);
            $parte1 = substr($partes[0], 0, 3);
            $parte2 = str_repeat("*", strlen($partes[0]) - 3);
            $anonimizado = $parte1 . $parte2 . "@" . $partes[1];

            $data = [
                'id' => $empleado->empl_id,
                'email' => $anonimizado,
                'nombre' => $empleado->empl_nombres,
                'planta' => $empleado->plan_razon_social
            ];
            return back()->with(['success' =>  'Usuario encontrado.', 'data' => $data]);
        } else {
            return back()->withErrors(['error' => 'Error.', 'details' => 'No hay un usuario con el número de DNI proporcionado']);
        }
    }

    public function signIn(Request $request)
    {

        $request->validate([
            'usua_documento_nro' => 'required',
            'usua_password' => 'required',
        ]);

        $credentials = ['usua_documento_nro' => $request->usua_documento_nro, 'password' => $request->usua_password];

        if (auth()->guard('usuarios')->attempt($credentials)) {
            // Autenticación exitosa
            return redirect()->intended($this->redirectTo);
        } else {
            // Autenticación fallida
            return redirect()->back()->withErrors([
                'usua_documento_nro' => 'Las credenciales no son válidas.',
            ]);
        }
    }

    public function logout(Request $request)
    {

        Auth::guard('usuarios')->logout();
        $request->session()->invalidate();
        //$request->session()->regenerateToken();
        return redirect('/u/login');
    }
}
