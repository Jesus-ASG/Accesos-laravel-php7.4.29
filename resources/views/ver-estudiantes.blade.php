@extends('main')

@section('titulo') Ver estudiantes @endsection

@section('contenido')
<div class="container border mt-5">
    <div>
        <form>
            <div class="row">
                <div class="col-12 col-lg-3">
                    <label class="form-label">Turno</label>
                    <select name="" id="" class="form-control">
                        <option value="#" selected>Matutino</option>
                        <option value="#">Vespertino</option>
                    </select>
                </div>
                <div class="col-12 col-lg-3">
                    <label class="form-label">Grado/Grupo</label>
                    <select name="" id="" class="form-control">
                        <option value="#" selected>1A</option>
                    </select>
                </div>
                <div class="col-12 col-lg-3">
                    <label class="form-label">Sitio</label>
                    <select name="" id="" class="form-control">
                        <option value="#" selected>selected</option>
                    </select>
                </div>
                <div class="col-12 col-lg-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" class="form-control">
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
                </tr>
            </thead>
            <tbody>
                @foreach ($accesos as $a)
                <tr>
                    <td>{{ $a->hora }} </td>
                    <td>{{ $a->estudiante->matricula }} </td>
                    <td>{{ $a->estudiante->nombre }}</td>
                    <td>{{ $a->estudiante->grupo }}</td>
                    <td>-</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection