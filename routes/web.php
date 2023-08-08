<?php

use App\Http\Controllers\ActividadController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\RecursoController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login');
})->middleware('guest');


Route::get('/login', function () {
    return Inertia::render('Auth/Login');
})->name('login')->middleware('guest');


Route::post('/sign-in',  [AuthController::class, 'signIn'])->name('sign-in');
Route::delete('/logout',  [AuthController::class, 'logout'])->name('logout');

Route::name('admin.')->prefix('admin')->middleware('auth')->group(function () {
    Route::get('', function () {
        return Inertia::render('Dashboard');
    });
    Route::resource('areas', AreaController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('tipos', TipoController::class);
    Route::resource('recursos', RecursoController::class);
    Route::resource('instructores', InstructorController::class)->parameters([
        'instructores' => 'instructor',
    ]);
    Route::resource('examenes', ExamenController::class)->parameters([
        'examenes' => 'examen',
    ]);
    Route::resource('actividades', ActividadController::class)->parameters([
        'actividades' => 'actividad',
    ]);
});


Route::name('u.')->prefix('u')->group(function () {

    Route::get('', [App\Http\Controllers\Usuario\PortalController::class, 'index'])->name('index')->middleware('auth:usuarios');

    Route::post('actividad/iniciar', [App\Http\Controllers\Usuario\PortalController::class, 'iniciarActividad'])->name('iniciar')->middleware('auth:usuarios');
    Route::post('actividad/siguiente-seccion', [App\Http\Controllers\Usuario\PortalController::class, 'siguienteSeccion'])->name('siguiente-seccion')->middleware('auth:usuarios');
    Route::get('actividad/{actividad}', [App\Http\Controllers\Usuario\PortalController::class, 'participarActividad'])->name('actividad')->middleware('auth:usuarios');



    Route::get('/login',  [App\Http\Controllers\Usuario\Auth\AuthController::class, 'login'])->name('login');
    Route::get('/register',  [App\Http\Controllers\Usuario\Auth\AuthController::class, 'register'])->name('register');
    
    Route::get('/get-empleado',  [App\Http\Controllers\Usuario\Auth\AuthController::class, 'getEmpleado'])->name('get-empleado');

    Route::post('/sign-in',  [App\Http\Controllers\Usuario\Auth\AuthController::class, 'signIn'])->name('sign-in');
    Route::delete('/logout',  [App\Http\Controllers\Usuario\Auth\AuthController::class, 'logout'])->name('logout');
});
