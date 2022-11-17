@extends('main')

@section('titulo')
    Ver estudiantes
@endsection

@section('contenido')
    <div class="container border mt-5">
        <div>
            <form action="{{ route('ver-estudiantes.filter') }}" autocomplete="off" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-2">
                        <label class="form-label">Turno</label>
                        <select name="turno" id="fe_turno" class="form-control">
                            <option value="M" selected>Matutino</option>
                            <option value="V">Vespertino</option>
                        </select>
                    </div>
                    <div class="col-12 col-lg-2">
                        <label class="form-label">Grado</label>
                        <select name="grado" id="fe_grado" class="form-control">
                            <option value="all">Todos</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="col-12 col-lg-2">
                        <label class="form-label">Grupo</label>
                        <select name="grupo" id="fe_grupo" class="form-control">
                            <option value="all">Todos</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                            <option value="G">G</option>
                            <option value="H">H</option>
                            <option value="I">I</option>
                        </select>
                    </div>
                    <div class="col-12 col-lg-2">
                        <label class="form-label">Espacio</label>
                        <select name="espacio" id="fe_espacio" class="form-control">
                            @foreach ($espacios as $e)
                                <option value="{{ $e->id }}" class="fs3">{{ $e->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-lg-2">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="fe_fecha">
                    </div>
                    <div class="col-12 col-lg-2">
                        <button class="btn btn-info" type="submit" id="btn_filtrar">Filtrar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive mt-4">
            <table class="table w-100">
                <thead>
                    <tr>
                        <td scope="col">
                            Hora
                        </td>
                        <td scope="col">
                            Matricula
                        </td>
                        <td scope="col">
                            Nombre
                        </td>
                        <td scope="col">
                            Grado
                        </td>
                        <td scope="col">
                            Grupo
                        </td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accesos as $a)
                        <tr>
                            <td>{{ $a->hora }} </td>
                            <td>{{ $a->estudiante->matricula }} </td>
                            <td>{{ $a->estudiante->nombre }}</td>
                            <td>{{ $a->estudiante->grado }}</td>
                            <td>{{ $a->estudiante->grupo }}</td>
                            <td><i class="fa fa-info-circle" aria-hidden="true"></i></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('page_scripts')
    <script src="js/ver-estudiantes.js"></script>
@endsection
