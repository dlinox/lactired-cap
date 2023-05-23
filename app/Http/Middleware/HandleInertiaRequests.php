<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Closure;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';


    // public function handle(Request $request, Closure $next)
    // {
    //     // Verificar si la sesión ha expirado
    //     if (session()->hasExpired()) {
    //         // Realizar cualquier acción necesaria cuando la sesión ha expirado
    //         // Por ejemplo, redireccionar a la página de inicio de sesión
    //         return redirect('/login');
    //     }

    //     return parent::handle($request, $next);
    // }

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            //
        ]);
    }
}
