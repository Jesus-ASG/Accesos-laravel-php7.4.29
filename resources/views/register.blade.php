@extends('main')

@section('titulo')
    Registrarse
@endsection

@section('contenido')
    <div class="mt-3 card px-3 py-1">
        <div class="mb-3 text-center fs1">
            <h1>Registrar nuevo usuario</h1>
        </div>
        <form action="{{ route('register.post') }}" method="POST" autocomplete="off">
            @csrf
            <div class="row mb-2 px-2">
                <div class="col-12 col-md-3">
                    <label for="mat" class="form-label">Ingrese matricula</label>
                    <input type="text", class="form-control input-inicio-sesion" id="mat" name="mat"
                        placeholder="Matricula">
                </div>
                <div class="col-12 col-md-3">
                    <label for="name" class="form-label">Ingrese nombre(s)</label>
                    <input type="text", class="form-control input-inicio-sesion" id="name" name="name"
                        placeholder="Nombre(s)">
                </div>
                <div class="col-12 col-md-3">
                    <label for="ape_p" class="form-label">Ingrese apellido paterno</label>
                    <input type="text", class="form-control input-inicio-sesion" id="ape_p" name="ape_p"
                        placeholder="Apellido paterno">
                </div>
                <div class="col-12 col-md-3">
                    <label for="ape_m" class="form-label">Ingrese apellido materno</label>
                    <input type="text", class="form-control input-inicio-sesion" id="ape_m" name="ape_m"
                        placeholder="Apellido materno">
                </div>

            </div>
            <div class="row mb-2 px-2">
                <div class="col-12 col-md-6">
                    <label for="txtpassword" class="form-label">Ingrese contraseña</label>
                    <input type="password", class="form-control input-inicio-sesion" id="txtpassword" name="txtpassword"
                        placeholder="Contraseña">
                </div>

                <div class="col-12 col-md-6">
                    <label for="txtpassword2" class="form-label">Repetir contraseña</label>
                    <input type="password", class="form-control input-inicio-sesion" id="txtpassword2" name="txtpassword2"
                        placeholder="Repetir contraseña">
                </div>
            </div>
            <div class="row mb-2 px-2">
                <div class="col-12 text-center">
                    <label for="key" class="form-label">Ingrese la llave de seguridad</label>
                    <input type="text", class="form-control input-inicio-sesion" id="key" name="key"
                        placeholder="Llave de seguridad">
                </div>
            </div>
            <!--
            <div class="row mb-2 px-2">
                <div class="col-12 text-center">
                    <input class="form-check-input" type="checkbox" value="" id="tipo" name="tipo">
                    <label class="form-check-label" for="flexCheckDefault">
                        Marque esta casilla si desea que el usuario pueda modificar y eliminar accesos
                    </label>
                </div>
            </div>
            -->
            <div class="centrado">
                <button type="submit" class="btn btn-primary btn-entrar w-25">Registrar</button>
            </div>

        </form>
        <br><br><br>
    </div>
@endsection
