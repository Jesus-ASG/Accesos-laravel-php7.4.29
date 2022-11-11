<?php

namespace App\Http\Controllers;

use App\Models\Acceso;
use Illuminate\Http\Request;
use App\Models\Estudiante;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class EstudiantesController extends Controller
{
    public function index(){
        if (Auth::check()) {
            $user = Auth::user();
            $accesos = Acceso::where('fecha', Carbon::now()->toDateString())->get();
            //$accesos = DB::table('accesos')->where('fecha', Carbon::now()->toDateString())->get();

            //$estudiantes = Estudiante::all();
            //return view('ver-estudiantes', ['estudiantes' => $estudiantes]);
            return view('ver-estudiantes', ['accesos' => $accesos, 'tipo' => $user->tipo]);
        }
        else{
            return redirect(route('index'));
        }
        
    }
}
