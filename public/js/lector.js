document.addEventListener("DOMContentLoaded", function() {
    // Poner focus a input cada que carga la página
    document.getElementById("input_matricula").focus();

    // hacer que la selección de espacio se quede guardada
    saveSelectedOption();

    // poner título acorde a la selección actual
    ponerTitulo();

    // funcion para que ponga el foco en el input cada que se presiona tecla
    var body = document.getElementById("body_id");
    body.addEventListener("keydown", function (e){
        let m1 = document.getElementById("input_matricula");
        m1.focus();
    });


});

function saveSelectedOption(){
    let espacio = document.getElementById("espacio");
    if(espacio.options.length<=0){
        document.getElementById("btn_leer_entrada").disabled = true;
        return;
    }
    document.getElementById("btn_leer_entrada").disabled = false;
    
    // si existe una variable en localStorage
    let espacio_selected = localStorage.getItem("espacio_selected");
    if(espacio_selected){
        verifySelected(espacio_selected, espacio)
    }
    else // de no existir, toma la que está seleccionada
        localStorage.setItem("espacio_selected", espacio.value);
    // adicionalmente cada que se cambia la selección, se actualiza la variable del localStorage
    document.querySelector('#espacio').addEventListener("change", function() {
        localStorage.setItem("espacio_selected", this.value);
        // regresar foco
        document.getElementById("input_matricula").focus();

        // actualizar título
        ponerTitulo();
    });
}

// verifica que el valor seleccionado exista
function verifySelected(espacio_selected, espacio){
    for (let i=0; i<espacio.options.length; i++)
        if(espacio_selected==espacio.options[i].value){ // si existe se lo pone y termina
            espacio.value = espacio_selected;
            return;
        }
    // de no encontrar el valor, pone el primero que haya encontrado
    espacio.value = espacio.options[0].value;
    localStorage.setItem("espacio_selected", espacio.value);
}

function ponerTitulo(){
    let espacio = document.getElementById("espacio");
    let selected = espacio.options[espacio.selectedIndex].text; //test2
    document.getElementById("nombre_entrada").innerHTML = `"${selected}"`;

}