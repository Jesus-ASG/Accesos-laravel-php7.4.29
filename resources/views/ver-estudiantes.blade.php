@extends('main')

@section('titulo') Ver estudiantes @endsection

@section('contenido')
    <h1>Accesos el día de hoy</h1>
    <div>
        @foreach ($accesos as $a)
            <p>
                {{ $a->fecha }}
                {{ $a->hora }} 
                @if($a->espacio!=null)
                {{ $a->espacio->nombre }}
                @else
                Espacio no definido
                @endif

                {{ $a->estudiante->no_lista }} {{ $a->estudiante->matricula }} {{ $a->estudiante->nombre }} {{ $a->estudiante->grupo }}
                <hr>
            </p>
        @endforeach
    </div>


@endsection