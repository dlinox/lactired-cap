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
    return Inertia::render('Home');
})->middleware('auth');


Route::get('/login', function () {
    return Inertia::render('Auth/Login');
})->name('login')->middleware('guest');


Route::post('/sign-in',  [AuthController::class, 'signIn'])->name('sign-in');
Route::delete('/logout',  [AuthController::class, 'logout'])->name('logout');

Route::name('admin.')->prefix('admin')->middleware('auth')->group(function () {
    Route::get('', function () {
        return Inertia::render('Home');
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
