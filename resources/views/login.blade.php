@extends('main')

@section('titulo') Iniciar sesion @endsection

@section('contenido')
<div>
        <br><br>
        <form action="{{route('login.post')}}", method="POST">
            @csrf
            <center>
                <h5>Ingrese su matricula</h5>
                <input type="text", class="input-inicio-sesion", name="matricula", autocomplete="off", placeholder="Matricula">
                <br>
                <h5>Ingrese su contraseña</h5>
                <input type="password", class="input-inicio-sesion", name="password", autocomplete="off", placeholder="Contraseña">
                <br><br>
                <input type="submit" value = "Aceptar", class="btn btn-success btn-entrar">
            </center>
        </form>
    </div>
@endsection