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
            return redirect()->intended(route('lector'));
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
            'txtpassword2' => 'required',
            'key' => 'required'
        ]);
        
        $user = new User();
        if ($request->key == env('SECURITY_KEY'))
            $user->tipo = 1;
        else if($request->key == env('SECURITY_KEY_ADMIN'))
            $user->tipo = 0;
        else
            return redirect(route('register'));
        
        if($request->txtpassword != $request->txtpassword2){
            return redirect(route('register'));
        }

        $user->matricula = $request->mat;
        $user->nombre = $request->name;
        $user->apellido_p = $request->ape_p;
        $user->apellido_m = $request->ape_m;
        $user->password = $request->txtpassword;
        

        $user->save();
        if (!Auth::check()) {
            Auth::login($user);
        }
        
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
