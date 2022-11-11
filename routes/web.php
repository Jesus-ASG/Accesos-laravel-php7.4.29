<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccesosController;
use App\Http\Controllers\EstudiantesController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\LoginController;

Route::get('/', [PagesController::class, 'index']) -> name('index');

Route::get('registrar_usuario', [PagesController::class, 'register'])-> name('register');
Route::post('registrar_usuario', [LoginController::class, 'store'])-> name('register.post');

Route::get('iniciar_sesion', [PagesController::class, 'login']) -> name('login');
Route::post('iniciar_sesion', [LoginController::class, 'login'])-> name('login.post');

Route::get('index_usuario', [PagesController::class, 'logged']) -> name('logged');
Route::get('index_admin', [PagesController::class, 'logged_admin'])->name('logged_admin');

Route::get('/logout', [LoginController::class, 'logout']) -> name('logout');


Route::get('/lector', [PagesController::class, 'lector']) -> name('lector');
Route::post('/lector', [AccesosController::class, 'store']) -> name('lector');

Route::get('/hola', function(){ return view('prueba'); }) -> name('prueba');

Route::get('ver-estudiantes', [EstudiantesController::class, 'index']) -> name('ver-estudiantes');

