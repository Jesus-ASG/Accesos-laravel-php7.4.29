<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Htpp\Controllers\EstudiantesController;
use App\Http\Controllers\EstudiantesController as ControllersEstudiantesController;
use App\Models\Espacio;

class PagesController extends Controller
{
    
    public function index(){
        if (Auth::check()) {
            $user = Auth::user();
            return redirect(route('lector'));
        }
        else{
            return redirect(route('login'));
        }
    }

    public function login(){
        if (!Auth::check()) {
            return view('login', ['logged'=>false]);
        }
        else{
            return redirect(route('index'));
        }
    }

    public function register(){
        //Eliminar estas 2 líneas cuando se instale 
        $tipo = 1;
        return view('register', ['logged'=>false, 'tipo' => $tipo]);
        /*  */
        if (Auth::check()) {
            $user = Auth::user();
            if($user->tipo==0)
                return view('register', ['logged'=>true, 'tipo' => $user->tipo]);
        }
        return redirect(route('index'));
    }

    public function politicas(){
        if (Auth::check()) {
            $user = Auth::user();
            $espacios = Espacio::orderBy('nombre')->get();
            return view('politicas', ['logged'=>true, 'tipo' => $user->tipo]);
        }
        else{
            return redirect(route('index'));
        }
        
    }

}
