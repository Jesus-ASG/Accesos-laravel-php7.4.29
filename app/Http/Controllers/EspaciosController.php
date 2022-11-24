<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Espacio;

class EspaciosController extends Controller
{
    public function index(){
        $user = Auth::user();
        if ($user->tipo != 0)
            return redirect(route('index'));
        $espacios = Espacio::orderBy('nombre')->get();
        return view('espacios', ['logged'=>true, 'tipo'=>$user->tipo, 'espacios'=>$espacios]);
    }

    public function store(Request $request){
        $user = Auth::user();
        if ($user->tipo != 0)
            return redirect(route('index'));

        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'no_max_asistentes' => 'required',
            'responsable' => 'required',
            'academia' => 'required',
        ]);

        $espacio = new Espacio();
        $espacio->nombre = $request->nombre;
        $espacio->descripcion = $request->descripcion;
        $espacio->no_max_asistentes = $request->no_max_asistentes;
        $espacio->responsable = $request->responsable;
        $espacio->academia = $request->academia;
        
        $espacio->save();
        return redirect(route('espacios'));
    }

    public function destroy(Espacio $espacio){
        $user = Auth::user();
        if ($user->tipo != 0)
            return redirect(route('index'));

        $espacio->delete();
        return redirect(route('espacios'));
    }

    public function update(Request $request, Espacio $espacio){
        $user = Auth::user();
        if ($user->tipo != 0)
            return redirect(route('index'));
        
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'no_max_asistentes' => 'required',
            'responsable' => 'required',
            'academia' => 'required',
        ]);

        $espacio->nombre = $request->nombre;
        $espacio->descripcion = $request->descripcion;
        $espacio->no_max_asistentes = $request->no_max_asistentes;
        $espacio->responsable = $request->responsable;
        $espacio->academia = $request->academia;
        
        $espacio->save();
        
        return redirect(route('espacios'));
    }
}
