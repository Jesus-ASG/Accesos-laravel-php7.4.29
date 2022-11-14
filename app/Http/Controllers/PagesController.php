<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Htpp\Controllers\EstudiantesController;
use App\Http\Controllers\EstudiantesController as ControllersEstudiantesController;
use App\Models\Espacio;

class PagesController extends Controller
{
    
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('lector', ['tipo' => $user->tipo]);
        }
        else{
            return redirect(route('login'));
        }
    }

    public function login()
    {
        if (!Auth::check()) {
            return view('login');
        }
        else{
            return redirect(route('index'));
        }
    }

    public function register()
    {
        /* Eliminar estas 2 líneas cuando se instale */
        $tipo = 1;
        return view('register', ['tipo' => $tipo]);
        /*  */
        if (Auth::check()) {
            $user = Auth::user();
            if($user->tipo==0)
                return view('register', ['tipo' => $user->tipo]);
            return redirect(route('index'));
        }
        else{
            return redirect(route('index'));
        }
    }

    public function logged()
    {
        $user = Auth::user();
        return view('logged_layout', ['tipo' => $user->tipo]);
    }

    public function logged_admin()
    {
        return view('logged_admin');
    }
    public function lector(){
        if (Auth::check()) {
            $user = Auth::user();
            $espacios = Espacio::all();
            return view('lector', ['tipo' => $user->tipo, 'espacios'=>$espacios]);
        }
        else{
            return redirect(route('index'));
        }
    }

}
