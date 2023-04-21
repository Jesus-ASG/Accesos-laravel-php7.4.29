<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\Models\Acceso;
use App\Models\Estudiante;
use App\Models\Espacio;

class AdminEstudiantesController extends Controller
{
    public function index(){
        $user = Auth::user();
        $estudiantes = Estudiante::all();

        return view('admin_estudiantes', [
            'logged'=>true,
            'tipo' => $user->tipo,
            'estudiantes'=>$estudiantes, 
            'm_get'=>true]
        );
        
    }

    public function filter(Request $request){
        $user = Auth::user();
        if ($user->tipo != 0)
            return redirect(route('index'));

        // validar
        $request->validate([
            'turno' => 'required',
            'grado' => 'required',
            'grupo' => 'required',
        ]);

        $query = Estudiante::query();
        $query->where('turno', $request->turno);

        if ($request->grado !== 'all'){
            $query->where('grado', $request->grado);
        }

        if ($request->grupo !== 'all'){
            $query->where('grupo', $request->grupo);
        }

        $estudiantes = $query->get();
        return response()->json($estudiantes);
    }

    public function store(Request $request){
        $user = Auth::user();
        if ($user->tipo != 0)
            return redirect(route('index'));

        $request->validate([
            'no_lista' => 'required',
            'matricula' => 'required',
            'nombre' => 'required',
            'grado' => 'required',
            'grupo' => 'required',
            'turno' => 'required',
        ]);

        // Revisar que la matrícula solicitada no se encuentre
        $duplicado = Estudiante::where('matricula', $request->matricula);
        if($duplicado->count() > 0){
            session()->flash('error', 'Esa matrícula ya existe');            
            return redirect(route('estudiantes'));
        }

        $estudiante = new Estudiante();

        $estudiante->no_lista = $request->no_lista;
        $estudiante->matricula = $request->matricula;
        $estudiante->nombre = $request->nombre;
        $estudiante->grado = $request->grado;
        $estudiante->grupo = $request->grupo;
        $estudiante->turno = $request->turno;
        
        $estudiante->save();
        return redirect(route('estudiantes'));
    }

    public function update(Request $request, int $estudiante_id){
        $user = Auth::user();
        if ($user->tipo != 0)
            return redirect(route('index'));

        $request->validate([
            'no_lista' => 'required',
            'matricula' => 'required',
            'nombre' => 'required',
            'grado' => 'required',
            'grupo' => 'required',
            'turno' => 'required',
        ]);
        if ($estudiante_id == 0)
            $estudiante = new Estudiante();
        else
            $estudiante = Estudiante::find($estudiante_id);
        
        if(!$estudiante){
            session()->flash('error', 'No se ha encontrado a ese estudiante');            
            return redirect(route('estudiantes'));
        }

        // Revisar si la matrícula solicitada existe
        $duplicado = Estudiante::where('matricula', $request->matricula)->whereNotIn('id', [$estudiante->id])->first();
        if (is_null($request->overwrite)){ // Si no quiere sobrescribir
            if($duplicado){
                session()->flash('error', 'Esa matrícula ya existe.');
                return redirect(route('estudiantes'));
            }
        }
        else{ // Si quiere sobrescribir
            $estudiante->delete();
            $estudiante = $duplicado;
            session()->flash('warning', 'Se sobrescribió una matrícula.');
        }
        
        $estudiante->no_lista = $request->no_lista;
        $estudiante->matricula = $request->matricula;
        $estudiante->nombre = $request->nombre;
        $estudiante->grado = $request->grado;
        $estudiante->grupo = $request->grupo;
        $estudiante->turno = $request->turno;
        
        $estudiante->save();

        if ($estudiante_id == 0)
            session()->flash('success', 'Se agregó correctamente un estudiante.');
        else
            session()->flash('success', 'Se actualizó correctamente un estudiante.');

        return redirect(route('estudiantes'));
    }

    public function destroy(int $estudiante_id){
        $user = Auth::user();
        if ($user->tipo != 0)
            return redirect(route('index'));
        
        // revisar que el estudiante exista
        $estudiante = Estudiante::find($estudiante_id);
        if(!$estudiante){
            session()->flash('error', 'No se ha encontrado a ese estudiante');            
            return redirect(route('estudiantes'));
        }

        $estudiante->delete();
        
        return redirect(route('estudiantes'));
    }
}
