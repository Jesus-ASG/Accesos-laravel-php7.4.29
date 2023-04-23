<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    public function storeMany(Request $request){
        $user = Auth::user();
        if ($user->tipo != 0)
            return redirect(route('index'));

        $request->validate([
            'overwrite' => 'required',
            'estudiantes' => 'required',
        ]);

        
        $overwrite_str = $request->input('overwrite', false);
        $overwrite = filter_var($overwrite_str, FILTER_VALIDATE_BOOLEAN);
        $estudiantes = json_decode($request->input('estudiantes', []));
        if ($overwrite){
            session()->flash('success', 'Se actualizaron correctamente datos de los estudiantes.');
        }
        else{
            session()->flash('success', 'Se agregaron correctamente nuevos estudiantes.');
        }
        
        $duplicado = null;
        
        foreach($estudiantes as $e){
        
            $estudiante = new Estudiante();

            // Revisar si la matrícula solicitada existe
            $duplicado = Estudiante::where('matricula', $e->matricula)->first();
            // SI está duplicado
            if($duplicado !== null){
                if ($overwrite){ // Si quiere sobrescribir
                    $estudiante->delete();
                    $estudiante = $duplicado;
                    session()->flash('warning', 'Matrículas existentes fueron sobrescritas.');
                }
                else{ // Si no quiere sobrescribir
                    session()->flash('warning', 'Matrículas existentes no fueron agregadas.');
                    continue;
                }
            }
            
            $estudiante->no_lista = intval($e->no_lista);
            $estudiante->matricula = $e->matricula;
            
            $estudiante->nombre = $e->nombre;
            $estudiante->grado = $e->grado;
            $estudiante->grupo = $e->grupo;
            $estudiante->turno = $e->turno;
            $estudiante->save();
        }

        return response()->json([
            'message'=> 'success',
        ]);
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
