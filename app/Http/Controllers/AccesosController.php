<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acceso;
use App\Models\Estudiante;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;


class AccesosController extends Controller
{
    /*
    ---convenciones---
    index: mostrar
    store: guardar
    update: actualizar
    destroy: borrar
    edit: editar
    */

    public function store(Request $request)
    {
        $request->validate([
            'matricula' => 'required'
        ]);

        // obtiene un dato
        $estudiante = DB::table('estudiantes')->where('matricula', $request->matricula)->first();
        if ($estudiante && $estudiante->activo == 1) {
            $acceso = new Acceso;
            $acceso->fecha = Carbon::now()->toDateString();
            $acceso->hora = Carbon::now()->toTimeString();
            $acceso->estudiante_id = $estudiante->id;
            $acceso->lugar = "Entrada";

            $acceso->save();
            return redirect()->route('lector')->with('success', [$estudiante, $acceso->fecha, $acceso->hora]);
        }
        return redirect()->route('lector')->with('m_not_found', 'La matricula "' . $request->matricula . '" no fue encontrada');        
    }

    public function index()
    {
        $accesos = Acceso::all();
    }
}
