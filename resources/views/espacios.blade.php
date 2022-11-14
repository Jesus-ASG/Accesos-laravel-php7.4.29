@extends('main')

@section('titulo')
    Accesos
@endsection

@section('contenido')
    <div class="row">
        
        <div class="card">
            <div class="card-header">
                <a class="btn btn-success" href="#" role="button">Agregar espacio</a>
            </div>
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
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                |
                                <a class="btn btn-danger" href="#" role="button" title="Eliminar">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted"></div>
        </div>

    </div>
@endsection
