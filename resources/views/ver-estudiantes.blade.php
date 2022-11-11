@extends('plantilla-principal')

@section('titulo') Ver estudiantes @endsection

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
    <h1>Accesos el día de hoy</h1>
    <div>
        @foreach ($accesos as $a)
            <p>
                {{ $a->fecha }}
                {{ $a->hora }} 
                {{ $a->lugar }} 

                {{ $a->estudiante->matricula }} {{ $a->estudiante->nombres }} {{ $a->estudiante->apellido_p }} {{ $a->estudiante->apellido_m }}
                <hr>
            </p>
        @endforeach
    </div>


@endsection