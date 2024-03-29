<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccesosController;
use App\Http\Controllers\EspaciosController;
use App\Http\Controllers\EstudiantesController;
use App\Http\Controllers\AdminEstudiantesController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\LoginController;

Route::get('/', [PagesController::class, 'index']) -> name('index');

Route::get('registrar_usuario', [PagesController::class, 'register'])-> name('register');
Route::post('registrar_usuario', [LoginController::class, 'store'])-> name('register.post');

Route::get('iniciar_sesion', [PagesController::class, 'login']) -> name('login');
Route::post('iniciar_sesion', [LoginController::class, 'login'])-> name('login.post');
Route::get('/logout', [LoginController::class, 'logout']) -> name('logout');

Route::get('/lector', [AccesosController::class, 'lector']) -> name('lector')->middleware('auth');
Route::post('/lector', [AccesosController::class, 'store']) -> name('lector')->middleware('auth');

Route::get('/espacios', [EspaciosController::class, 'index']) -> name('espacios')->middleware('auth');
Route::post('/espacios', [EspaciosController::class, 'store']) -> name('espacios.store')->middleware('auth');
Route::put('/espacios/{espacio}', [EspaciosController::class, 'update']) -> name('espacios.update')->middleware('auth');
Route::delete('/espacios/{espacio}', [EspaciosController::class, 'destroy']) -> name('espacios.destroy')->middleware('auth');

Route::get('accesos', [AccesosController::class, 'index']) -> name('accesos')->middleware('auth');
Route::post('accesos', [AccesosController::class, 'filter']) -> name('accesos.filter')->middleware('auth');

Route::get('/estudiantes', [AdminEstudiantesController::class, 'index']) -> name('estudiantes')->middleware('auth');
Route::post('/estudiantes', [AdminEstudiantesController::class, 'storeMany']) -> name('estudiantes.storeMany')->middleware('auth');
Route::get('filter_estudiantes/', [AdminEstudiantesController::class, 'filter']) -> name('estudiantes.filter')->middleware('auth');
Route::put('/estudiantes/{estudiante_id}', [AdminEstudiantesController::class, 'update']) -> name('estudiantes.update')->middleware('auth');
Route::delete('/estudiantes/{estudiante_id}', [AdminEstudiantesController::class, 'destroy']) -> name('estudiantes.destroy')->middleware('auth');

Route::get('politicas', [PagesController::class, 'politicas']) -> name('politicas');

