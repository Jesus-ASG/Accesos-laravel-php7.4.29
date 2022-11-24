<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\Models\Acceso;
use App\Models\Estudiante;
use App\Models\Espacio;

/* Descripción
* Controlador que envía información a la plantilla 'ver-estudiantes'
* esta plantilla le solicita información por medio de un filtro y este
* controlador le responde con dicha información
*/

class EstudiantesController extends Controller
{
    public function index(){
        $user = Auth::user();
        $espacios = Espacio::orderBy('nombre')->get(); // para seleccionar espacio
        $accesos = Acceso::where('fecha', '')->get();

        return view('ver-estudiantes', ['logged'=>true, 'accesos' => $accesos, 
            'tipo' => $user->tipo, 'espacios'=>$espacios, 'm_get'=>true]);
        
    }

    public function filter(Request $request){
        $user = Auth::user();
        $espacios = Espacio::orderBy('nombre')->get();

        // validar
        $request->validate([
            'turno' => 'required',
            'grado' => 'required',
            'grupo' => 'required',
            'espacio' => 'required'
        ]);
        $accesos = Acceso::with('estudiante', 'espacio')->where([

            ['espacio_id', $request->espacio],
            ['fecha', $request->fecha],
            
            ])->whereHas('estudiante', function($query) use ($request){
                if(($request->turno != 'all'))
                    $query->where('turno', $request->turno);
                
                if(($request->grado != 'all'))
                    $query->where('grado', $request->grado);
                
                if(($request->grupo != 'all'))
                    $query->where('grupo', $request->grupo);
                
        })->get();
        
        return response()->json($accesos);
    }

}
