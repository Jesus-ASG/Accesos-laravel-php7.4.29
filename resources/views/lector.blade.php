@extends('main')

@section('titulo')
    Accesos
@endsection

@section('contenido')
    <div class="row">
        <div class="centrado">
            <h1>Acceso a entrada</h1>
            <form action="{{ route('lector') }}" class="mt-3" autocomplete="off" method="POST">
                @csrf
                <div class="container-entrada">
                    <select class="form-select" name="espacio">
                        @foreach ($espacios as $e)
                            <option value="{{ $e->id }}">{{ $e->nombre }}</option>
                        @endforeach
                      </select>

                    <input type="text" class="input-matricula" id="input_matricula" name="matricula">
                    <button class="btn btn-success btn-entrar">Entrar</button>
                </div>
            </form>

            @if (session('success'))
                <h6 class="alert alert-success">Ingreso correcto {{ session('success')[1] }} {{ session('success')[2] }} </h6>
                {{ session('success')[0]->nombre }}
            @endif
            @if (session('m_not_found'))
                <h6 class="alert alert-warning">{{ session('m_not_found') }}</h6>
                
                
            @endif

            @error('matricula')
                <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror

            <div class="respuesta-acceso" id="respuesta_acceso">

            </div>

        </div>
    </div>
@endsection

<script src="js/lector.js"></script>
