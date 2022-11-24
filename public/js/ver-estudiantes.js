// formulario de filtros
let fe = JSON.parse(localStorage.getItem("fe"));

document.addEventListener("DOMContentLoaded", function() {
    // Poner fecha de hoy en el input defecha
    colocarFechaHoy();

    // Guardar datos del formulario de filtros en localStorage
    saveVerEstudiantesForm();

    // Cargar datos del localStorage al formulario de filtros
    loadVerEstudiantesForm();

    // Cargar los datos según el formulario de filtros
    //$("#btn_filtrar").click();
    //document.getElementById("btn_filtrar").click();
    //if(document.getElementById("m_get").value){
      //  document.getElementById("btn_filtrar").click();
    //}
    
});

function colocarFechaHoy(){
    var now = new Date();
    var month = (now.getMonth() + 1);               
    var day = now.getDate();
    if (month < 10) 
        month = "0" + month;
    if (day < 10) 
        day = "0" + day;
    var today = now.getFullYear() + '-' + month + '-' + day;
    document.getElementById('fe_fecha').value = today;
}

function saveVerEstudiantesForm(){
    // nota: fe = form estudiantes - datos del localstorage
    if(!fe){
        const obj = {
            turno: document.getElementById("fe_turno").value,
            grado: document.getElementById("fe_grado").value,
            grupo: document.getElementById("fe_grupo").value,
            espacio: document.getElementById("fe_espacio").value,
            fecha: document.getElementById("fe_fecha").value
        }
        localStorage.setItem('fe', JSON.stringify(obj));
    }
    
    // actualizar cada que cambie los valores del formulario
    document.querySelector('#fe_turno').addEventListener("change", function() {
        fe.turno = this.value;
        localStorage.setItem('fe', JSON.stringify(fe));
        document.getElementById("btn_filtrar").click();
    });

    document.querySelector('#fe_grado').addEventListener("change", function() {
        fe.grado = this.value;
        localStorage.setItem('fe', JSON.stringify(fe));
        document.getElementById("btn_filtrar").click();
    });

    document.querySelector('#fe_grupo').addEventListener("change", function() {
        fe.grupo = this.value;
        localStorage.setItem('fe', JSON.stringify(fe));
        document.getElementById("btn_filtrar").click();
    });

    document.querySelector('#fe_espacio').addEventListener("change", function() {
        fe.espacio = this.value;
        localStorage.setItem('fe', JSON.stringify(fe));
        document.getElementById("btn_filtrar").click();
    });

    document.querySelector('#fe_fecha').addEventListener("change", function() {
        fe.fecha = this.value;
        localStorage.setItem('fe', JSON.stringify(fe));
        document.getElementById("btn_filtrar").click();
    });

}

function loadVerEstudiantesForm(){
    if(!fe)
        return;
    document.getElementById("fe_turno").value = fe.turno;
    document.getElementById("fe_grado").value = fe.grado;
    document.getElementById("fe_grupo").value = fe.grupo;
    document.getElementById("fe_espacio").value = fe.espacio;
    document.getElementById("fe_fecha").value = fe.fecha;
}