<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'matricula' => 'required',
            'password' => 'required'
        ]);


        if(auth()-> attempt(request(['matricula', 'password'])) == false){
            return back()->withErrors([
                'message' => 'Matricula o contraseña equivocadas'
            ]);
        }
        else
        {
            $user = Auth::user();
            return redirect()->intended(route('index'));
            //return $this->validation($user);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'mat' => 'required',
            'name' => 'required',
            'ape_p' => 'required',
            'ape_m' => 'required',
            'txtpassword' => 'required',
        ]);

        $user = new User();

        $user->matricula = $request->mat;
        $user->nombre = $request->name;
        $user->apellido_p = $request->ape_p;
        $user->apellido_m = $request->ape_m;
        $user->password = $request->txtpassword;
        $user->tipo = 1;

        $user->save();
        
        Auth::login($user);

        return redirect(route('lector'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('index'));
    }
}
