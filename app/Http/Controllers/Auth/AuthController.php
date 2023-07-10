<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function signIn(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->all())) {
            $request->session()->regenerate();
            return redirect('/admin');
        }

        return back()->withErrors([
            'message' => 'Credenciales incorrectas.',
            'status' => false
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        //$request->session()->regenerateToken();
        return redirect('/login');
    }
}
