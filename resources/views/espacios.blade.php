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
                            <th class="fs4">Nombre</th>
                            <th class="fs4">Descripción</th>
                            <th class="fs4">No. de asistentes</th>
                            <th class="fs4">Responsable</th>
                            <th class="fs4">Academia</th>
                            <th class="fs4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <form action="{{ route('espacios.store') }}" autocomplete="off" method="POST">
                                @csrf
                                <td><input type="text" class="form-control fs4" name="nombre" placeholder="Nombre"></td>
                                <td><input type="text" class="form-control fs4" name="descripcion"
                                        placeholder="Descripción">
                                </td>
                                <td><input type="number" class="form-control fs4" name="no_max_asistentes"
                                        placeholder="No. asistentes"></input>
                                <td><input type="text" class="form-control fs4" name="responsable"
                                        placeholder="Responsable">
                                </td>
                                <td><input type="text" class="form-control fs4" name="academia" placeholder="Academia">
                                </td>
                                <td><button class="btn btn-success"><i class="fa-solid fa-plus"></i></button></td>
                            </form>
                        </tr>

                        @foreach ($espacios as $e)
                            <tr>
                                <td class="fs4">{{ $e->nombre }}</td>
                                <td class="fs4">{{ $e->descripcion }}</td>
                                <td class="fs4">{{ $e->no_max_asistentes }}</td>
                                <td class="fs4">{{ $e->responsable }}</td>
                                <td class="fs4">{{ $e->academia }}</td>
                                <td class="fs4">
                                    <!-- Modal para editar-->
                                    <div>
                                        <button class="btn btn-info" href="#" type="button" title="Editar"
                                            data-bs-toggle="modal" data-bs-target="#modal_edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <div class="modal fade" id="modal_edit" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Editar espacio</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('espacios.update', $e) }}" autocomplete="off"
                                                            method="POST" id="form_editar">
                                                            @csrf
                                                            @method('put')
                                                            <div class="mb-2">
                                                                <label for="nombre" class="form-label">Nombre</label>
                                                                <input type="text" class="form-control" name="nombre"
                                                                    placeholder="Nombre" value="{{ $e->nombre }}">
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="descripcion"
                                                                    class="form-label">Descripción</label>
                                                                <input type="text" class="form-control"
                                                                    name="descripcion" placeholder="Descripción"
                                                                    value="{{ $e->descripcion }}">
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="no_max_asistentes" class="form-label">Máximo de
                                                                    asistentes</label>
                                                                <input type="number" class="form-control"
                                                                    name="no_max_asistentes" placeholder="No. asistentes"
                                                                    value="{{ $e->no_max_asistentes }}">
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="responsable"
                                                                    class="form-label">Responsable</label>
                                                                <input type="text" class="form-control"
                                                                    name="responsable" placeholder="Responsable"
                                                                    value="{{ $e->responsable }}">
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="academia" class="form-label">Academia</label>
                                                                <input type="text" class="form-control"
                                                                    name="academia" placeholder="Academia"
                                                                    value="{{ $e->academia }}">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary"
                                                            form="form_editar">Guardar
                                                            cambios</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- fin del modal para editar -->

                                    <!-- modal para borrar -->
                                    <div>
                                        <button class="btn btn-danger" href="#" type="button" title="Eliminar"
                                            data-bs-toggle="modal" data-bs-target="#modal_delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                        <div class="modal fade" id="modal_delete" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">¿Desea eliminar el espacio
                                                            "{{ $e->nombre }}"?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="close"></button>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <form action="{{ route('espacios.destroy', $e) }}"
                                                            autocomplete="off" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger">
                                                                Eliminar</i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
