@extends('plantilla-principal')

@section('titulo') Registrarse @endsection

@section('nav-fields')
<div class="navbar-item" style="display: inline;">
    <a href="{{ route('lector') }}">
        Lector de accesos
    </a>
</div>
<li class="d-flex m-1">
    <div class="navbar-item">
        <a href="{{ route('ver-estudiantes') }}">Ver estudiantes</a>
    </div>
</li>

@if($tipo==0)
<li class="d-flex m-1">
    <div class="navbar-item">
        <a href="{{route('register')}}">Registrar usuario</a>
    </div>
</li>
@endif

<li class="d-flex m-1">
    <div class="navbar-item">
        <a href="{{route('logout')}}">Cerrar sesión</a>
    </div>
</li>

@endsection

@section('contenido')
<div>
    <br><br>
    <center>
        <h1>Ingrese los datos requeridos para registrar nuevo usuario</h1>
        <br><br>
    </center>
    <form action="{{route('register.post')}}", method="POST">
        @csrf
        <center>
            <h5>Ingrese matricula</h5>
            <input type="text", class="input-inicio-sesion", name="mat", autocomplete="off", placeholder="Matricula">
            <br>
            <h5>Ingrese nombre(s)</h5>
            <input type="text", class="input-inicio-sesion", name="name", autocomplete="off", placeholder="Nombre(s)">
            <br>
            <h5>Ingrese apellido paterno</h5>
            <input type="text", class="input-inicio-sesion", name="ape_p", autocomplete="off", placeholder="Apellido paterno">
            <br>
            <h5>Ingrese apellido materno</h5>
            <input type="text", class="input-inicio-sesion", name="ape_m", autocomplete="off", placeholder="Apellido materno">
            <br>
            <h5>Ingrese contraseña</h5>
            <input type="password", class="input-inicio-sesion", name="txtpassword", autocomplete="off", placeholder="contraseña">
            <br><br>
            <input type="submit" value = "Registrar", class="btn btn-success btn-entrar">
        </center>
    </form>
    <br><br><br>
</div>
@endsection