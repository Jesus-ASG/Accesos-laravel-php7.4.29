@extends('main')

@section('titulo')
    Accesos
@endsection

@section('contenido')
    <div class="row">
        <div class="centrado">
            <h1 class="titulo row fs1">
                <div class="col col-4 text-center">
                    <span class="container-acceso">
                        <p>Acceso:</p>
                    </span>
                </div>
                <div class="col col-8">
                    <span id="nombre_entrada"></span>
                </div>
            </h1>
            <form action="{{ route('lector') }}" autocomplete="off" method="POST">
                @csrf
                <div class="container-entrada row mb-3 fs2">
                    <div class="col col-4">
                        <label for="espacio" class="form-label">Seleccionar espacio</label>
                        <select class="form-select fs3" name="espacio" id="espacio">
                            @foreach ($espacios as $e)
                                <option value="{{ $e->id }}" class="fs3">{{ $e->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col col-8">
                        <label for="matricula" class="form-label">Ingresar matrícula</label>
                        <input type="text" class="input-matricula form-control fs3" id="input_matricula" name="matricula">
                    </div>
                </div>
                <div class="container-entrada row mb-3 fs3">
                    <span class="politica-privacidad">Al ingresar usted acepta los 
                        <a href="{{ route('politicas') }}" target="_blank">
                            términos y condiciones.<i class="fa-solid fa-up-right-from-square"></i>
                        </a>
                    </span>
                </div>
                <button class="btn btn-primary btn-entrar fs3">Entrar</button>
            </form>

            @if (session('success'))
                <h6 class="alert alert-success">Ingreso correcto {{ session('success')[1] }} {{ session('success')[2] }} </h6>
                {{ session('success')[0]->nombre }}
            @endif
            @if (session('m_not_found'))
                <h6 class="alert alert-warning">{{ session('m_not_found') }}</h6>
            @endif

            @error('matricula')
                <!--<h6 class="alert alert-danger">{ $message }</h6>-->
                <h6 class="alert alert-danger">Por favor ingrese una matrícula y seleccione un espacio</h6>
            @enderror

            <div class="respuesta-acceso" id="respuesta_acceso">

            </div>

        </div>
    </div>
@endsection

<script src="js/lector.js"></script>
