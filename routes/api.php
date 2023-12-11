<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AsignaturasAPIController;
use App\Http\Controllers\API\UnidadesAPIController;
use App\Http\Controllers\API\TemasAPIController;
use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\AuthController;
use \App\Http\Controllers\API\DashboardTeacherController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/





// Ruta para AuthAPIController
Route::post('login', [AuthController::class, 'login']);

//Route::get('dashboardTeacher', [DashboardTeacherController::class, 'dashboardTeacher']);

Route::get('dashboardTeacher', [DashboardTeacherController::class, 'dashboardTeacher'])->middleware('auth:sanctum');
Route::get('/gestion/{id_materia}', [DashboardTeacherController::class, 'gestion'])->middleware('auth:sanctum');
Route::post('/gestion/update', [DashboardTeacherController::class, 'actualizar']);






Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function (){
Route::apiResource('asignaturas', AsignaturasAPIController::class);
// Rutas para UnidadesAPIController
Route::get('/unidades', [UnidadesAPIController::class, 'index']);
Route::post('/unidades', [UnidadesAPIController::class, 'store']);
Route::get('/unidades/{id}', [UnidadesAPIController::class, 'show']);
Route::put('/unidades/{id}', [UnidadesAPIController::class, 'update']);
Route::delete('/unidades/{id}', [UnidadesAPIController::class, 'destroy']);

// Rutas para TemasAPIController 
Route::get('/unidades/{unidadId}/temas', [TemasAPIController::class, 'index']);
Route::post('/temas', [TemasAPIController::class, 'store']);
Route::get('/temas/{id}', [TemasAPIController::class, 'show']);
Route::put('/temas/{id}', [TemasAPIController::class, 'update']);
Route::delete('/temas/{id}', [TemasAPIController::class, 'destroy']);

});






