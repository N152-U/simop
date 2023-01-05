var oculto=0;
$("#editar_anio").click(function() {

    //Preguntamos para alternar entre los formularios de edicion y captura
    oculto = $('#formularioCaptura').is(":hidden");

    if (oculto) {
        document.getElementsByClassName("brand-logo")[0].getElementsByTagName("h5")[0].innerHTML = "Captura";
        document.getElementById("formularioCaptura").hidden = false
        document.getElementById("formularioEdicion").hidden = true
    } else {
        document.getElementsByClassName("brand-logo")[0].getElementsByTagName("h5")[0].innerHTML = "Edicion";
        document.getElementById("formularioCaptura").hidden = true
        document.getElementById("formularioEdicion").hidden = false

    }

});
/**
 * clearDataFields
 *  Funcion para dejar los campos vacios para ingresar nuevos datos
 */
 const clearDataFields = () => {
    document.getElementById("fecha").value = "";
    document.getElementById("gasto_acueducto_real").value = "";
    document.getElementById("gasto_otras_fuentes_real").value = "";
    document.getElementById("transmitio").value = "";

    $('#transmitio_edicion option').each(function(key, element) {

        element.removeAttribute("selected");

        /*  $('#transmitio_edicion').trigger('change.select2'); */
    });

    $('#transmitio_edicion').trigger('change.select2');
  
}




/**
 * showFormFields
 * Funcion para ocultar o mostrar los campos del formulario
 * @param {*} show
 */
 const showFormFields = (show) => {
    if (show) {
        document.getElementById("tabla_contenedor_edicion").classList.add("v-divider-right");
        document.getElementById("tabla_contenedor_edicion").classList.remove("xl12");
        document.getElementById("tabla_contenedor_edicion").classList.add("xl6");
        $("#campos_contenedor_edicion").show();
    } else {
        document.getElementById("tabla_contenedor_edicion").classList.remove("v-divider-right");
        document.getElementById("tabla_contenedor_edicion").classList.add("xl12");
        document.getElementById("tabla_contenedor_edicion").classList.remove("xl6");
        $("#campos_contenedor_edicion").hide();
    }

}
