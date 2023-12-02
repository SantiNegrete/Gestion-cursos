<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsignacioneController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\CriteriosEvaluacionController;
use App\Http\Controllers\InstrumentacionController;
use App\Http\Controllers\PracticaController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar rutas web para tu aplicación. Estas
| rutas son cargadas por el RouteServiceProvider y todas ellas
| serán asignadas al grupo de middleware "web". ¡Haz algo grandioso!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Rutas protegidas para el rol de "Admin"
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/dash', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/temas/unidad/{unidadId}', [TemaController::class, 'index'])->name('temas.indexPorUnidad');
    Route::get('/temas/{tema}/edit', [TemaController::class, 'edit'])->name('temas.edit');

    Route::resource('asignaciones', AsignacioneController::class); 
    Route::resource('asignaturas', AsignaturaController::class);  
    Route::resource('calendario', CalendarioController::class); 
    Route::resource('criterios', CriteriosEvaluacionController::class); 
    Route::resource('instrumentacion', InstrumentacionController::class);
    Route::resource('practicas', PracticaController::class);  
    Route::resource('temas', TemaController::class); 
    Route::resource('unidades', UnidadeController::class);  
    Route::resource('usuarios', UsuarioController::class); 
    Route::resource('roles', RoleController::class)->names('roles');
});

// Rutas protegidas para el rol de "Docente"
Route::middleware(['auth', 'role:Docente'])->group(function () {
    Route::get('/docente/mis-asignaturas', [AsignacioneController::class, 'misAsignaturas'])->name('docente.mis_asignaturas');
    
    // Esta es la ruta que captura el clic en "Gestión" y muestra la vista dinámica.
    Route::get('/asignaturas/{asignatura}/gestion/{unidadId?}', [DocenteController::class, 'gestion'])
         ->name('docente/gestionCurso');

    Route::post('/docente/guardar-configuracion/{asignatura}/{unidadId}', [DocenteController::class, 'guardarConfiguracion'])
         ->name('docente.guardarConfiguracion');
});





