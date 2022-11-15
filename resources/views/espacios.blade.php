@extends('main')

@section('titulo')
    Accesos
@endsection

@section('contenido')
    <div class="row">

        <div class="card">

            <div class="card-body">
                <h4 class="card-title">Espacios</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>No. máximo de asistentes</th>
                            <th>Responsable</th>
                            <th>Academia</th>
                            <th style="min-width:120px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <form action="{{ route('espacios.store') }}" autocomplete="off" method="POST">
                                @csrf
                                <td><input type="text" class="form-control" name="nombre" placeholder="Nombre"></td>
                                <td><input type="text" class="form-control" name="descripcion" placeholder="Descripción">
                                </td>
                                <td><input type="text" class="form-control" name="no_max_asistentes"
                                        placeholder="Máximo de asistentes"></td>
                                <td><input type="text" class="form-control" name="responsable" placeholder="Responsable">
                                </td>
                                <td><input type="text" class="form-control" name="academia" placeholder="Academia"></td>
                                <td><button class="btn btn-success"><i class="fa-solid fa-plus"></i></button></td>
                            </form>
                        </tr>

                        @foreach ($espacios as $e)
                            <tr>
                                <td>{{ $e->nombre }}</td>
                                <td>{{ $e->descripcion }}</td>
                                <td>{{ $e->no_max_asistentes }}</td>
                                <td>{{ $e->responsable }}</td>
                                <td>{{ $e->academia }}</td>
                                <td>
                                    <a class="btn btn-info" href="#" role="button" title="Editar">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('espacios.destroy', $e) }}" autocomplete="off" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" title="Eliminar">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
@endsection
