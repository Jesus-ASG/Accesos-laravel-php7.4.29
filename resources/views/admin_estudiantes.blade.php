@extends('main')

@section('titulo')
    Estudiantes
@endsection

@section('contenido')
    
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <strong>Error: </strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <strong>Aviso: </strong> {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong>Aviso: </strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <input type="text" value="{{ $m_get }}" id="m_get" hidden>
    <div class="container border mt-5">
        <div>

            <form action="{{ route('accesos.filter') }}" autocomplete="off" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <label class="form-label">Turno</label>
                        <select name="turno" id="fe_turno" class="form-control">
                            <option value="M" selected>Matutino</option>
                            <option value="V">Vespertino</option>
                        </select>
                    </div>
                    <div class="col-12 col-lg-3">
                        <label class="form-label">Grado</label>
                        <select name="grado" id="fe_grado" class="form-control">
                            <option value="all">Todos</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="col-12 col-lg-3">
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

                    <div class="col-12 col-lg-3 text-end">
                        <button class="btn btn-success btn-entrar mt-3" style="color:#fff;" href="#" type="button"
                            title="Agregar estudiante" data-bs-toggle="modal" data-bs-target="#agregar_estudiante">
                            +
                        </button>

                        <button class="btn btn-success btn-entrar mt-3" style="color:#fff;" href="#" type="button"
                            title="Agregar estudiantes" data-bs-toggle="modal" data-bs-target="#agregar_estudiantes_por_excel">
                            <span><i class="fa-solid fa-file-arrow-up"></i></span>
                        </button>

                        <a class="btn btn-info btn-entrar mt-3" style="color: #fff" onclick="sendFilterRequest()"
                            title="Actualizar" id="btn_filtrar">
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
                            No. lista
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
                        <td scope="col">
                            Turno
                        </td>
                        <td scope="col">
                            Acciones
                        </td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal para agregar estudiante -->
    <div class="modal fade" id="agregar_estudiante" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title c-primary col-11 text-center fw-bold">Agregar estudiante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('estudiantes.update', 0) }}" autocomplete="off" method="POST"
                        id="form_agregar_estudiante" class="form-label-bold">
                        @csrf
                        @method('put')
                        <div class="mb-2">
                            <label for="ae_nl" class="form-label c-primary">No. lista</label>
                            <input type="number" class="form-control" name="no_lista" id="ae_nl"
                                placeholder="No. lista" required>
                        </div>
                        <div class="mb-2">
                            <label for="ae_matricula" class="form-label c-primary">Matrícula</label>
                            <input type="number" class="form-control" name="matricula" id="ae_matricula"
                                placeholder="Matrícula" required>
                        </div>
                        <div class="mb-2">
                            <label for="ae_nombre" class="form-label c-primary">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="ae_nombre"
                                placeholder="Nombre" required>
                        </div>
                        <div class="mb-2">
                            <label for="ae_grado" class="form-label c-primary">Grado</label>
                            <input type="text" class="form-control" name="grado" id="ae_grado"
                                placeholder="Grado" required>
                        </div>
                        <div class="mb-2">
                            <label for="ae_grupo" class="form-label c-primary">Grupo</label>
                            <input type="text" class="form-control" name="grupo" id="ae_grupo"
                                placeholder="Grupo" required>
                        </div>
                        <div class="mb-2">
                            <label for="ae_turno" class="form-label c-primary">Turno</label>
                            <select class="form-control" name="turno" id="ae_turno" required>
                                <option value="M" selected>Matituno (M)</option>
                                <option value="V">Vespertino (V)</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="overwrite" id="ae_overwrite">
                                <label class="form-check-label" for="ae_overwrite">
                                    <strong class="text-danger">Sobrescribir si ya existe</strong>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-entrar"
                        form="form_agregar_estudiante">Agregar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- fin del modal para agregar estudiante -->


    <!-- Modal para agregar estudiantes por excel -->
    <div class="modal fade" id="agregar_estudiantes_por_excel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title c-primary col-11 text-center fw-bold">Agregar estudiante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('estudiantes.update', 0) }}" autocomplete="off" method="POST"
                        id="form_agregar_estudiantes_por_excel" class="form-label-bold">
                        @csrf
                        <div class="mb-2">
                            <label for="excel_input" class="form-label">Subir archivo</label>
                            <input class="form-control" type="file" id="excel_input" accept=".csv, .xlsx, .ods">
                            <p id="excel_input_label" class="text-success my-1 fw-bold fst-italic text-center"></p>
                        </div>

                        <div class="mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="overwrite" id="excel_overwrite">
                                <label class="form-check-label" for="excel_overwrite">
                                    <strong class="text-danger">Sobrescribir si ya existe</strong>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-entrar" id="excel_submit_button"
                        onclick="agregarPorExcel()" disabled>Agregar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- fin del modal para agregar estudiantes por excel -->
@endsection

@section('page_scripts')
    <script src="{{ asset('js/xlsx.full.min.js') }}"></script>
    
    <script>

        // actualizar cada que cambie los valores del formulario
        document.querySelector('#fe_turno').addEventListener("change", function() {
            document.getElementById("btn_filtrar").click();
        });
        
        document.querySelector('#fe_grado').addEventListener("change", function() {
            document.getElementById("btn_filtrar").click();
        });
        
        document.querySelector('#fe_grupo').addEventListener("change", function() {
            document.getElementById("btn_filtrar").click();
        });

        // Función cada que se agregue un archivo
        let excel_input = document.getElementById('excel_input');
        let students_excel_json;
        
        excel_input.addEventListener('change', (e)=>{
            const file = e.target.files[0];
            const reader = new FileReader();
            let jsonData;
            if (file){
                reader.onload = function (event) {
                    const data = event.target.result;
                    const workbook = XLSX.read(data, { type: 'binary' });
                    const sheetName = workbook.SheetNames[0];
                    const worksheet = workbook.Sheets[sheetName];
                    students_excel_json = XLSX.utils.sheet_to_json(worksheet);
                    
                    document.getElementById('excel_input_label').innerHTML = `Agregar ${Object.keys(students_excel_json).length} estudiante(s)`;
                    document.getElementById('excel_submit_button').disabled = false;
                };
                reader.readAsBinaryString(file);
            }
            else{
                document.getElementById('excel_submit_button').disabled = true;
                document.getElementById('excel_input_label').innerHTML = "";
            }
            
        });

        $(document).ready(function() {
            //sendFilterRequest();
        });

        function agregarPorExcel(){
            let overwrite = document.getElementById('excel_overwrite').checked;
            
            $.ajax({
                url: "{{ route('estudiantes.storeMany') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="crsf-token"]').attr('content')
                },
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    'overwrite': overwrite,
                    'estudiantes': JSON.stringify(students_excel_json)
                },
                success: function(response) {
                    //console.log(response);
                    if(response.message == 'success')
                        window.location.reload();
                },
                error: function(xhr, status, error){
                    //console.log(xhr.responseText);
                }
            });
        }

        function eliminarEstudiante(estudiante_id) {
            let url_to = "{{ route('estudiantes.destroy', ['estudiante_id' => ':id']) }}".replace(':id', estudiante_id);

            $.ajax({
                url: "{{ route('estudiantes.destroy', ['estudiante_id' => ':id']) }}".replace(':id', estudiante_id),
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="crsf-token"]').attr('content')
                },
                success: function(response) {
                    //console.log(response);
                }
            });

        }

        function sendFilterRequest() {
            let turno = $("#fe_turno").val();
            let grado = $("#fe_grado").val();
            let grupo = $("#fe_grupo").val();

            $.ajax({
                url: "{{ route('estudiantes.filter') }}",
                method: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="crsf-token"]').attr('content')
                },
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    'turno': turno,
                    'grado': grado,
                    'grupo': grupo
                },
                success: function(estudiantes) {

                    let x = ``;

                    for (let e of estudiantes) {
                        let url_destroy = "{{ route('estudiantes.destroy', ['estudiante_id' => ':id']) }}"
                            .replace(':id', e.id);
                        let url_update = "{{ route('estudiantes.update', ['estudiante_id' => ':id']) }}"
                            .replace(':id', e.id);

                        x += `
                        <tr>
                            <td>${e.no_lista}</td>
                            <td>` + e.matricula + ` </td>
                            <td>` + e.nombre + `</td>
                            <td>` + e.grado + `</td>
                            <td>` + e.grupo + `</td>
                            <td>${e.turno}</td>
                            <td class="fs4">
                                <!-- Modal para editar-->
                                <div>
                                    <button class="btn btn-info btn-entrar" href="#" type="button" title="Editar"
                                        data-bs-toggle="modal" data-bs-target="#modal_edit_${e.id}">
                                        <i class='fa-solid fa-pen' style='color: white'></i>
                                    </button>
                                    <div class="modal fade" id="modal_edit_${e.id}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title c-primary col-11 text-center fw-bold">Editar
                                                        estudiante</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="${url_update}" autocomplete="off" method="POST"
                                                        id="form_editar_${e.id}" class="form-label-bold">
                                                        @csrf
                                                        @method('put')
                                                        <div class="mb-2">
                                                            <label for="ae_nl_${e.id}" class="form-label c-primary">No. lista</label>
                                                            <input type="number" class="form-control" name="no_lista" id="ae_nl_${e.id}"
                                                                placeholder="No. lista" value="${e.no_lista}" required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="ae_matricula_${e.id}" class="form-label c-primary">Matrícula</label>
                                                            <input type="number" class="form-control" name="matricula" id="ae_matricula_${e.id}"
                                                                placeholder="Matrícula" value="${e.matricula}" required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="ae_nombre_${e.id}" class="form-label c-primary">Nombre</label>
                                                            <input type="text" class="form-control" name="nombre" id="ae_nombre_${e.id}"
                                                                placeholder="Nombre" value="${e.nombre}" required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="ae_grado_${e.id}" class="form-label c-primary">Grado</label>
                                                            <input type="text" class="form-control" name="grado" id="ae_grado_${e.id}"
                                                                placeholder="Grado" value="${e.grado}" required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="ae_grupo_${e.id}" class="form-label c-primary">Grupo</label>
                                                            <input type="text" class="form-control" name="grupo" id="ae_grupo_${e.id}"
                                                                placeholder="Grupo" value="${e.grupo}" required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="ae_turno_${e.id}" class="form-label c-primary">Turno</label>
                                                            <select class="form-control" name="turno" id="ae_turno_${e.id}" required>
                                                                <option value="${e.turno}" selected>Actual (${e.turno})</option>
                                                                <option value="M">Matituno (M)</option>
                                                                <option value="V">Vespertino (V)</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="overwrite" id="ae_overwrite_${e.id}">
                                                                <label class="form-check-label" for="ae_overwrite_${e.id}">
                                                                    <strong class="text-danger">Sobrescribir si ya existe</strong>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary btn-entrar"
                                                        form="form_editar_${e.id}">Guardar
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
                                        data-bs-toggle="modal" data-bs-target="#modal_delete_${e.id}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="modal_delete_${e.id}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title  col-11 text-center">¿Desea eliminar este
                                                        estudiante: <br>
                                                        "${e.nombre}"?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="close"></button>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    
                                                    <form action="${url_destroy}" method="POST">
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
                        `;
                    }
                    document.querySelector('#tabla_estudiantes tbody').innerHTML = x;
                }
            });
        }
    </script>
@endsection
