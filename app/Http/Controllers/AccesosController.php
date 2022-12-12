<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Acceso;
use App\Models\Espacio;
use App\Models\Estudiante;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

/* Descripción
* Controlador que registra los accesos de la plantilla 'lector'
* si la matricula que se ingresa es válida se guarda uno de estos accesos
* con la información de quien ingresó, fecha, hora y lugar de acceso
* de lo contrario avisa que no se encontró dicha matrícula
*/

class AccesosController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $espacios = Espacio::orderBy('nombre')->get(); // para seleccionar espacio
        return view('lector', ['logged'=>true, 'tipo' => $user->tipo, 'espacios'=>$espacios]);
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'matricula' => 'required',
            'espacio' => 'required'
        ]);

        // obtiene un dato
        $validarEspacio = Espacio::find($request->espacio);
        $estudiante = Estudiante::with('accesos')->where('matricula', $request->matricula)->first();

        if ($estudiante && $validarEspacio) {
            // para evitar registros repetidos
            foreach($estudiante->accesos as $a)
                if(($a->fecha == Carbon::now()->format('Y-m-d')) && ($a->espacio_id == $validarEspacio->id))
                    return redirect()->route('lector')->with('m_not_found', 'La matricula "' . $request->matricula . '" ya está registrada');
            
            $acceso = new Acceso;
            $acceso->fecha = Carbon::now()->toDateString();
            $acceso->hora = Carbon::now()->toTimeString();
            $acceso->estudiante_id = $estudiante->id;
            $acceso->espacio_id = $validarEspacio->id;

            $acceso->save();
            return redirect()->route('lector')->with('success', [$estudiante, $acceso->fecha, $acceso->hora]);
        }
        return redirect()->route('lector')->with('m_not_found', 'La matricula "' . $request->matricula . '" no fue encontrada');        
    }

    
}
