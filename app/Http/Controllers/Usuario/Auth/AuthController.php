<?php

namespace App\Http\Controllers\Usuario\Auth;

use App\Http\Controllers\Controller;
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

    public function logout(Request $request){

        Auth::guard('usuarios')->logout();
        $request->session()->invalidate();
        //$request->session()->regenerateToken();
        return redirect('/u/login');

    }

}
