@extends('plantilla-principal')

@section('titulo') Iniciar sesion @endsection

@section('nav-fields')
<li class="d-flex m-1">
    <div class="navbar-item">
        <a href="{{route('login')}}">Iniciar sesión</a>
    </div>
</li>
@endsection

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