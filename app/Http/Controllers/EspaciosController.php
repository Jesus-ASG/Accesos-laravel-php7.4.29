<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Espacio;

class EspaciosController extends Controller
{
    public function index(){
        $user = Auth::user();
        $espacios = Espacio::orderBy('nombre')->get();
        return view('espacios', ['logged'=>true, 'tipo'=>$user->tipo, 'espacios'=>$espacios]);
    }
}
