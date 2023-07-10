<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';


    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => function () use ($request) {
                return [
                    'user' => $request->user() ? [
                        'id' => $request->user()->id,
                        'email' => $request->user()->email,
                        'name' => $request->user()->name,

                    ] : null,

                    'usuario' =>  $request->user() ? [
                        'id' =>   Auth::guard('usuarios')->check()  ?  $request->user()->usua_id :  null,
                        'name' =>  Auth::guard('usuarios')->check()  ? $request->user()->usua_nombre .' '. $request->user()->usua_apellido :  null,
                        'email' => Auth::guard('usuarios')->check()  ?  $request->user()->usua_email :  null,

                    ] : null,
                ];
            },

            'flash' => [
                'message' => fn () => $request->session()->get('message'),
                'success' => fn () => $request->session()->get('success'),
                'data' => fn () => $request->session()->get('data'),
            ],
        ]);
    }
}
