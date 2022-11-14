<?php

namespace App\Http\Controllers;

use App\Models\Acceso;
use Illuminate\Http\Request;
use App\Models\Estudiante;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

/* Descripción
* Controlador que envía información a la plantilla 'ver-estudiantes'
* esta plantilla le solicita información por medio de un filtro y este
* controlador le responde con dicha información
*/

class EstudiantesController extends Controller
{
    public function index(){
        if (Auth::check()) {
            $user = Auth::user();
            $accesos = Acceso::where('fecha', Carbon::now()->toDateString())->get();
            return view('ver-estudiantes', ['logged'=>true, 'accesos' => $accesos, 'tipo' => $user->tipo]);
        }
        else{
            return redirect(route('index'));
        }
        
    }
}
