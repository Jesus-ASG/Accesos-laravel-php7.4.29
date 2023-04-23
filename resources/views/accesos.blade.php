@extends('main')

@section('titulo')
    Ver accesos
@endsection

@section('contenido')
<input type="text" value="{{ $m_get }}" id="m_get" hidden>
    <div class="container border mt-5">
        <div>
            
            <form action="{{ route('accesos.filter') }}" autocomplete="off" method="POST">
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
                    
                    <div class="col-12 col-lg-2 text-end">
                        <a class="btn btn-info btn-entrar mt-3" style="color: #fff" onclick="sendFilterRequest()" id="btn_filtrar">
                            <i class="fa fa-refresh" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive mt-4">
            <table class="table w-100" id="tabla_estudiantes">
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
                    
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('page_scripts')
    <script src="js/ver-estudiantes.js"></script>
    <script>
        $(document).ready(function(){
            sendFilterRequest();

            //setInterval(function(){sendFilterRequest();},2000);
        });
        function sendFilterRequest(){
            let turno = $("#fe_turno").val();
            let grado = $("#fe_grado").val();
            let grupo = $("#fe_grupo").val();
            let espacio = $("#fe_espacio").val();
            let fecha = $("#fe_fecha").val();

            $.ajax({
                url: "{{ route('accesos') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="crsf-token"]').attr('content') 
                },
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    'turno': turno,
                    'grado': grado,
                    'grupo': grupo,
                    'espacio': espacio,
                    'fecha': fecha
                },
                success: function(accesos){
                    let x = ``;
                    for(let a of accesos){
                        x += `
                        <tr>
                            <td> `+a.hora+` </td>
                            <td>`+a.estudiante.matricula+` </td>
                            <td>`+a.estudiante.nombre+`</td>
                            <td>`+a.estudiante.grado+`</td>
                            <td>`+a.estudiante.grupo+`</td>
                            <td>
                                <div>
                                    <button class="btn btn-info btn-entrar" href="#" type="button" title="Ver más"
                                        data-bs-toggle="modal" data-bs-target="#modal_info_`+a.id+`">
                                        <i class="fa fa-info-circle" style='color: white' aria-hidden="true"></i>
                                    </button>
                                    <div class="modal fade" id="modal_info_`+a.id+`" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title c-primary col-11 text-center fw-bold">Información detallada</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row text-center">
                                                        <div class="col-3">
                                                            <p>
                                                                <span class="fw-bold c-primary">Turno:</span> 
                                                                `+a.estudiante.turno+`
                                                            </p>
                                                        </div>
                                                        <div class="col-3">
                                                            <p>
                                                                <span class="fw-bold c-primary">Grado:</span> 
                                                                `+a.estudiante.grado+`
                                                            </p>
                                                        </div>
                                                        <div class="col-3">
                                                            <p>
                                                                <span class="fw-bold c-primary">Grupo:</span> 
                                                                `+a.estudiante.grupo+`
                                                            </p>
                                                        </div>
                                                        <div class="col-3">
                                                            <p>
                                                                <span class="fw-bold c-primary">NL:</span> 
                                                                `+a.estudiante.no_lista+`
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-2 text-start">
                                                        <div class="col-4">
                                                            <p><span class="fw-bold c-primary">Matrícula:</span> <br> `+a.estudiante.matricula+`</p>
                                                        </div>
                                                        <div class="col-8">
                                                            <p><span class="fw-bold c-primary">Nombre:</span> <br> `+a.estudiante.nombre+`</p>
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <div class="row mb-2">
                                                        <div class="col-6">
                                                            <p><span class="fw-bold c-primary">Acceso:</span> <br> `+a.espacio.nombre+`</p>
                                                        </div>
                                                        <div class="col-3 text-center">
                                                            <p><span class="fw-bold c-primary">Fecha:</span> <br> `+a.fecha+`</p>
                                                        </div>
                                                        <div class="col-3 text-center">
                                                            <p><span class="fw-bold c-primary">Hora:</span> <br> `+a.hora+`</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        `;
                    }
                    
                    document.querySelector('#tabla_estudiantes tbody').innerHTML = x;
                },
                error: function(xhr, status, error){
                    //console.log(xhr.responseText);
                }
            });
        }
        
    </script>
@endsection
