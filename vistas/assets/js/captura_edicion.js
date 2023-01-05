defs_datatable.order = [
    [1, "asc"]
];
defs_datatable.columnDefs = [{
        className: "center-align",
        "targets": "_all",
    },
    {
        searchable: false,
        orderable: false,
        targets: [3],
    }
];
defs_datatable.searching = false;
defs_datatable.paging = true;
defs_datatable.pageLength = 10;
defs_datatable.lengthChange = false;
defs_datatable.initComplete = function() {
    // Apply the search
    this.api().columns().every(function() {
        var that = this;

        $('input', this.footer()).on('keyup change clear', function() {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });
}
var calendar;


var current_location_id = 0;

var tabla_edicion = $('#tabla_captura_edicion').DataTable(defs_datatable);

var gasto_edicion = "0";

var defs_select2 = {
    placeholder: 'Selecciona una opción',
    language: {
        noResults: function(params) {

            return "No se encontraron resultados";
        }
    }
};

//Para empezar la numeracion de los ids de las filas de registros que estan disponibles para ser creados
var countEmptyRegisters = 0;
//Para empezar la numeracion de los ids de las filas de registros que estan disponibles para ser editados
var countRegisters = 10000;

var locale = {
    "format": 'YYYY-MM-DD H:mm',
    "separator": " / ",
    "applyLabel": "ACEPTAR",
    "cancelLabel": "CANCELAR",
    "fromLabel": "De",
    "toLabel": "Hasta",
    "customRangeLabel": "Custom",
    "weekLabel": "W",
    "daysOfWeek": [
        "Do",
        "Lu",
        "Ma",
        "Mi",
        "Ju",
        "Vi",
        "Sa"
    ],
    "monthNames": [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
    ],
    "firstDay": 1
};

var registers = new Array();



$(document).ready(function() {

    swal({
        title: 'CARGANDO',
        allowEscapeKey: false,
        allowOutsideClick: false,
        onOpen: () => {
            swal.showLoading();
            $.ajax({
                url: serverurl + "ajax/permisosAjax.php",
                method: "post",
                data: {
                    "accion": "CONSULTAPERMISOS",
                    "permisos": "('EDITARREGISTROVENTURYII'," +
                        "'EDITARREGISTROVENTURYIII'," +
                        "'EDITARREGISTROALZATE'," +
                        "'EDITARREGISTROATARASQUILLO'," +
                        "'EDITARREGISTROVENADO'," +
                        "'EDITARREGISTRODOLORES'," +
                        "'EDITARREGISTROCAIDADELBORRACHO')"
                },
                success: (res) => {

                    res = JSON.parse(res);
                    $.each(res, (key, value) => {

                        if (value.permiso == "EDITARREGISTROVENTURYII") {
                            $("#punto_id_busqueda_edicion [value='1']").attr("disabled", false);
                        } else if (value.permiso == "EDITARREGISTROVENTURYIII") {
                            $("#punto_id_busqueda_edicion [value='2']").attr("disabled", false);
                        } else if (value.permiso == "EDITARREGISTROALZATE") {
                            $("#punto_id_busqueda_edicion [value='3']").attr("disabled", false);
                        } else if (value.permiso == "EDITARREGISTROATARASQUILLO") {
                            $("#punto_id_busqueda_edicion [value='4']").attr("disabled", false);
                        } else if (value.permiso == "EDITARREGISTROVENADO") {
                            $("#punto_id_busqueda_edicion [value='5']").attr("disabled", false);
                        } else if (value.permiso == "EDITARREGISTRODOLORES") {
                            $("#punto_id_busqueda_edicion [value='6']").attr("disabled", false);
                        } else if (value.permiso == "EDITARREGISTROCAIDADELBORRACHO") {
                            $("#punto_id_busqueda_edicion [value='7']").attr("disabled", false);
                        }

                    });
                    $("#punto_id_busqueda_edicion > option").each(function() {
                        console.log(this.value);
                        if ($("#punto_id_busqueda_edicion [value='" + this.value + "']").attr("disabled") == 'disabled') {
                            $("#punto_id_busqueda_edicion [value='" + this.value + "']").remove();
                            $('#punto_id_busqueda_edicion').trigger('change.select2');

                        }
                    });
                    swal.close();
                }
            });
        }
    });

    $('#punto_id_busqueda_edicion').select2(defs_select2);
    //$('#hora_programada_edicion').select2(defs_select2);
    $('#bomba_id_edicion').select2(defs_select2);
    $("#transmitio_edicion").select2(defs_select2);


    $('#daterange_diario_edicion').daterangepicker({
        startDate: moment(),
        endDate: moment(),
        minYear: 1999,
        maxYear: moment().year(),
        maxDate: moment(),
        timePicker24Hour: true,
        timePicker24Hour: true,
        locale: {

            "format": 'YYYY-MM-DD H:mm',
            "separator": " / ",
            "applyLabel": "ACEPTAR",
            "cancelLabel": "CANCELAR",
            "fromLabel": "De",
            "toLabel": "Hasta",
            "customRangeLabel": "Personalizado",
            "weekLabel": "W",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        },
        ranges: {
            'Hoy': [moment(), moment()],
            'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Ultimos 7 días': [moment().subtract(6, 'days'), moment()],
            'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
            'Este Mes': [moment().startOf('month'), moment().endOf('month')],
            'Mes Anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    /* calendar = $('#daterange_diario_edicion').daterangepicker({
         autoUpdateInput: true,
         //forceUpdate: true,
         //callbackAtInit: true,
         opens: 'center',
         showDropdowns: true,
         startDate: moment(),
         endDate: moment(),
         minYear: 1999,
         maxYear: moment().year(),
         maxDate: moment(),
         timePicker24Hour: true,
         locale: locale
     }, function (start, end, label) {

      
         console.log(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
         //if (end.format('YYYY-MM-DD') == moment().format('YYYY-MM-DD')) {
         //     end = moment().format('YYYY-MM-DD H:mm')
          //} else {
          //    end = end.format('YYYY-MM-DD 23:59')
         //} 
         if (current_location_id != "" && current_location_id != null && current_location_id != undefined) {
             getTableData(current_location_id, start.format('YYYY-MM-DD 00:00'), end.format('YYYY-MM-DD H:mm')).then((data) => {

                 //console.log(JSON.parse(data));
                 registers = JSON.parse(data)
                 tabla_edicion.clear().draw();
                 $.each(registers.fechas_registradas, function (key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos

                     addRowEdicion(value.registro_id, value.punto, value.bomba_id, value.bombas_usadas, value.presion, value.tirante, value.gasto, value.hora_programada, value.transmitio, value.novedades, true)

                 });

                 $.each(registers.fechas_restantes, function (key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos
                     //console.log(data)
                     addRowEdicion("", "", "", "", "", "", "", value, "", "", false)


                 });
                 tabla_edicion.columns.adjust().draw(); // Redraw the DataTable


             }).then((data) => {
                 //console.log(data)
             }
             ).finally(() => {

                 countEmptyRegisters = 0;
                 countRegisters = 10000;
                 swal.close();
             });

         }




     });*/



})



/**
 * clearDataFields
 *  Funcion para dejar los campos vacios para ingresar nuevos datos
 */
const clearDataFields = () => {
    document.getElementById("nombre_punto_edicion").value = "";
    document.getElementById("punto_id_edicion").value = "";
    document.getElementById("hora_programada_edicion").value = "";
    document.getElementById("bomba_id_edicion").value = "";
    $("#bomba_id_edicion").attr("readonly", false);
    document.getElementById("check_bombas_edicion").checked = false;
    document.getElementById("presion_edicion").value = "";
    document.getElementById("tirante_edicion").value = "";
    document.getElementById("gasto_edicion").value = "";
    $("#gasto_edicion").attr("readonly", true);
    $('#transmitio_edicion option').each(function(key, element) {

        element.removeAttribute("selected");

        /*  $('#transmitio_edicion').trigger('change.select2'); */
    });

    $('#transmitio_edicion').trigger('change.select2');
    document.getElementById("desc_novedades_edicion").value = "";
    document.getElementById("check_desc_novedades_edicion").checked = false;
    //document.getElementById("daterange_diario_edicion").value = "";
    $('#bomba_id_edicion option').each(function(key, element) {

        element.removeAttribute("selected");
        element.removeAttribute("disabled");
        $('#bomba_id_edicion').trigger('change.select2');
    });

}

/**
 *  initFieldsWithConstraints
 *  Funcion para inicializar campos con valores por default segun las reglas para cada punto
 * @param {*} pozo_text
 */
const initFieldsWithConstraints = (pozo_text) => {

    //Condiciones especiales para los puntos
    if (pozo_text == "ALZATE") {

        $("#check_bombas_edicion").prop("checked", false);
        $("#check_bombas_edicion").trigger("change");
        $('#bomba_id_edicion option').each(function(key, element) {
            if (element.value == 1) {
                $(element).prop("disabled", true);
            } else {
                $(element).prop("disabled", false);
            }
        });
        $("#presion_edicion").val("3.7");
        $('#bomba_id_edicion').val("");
        $('#bomba_id_edicion').trigger('change.select2');
        $("#gasto_edicion").val("0");


        $("#bombas_contenedor_edicion").show();
        $("#bomba_id_edicion").attr("readonly", false);
        $("#bomba_id_edicion").show();
        $("#presion_contenedor_edicion").show();
        $("#gasto_contenedor_edicion").show();


    } else {
        $("#check_bombas_edicion").prop("checked", true);
        $("#check_bombas_edicion").trigger("change");
        $('#bomba_id_edicion option').each(function(key, element) {
            if (element.value == 1) {
                $(element).prop("disabled", false);
            } else {
                $(element).prop("disabled", true);
            }
        });
        $('#bomba_id_edicion').val("1");
        $('#bomba_id_edicion').trigger('change.select2');
        $("#gasto_edicion").val("0");
        $("#bombas_contenedor_edicion").hide();
        $("#presion_contenedor_edicion").hide();
    }
}


$("#punto_id_busqueda_edicion").change(function(e) {

    tabla_edicion.clear().draw();

    document.getElementById("daterange_diario_edicion").disabled = false;

    clearDataFields();

    console.log(e.target.value);
    current_location_id = e.target.value;
    var pozo_text = $('#punto_id_busqueda_edicion option:selected').text();

    initFieldsWithConstraints(pozo_text)

    showFormFields(false);

    //$("#punto_id_busqueda_edicion").trigger('change');




});



$("#editar_punto").click(function() {

    //Preguntamos para alternar entre los formularios de edicion y captura
    oculto = $('#formularioCaptura').is(":hidden");

    if (oculto) {
        document.getElementsByClassName("brand-logo")[0].getElementsByTagName("h5")[0].innerHTML = "Captura";
        document.getElementById("formularioCaptura").hidden = false
        document.getElementById("formularioEdicion").hidden = true
        document.getElementById("formularioConsultaEdicion").hidden = true
    } else {
        document.getElementsByClassName("brand-logo")[0].getElementsByTagName("h5")[0].innerHTML = "Edicion";
        document.getElementById("formularioCaptura").hidden = true
        document.getElementById("formularioEdicion").hidden = false
        document.getElementById("formularioConsultaEdicion").hidden = false

    }

});



/**
 *
 * getTableData: la funcion nos traera los datos de las horas registradas y las pendientes por registrar dentro del rango de fechas
 * proporcionados como parametros
 * @param {*} id
 * @param {*} start_date
 * @param {*} end_date
 */
const getTableData = async function(id, start_date, end_date) {

    let res = await $.ajax({
        //url: serverurl + "/vistas/assets/js/data.json",
        url: serverurl + "ajax/capturaAjax.php",
        method: "post",
        //dataType: "json",
        statusCode: {
            400: function (e) {
                e.responseText = JSON.parse(e.responseText);
                console.log(e.response);
                let errString = "";
                e.responseText.map((value, key) => {
                    console.log(value);
                    errString += value
                });
                swal({
                    type: "error",
                    title: errString,
                    showConfirmButton: true,
                    allowOutsideClick: false
                }
                ).then(function () {

                });
            },
            401: function (e) {
                swal({
                    type: "error",
                    title: e.statusText,
                    showConfirmButton: true,
                    allowOutsideClick: false
                }
                ).then(function () {
                    window.location.href = serverurl;
                });
            },
        },
        data: { "accion": "CONSULTAFECHASEDICION", "punto_id": id, "fecha_hora_inicial": start_date, "fecha_hora_final": end_date },
        error: function(error) {
            //Se activa cuando se termina el tiempo de espera
            //
            // swal.close();
            swal({
                type: "error",
                title: "El tiempo de espera se ha agotado",
                showConfirmButton: true,
                allowOutsideClick: false
            }).then(function() {

            });
        },
        success: function(res) {
            try {
                //console.log(res);

                return res;

            } catch (e) {
                //
                console.log(e)
                swal({
                    type: "error",
                    title: "Hubo un error al procesar el reporte",
                    text: "Intente con un intervalo diferente",
                    showConfirmButton: true,
                    allowOutsideClick: false
                }).then(function() {

                });
            }


        },
        timeout: 5000
    });

    return res;

}

/**
 * addRowEdicion nos ayudara a pintar los articulos en la tabla
 *
 * @param {number} [registro_id=0]
 * @param {*} nombre_punto
 * @param {*} bomba_id
 * @param {*} bombas_usadas
 * @param {*} presion
 * @param {*} tirante
 * @param {*} gasto
 * @param {*} hora_programada
 * @param {*} transmitio
 * @param {*} novedades
 * @param {*} edicion
 */
const addRowEdicion = (registro_id = 0, nombre_punto, bomba_id, bombas_usadas, presion, tirante, gasto, hora_programada, transmitio, novedades, edicion) => {
    //console.log(registro_id)
    //console.log(nombre_punto)
    //console.log(edicion)
    let pozo_text = $('#punto_id option:selected').text();
    let action_html = "";
    //console.log(action_html);
    let record_id;
    if (edicion) {
        action_html = ' <a href="#" onclick="dataToFields(' + (countRegisters) + ', false)" class="btn buttons-accion editar-registro blue" role="button"><i class="fas fa-edit fa-sm"></i></a>'
        record_id = countRegisters;
        countRegisters++;
    } else {
        action_html = ' <a href="#" onclick="dataToFields(' + (countEmptyRegisters) + ', true)" class="btn buttons-accion crear-registro indigo" role="button"><i class="fas fa-plus fa-sm"></i></a>';
        record_id = countEmptyRegisters;
        countEmptyRegisters++;
    }
    //console.log(record_id)
    tabla_edicion.row.add([
        `<input type="hidden"  id="field_${(tabla_edicion.page.info().recordsTotal + 1)}" value ="${(tabla_edicion.page.info().recordsTotal + 1)}"> ${(tabla_edicion.page.info().recordsTotal + 1)}`,
        `<input  type="hidden" id="hora_programada_field_${(record_id)}" value ="${hora_programada}">` + hora_programada,
        `<input type="hidden" id="tirante_field_${(record_id)}" value ="${tirante}">` + tirante,
        `<input type="hidden" value ="">` + action_html,
        `<input type="hidden" id="transmitio_field_${(record_id)}" value ="${transmitio}">` + transmitio,
        `<input  type="hidden" id="registro_id_field_${(record_id)}" value ="${registro_id}">` + registro_id,
        `<input  type="hidden" id="nombre_punto_field_${(record_id)}" value ="${pozo_text}">` + pozo_text,
        `<input type="hidden" id="bombas_usadas_field_${(record_id)}" value ="${bombas_usadas}">` + bombas_usadas,
        `<input type="hidden" id="bomba_id_field_${(record_id)}" value ="${bomba_id}">` + bomba_id,
        `<input type="hidden" id="presion_field_${(record_id)}" value ="${presion}">` + presion,

        `<input type="hidden" id="gasto_field_${(record_id)}"  value ="${gasto}">` + gasto,

        '<input type="hidden" value ="' + novedades + '">' + novedades

    ]).draw();


}

/**
 * dataToFields: Pasar los datos de la tabla a los campos para poder realizar su modificacion
 * Hacemos uso de la variable global registers que contiene los datos de los elementos de la tabla
 *
 * @param {*} id
 * @param {*} only_date
 */
const dataToFields = (id, only_date) => {


    clearDataFields();
    //Le quitamos 10000 que teniamos en el id para recuperar el indice perteneciente a la fila que estamos editando
    if (!only_date) {
        id = id - 10000
    }

    document.getElementById("registro_id_edicion").disabled = true;
    $("#transmitio_edicion").attr("readonly", false);
    document.getElementById("field_" + id);

    showFormFields(true);

    document.getElementById("campos_contenedor_edicion").hidden = false;

    document.getElementById("check_desc_novedades_edicion").checked = false;
    document.getElementById("check_desc_novedades_edicion").dispatchEvent(new Event('change'));

    //La hora esta libre para ser capturada (no habia sido ingresada)
    if (only_date) {

        $("#submit_edicion").val("GUARDAR");
        $("#transmitio_edicion").attr("readonly", false);

        var pozo_text = $('#punto_id_busqueda_edicion option:selected').text();

        document.getElementById("nombre_punto_edicion").value = pozo_text;
        initFieldsWithConstraints(pozo_text)
        document.getElementById("punto_id_edicion").value = document.getElementById("punto_id_busqueda_edicion").value;
        document.getElementById("hora_programada_edicion").value = registers.fechas_restantes[id];

    } else {
        //La hora ya habia sido ingresada, por lo que se recuperan los datos del arreglo global registers
        $("#submit_edicion").val("EDITAR");
        console.log(id);
        console.log(registers.fechas_registradas[id]);
        document.getElementById("registro_id_edicion").disabled = false;
        document.getElementById("registro_id_edicion").value = registers.fechas_registradas[id].registro_id;
        document.getElementById("nombre_punto_edicion").value = registers.fechas_registradas[id].punto;
        document.getElementById("punto_id_edicion").value = registers.fechas_registradas[id].punto_id;
        document.getElementById("hora_programada_edicion").value = registers.fechas_registradas[id].hora_programada;
        document.getElementById("check_bombas_edicion").checked = false;
        retrieveBombas(registers.fechas_registradas[id].bombas_usadas);

        document.getElementById("presion_edicion").value = registers.fechas_registradas[id].presion;
        document.getElementById("tirante_edicion").value = registers.fechas_registradas[id].tirante;
        document.getElementById("gasto_edicion").value = registers.fechas_registradas[id].gasto;
        $('#transmitio_edicion option[value="' + registers.fechas_registradas[id].usuario_id + '"]').attr('selected', true);

        $('#transmitio_edicion').trigger('change.select2');
        document.getElementById("desc_novedades_edicion").classList.remove("invalid");
        document.getElementById("desc_novedades_edicion").value = registers.fechas_registradas[id].novedades;
        document.getElementById("check_desc_novedades_edicion").checked = false;

    }

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

/**
 *retrieveBombas
 *Funcion para repintar las bombas de un registro en su correspondiente input
 recibiendo la cadena bombas_usadas similar al siguiente ejemplo: 2,3,4
activaria en el input la seleccion de la bomba 1, bomba 2, bomba 3
 * @param {*} bombas_usadas
 */
const retrieveBombas = (bombas_usadas) => {
    element = document.getElementById("bomba_id_edicion");
    bombas_usadas = bombas_usadas.split(",");

    if (bombas_usadas.length == 1 && bombas_usadas[0] == 1) {
        console.log(bombas_usadas)
        $('#check_bombas_edicion').trigger('click');

    } else {

        $('#bomba_id_edicion option').each(function(key, element) {
            //console.log(element.value)
            if (bombas_usadas.includes(element.value, 0)) {
                console.log(element.value)
                    // $('#bomba_id_edicion option[value="' + element.value + '"]').attr('selected', true);
                element.selected = true;
                $('#bomba_id_edicion').trigger('change.select2');
            }
        });

    }

}


$("#check_bombas_edicion").change((e) => {
    //console.log("change");

    if (e.target.checked) {
        $('#bomba_id_edicion option').each(function(key, element) {
            //console.log(element)

            if (element.value != 1) {
                element.selected != true ? element.selected = false : element.selected = false;
                element.disabled != true ? element.disabled = true : element.disabled = false;
            } else {
                element.selected = true;
                element.disabled = false;
                $("#bomba_id_edicion").attr("readonly", "readonly");
            }
        });
        $("#presion_edicion").val("0.00");
        $("#bomba_id_edicion").prop("required", false);
    } else {
        $('#bomba_id_edicion option').each(function(key, element) {
            if (element.value != 1) {
                // element.selected != false ? element.selected=false : element.selected=true;
                element.disabled != true ? element.disabled = true : element.disabled = false;
            } else {
                element.disabled = true;
                element.selected = false;
                $("#bomba_id_edicion").attr("readonly", false);
            }
        });
        $("#bomba_id_edicion").prop("required", true);
        $("#presion_edicion").val("3.7");
    }

    $("#gasto_edicion").val("0");
    $('#bomba_id_edicion').trigger('change.select2');
})


/*************************************
        Function: alertaTirante(punto_id, tirante, target)
    Params: Int(punto_id), Float(tirante), Object(target)
        Action: Muestra alerta de tirante cuando este queda fuera del rango normal de captura del punto en cuestion, permite continuar con el valor utilizado o borrarlo de la etiqueta objetivo (target)
        Return:
  **************************************/

function alertaTiranteEdicion(punto_id, tirante, target) {

    console.log(punto_id)

    $.ajax({
        url: serverurl + "ajax/capturaAjax.php",
        method: "post",
        data: {
            "punto_id": punto_id,
            "accion": "VALIDACION"
        },
        success: function(res) {
            res = JSON.parse(res)[0];
            console.log(res)
            console.log(tirante)
            console.log(parseFloat(res.maximo))
            if (tirante > parseFloat(res.maximo)) {

                swal({
                    type: "warning",
                    title: "El tirante se encuentra arriba de lo normal",
                    text: "¿Desea continuar usando este valor?",
                    showConfirmButton: true,
                    confirmButtonText: "Continuar",
                    showCancelButton: true,
                    cancelButtonText: "Usar otro valor",
                    allowOutsideClick: false
                }).then(function() {

                }).catch(() => {
                    target.value = '';
                    if (punto_id != 3) {
                        $("#gasto_edicion").val('');
                    }

                });


            } else if (tirante < parseFloat(res.minimo)) {
                console.log(tirante)
                swal({
                    type: "warning",
                    title: "El tirante se encuentra por debajo de lo normal",
                    text: "¿Desea continuar usando este valor?",
                    showConfirmButton: true,
                    confirmButtonText: "Continuar",
                    showCancelButton: true,
                    cancelButtonText: "Usar otro valor",
                    allowOutsideClick: false
                }).then(function() {

                }).catch(() => {
                    target.value = '';
                    if (punto_id != 3) {
                        $("#gasto_edicion").val('');
                    }

                });

            }

        }
    });
}



$('#formularioEdicion').on('submit', function(e) {
    console.log("Entra formulario");
    e.preventDefault();



    var punto_id = document.getElementById("punto_id_edicion");
    var hora_programada = document.getElementById("hora_programada_edicion");
    var presion = document.getElementById("presion_edicion");
    var tirante = document.getElementById("tirante_edicion");
    var gasto = document.getElementById("gasto_edicion");
    var transmitio = document.getElementById("transmitio_edicion");
    var desc_novedades = document.getElementById("desc_novedades_edicion");
    var bombas_size = $('#bomba_id_edicion').val().length
    var valido = false;


    ////Se validan condiciones para añadir campos a la tabla
    if (punto_id.value > 0 && tirante.value >= 0 && bombas_size > 0 && hora_programada.value != null && transmitio.value != null && desc_novedades.value != null) {
        valido = true;
    }

    if (valido) {

        swal({
            allowOutsideClick: false,
            title: '¿Deseas guardar el registro del punto?',
            text: "El registro será guardado con la información de los campos",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#03A9F4',
            cancelButtonColor: '#F44336',
            confirmButtonText: '<i class="zmdi zmdi-run"></i> Sí!',
            cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> No, Cancelar!'
        }).then(function(res) {

            //console.log($(e.currentTarget).serializeArray());
            var formulario = $(e.currentTarget).serializeArray();
            var transmitio = document.getElementById("transmitio_edicion");
            transmitio = transmitio.options[transmitio.selectedIndex].text;
            formulario.push({
                name: "accion",
                value: 'EDITAR',

            });
            formulario.push({

                name: "transmitio",
                value: transmitio
            });


            $.ajax({
                url: serverurl + "ajax/capturaAjax.php",
                method: "post",
                data: $.param(formulario),

                success: function(res) {

                    if (res == 0) {

                        swal({
                            type: "success",
                            title: "El registro se ha guardado con exito",
                            showConfirmButton: true,
                            allowOutsideClick: false
                        }).then(function() {
                            showFormFields(false);

                            $("#punto_id_busqueda_edicion").trigger('change');

                        });

                    } else {

                        swal({
                            type: "error",
                            title: "El registro no se ha podido guardar",
                            showConfirmButton: true,
                            allowOutsideClick: false
                        }).then(function() {

                        });
                        console.log(res);
                    }


                }



            });


        }).catch(function(e) {
            console.log(e)
        });

    } else {

        swal({
            title: 'Advertencia',
            text: 'Complete todos los campos para poder agregar el registro',
            type: 'warning',
            showConfirmButton: true
        }).then(function() {

        }).catch(function() {

        });
    }
    valido = false;


});

$('#formularioConsultaEdicion').on('submit', function(e) {
    e.preventDefault();
    if (current_location_id != "" && current_location_id != null && current_location_id != undefined) {
        let startDate = $('#daterange_diario_edicion').data('daterangepicker').startDate.format('YYYY-MM-DD H:mm');
        let endDate = $('#daterange_diario_edicion').data('daterangepicker').endDate.format('YYYY-MM-DD H:mm');
        getTableData(current_location_id, startDate, endDate).then(function(data) {

            //console.log(JSON.parse(data));
            registers = JSON.parse(data)
            tabla_edicion.clear().draw();
            $.each(registers.fechas_registradas, function(key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos

                addRowEdicion(value.registro_id, value.punto, value.bomba_id, value.bombas_usadas, value.presion, value.tirante, value.gasto, value.hora_programada, value.transmitio, value.novedades, true)

            });

            $.each(registers.fechas_restantes, function(key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos
                //console.log(data)
                addRowEdicion("", "", "", "", "", "", "", value, "", "", false)


            });
            tabla_edicion.columns.adjust().draw(); // Redraw the DataTable


        }).finally(function() {
            //Reasignamos la cuenta para asignar los ids de las filas que se mostraran en la tabla
            countEmptyRegisters = 0;
            countRegisters = 10000;
            swal.close();
        });

    }


});

let timeout_edicion = null;


/**
 *  Function: calculaGasto(e)
 *  Action: Recibe la etiqueta de tirante para hacer el calculo del gasto y asignarle su valor (espera entre cada pulsacion 1 segundo para darle tiempo al usuario que termine de ingresar el dato) valida el dato con alertaTirante
 *  @param {*} e
 *  Return:
 */
function calculaGastoEdicion(e) {
    console.log(e.value);
    var punto_id = document.getElementById("punto_id_edicion").value;
    var pozo_text = $('#punto_id_busqueda_edicion option:selected').text();
    var tirante = parseFloat(e.value);
    tirante = tirante.toFixed(5);

    let gasto = "0";
    clearTimeout(timeout_edicion);

    // Inicia cuenta regresiva de un segundo
    timeout_edicion = setTimeout(function() {

        console.log(pozo_text);
        //Inician las condiciones y calculo mediante formula requqerida para cada punto

        if (pozo_text == "VENTURYII") {
            // gasto = (((0.3324) * (parseInt(tirante))) * 100);
            $("#gasto_edicion").val("");
            if (e.value != "") {

                // $("#unidad").val("l/s");
                var regex = /^([0-9]|10)(\.\d{0,2})?$/g;
                if (!regex.test(e.value)) {

                    swal({
                        type: "warning",
                        title: "El número ingresado en tirante no cuenta con el formato permitido (0 a 10 y dos decimales)",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(function() {
                        e.value = '';
                        $("#gasto_edicion").val('');
                    });

                } else {
                    alertaTiranteEdicion(punto_id, tirante, e);
                    gasto = (((0.3324) * (parseFloat(tirante)) * 1000));
                    gasto = parseFloat(gasto.toFixed(5));
                    $("#gasto_edicion").val(gasto);
                }

            }



        } else if (pozo_text == "VENTURYIII") {
            // gasto = (((0.331) * (parseFloat(tirante))) * 100);
            // $("#unidad").val("l/s");
            $("#gasto_edicion").val("");
            if (e.value != "") {
                var regex = /^([0-9]|10)(\.\d{0,2})?$/g;
                if (!regex.test(e.value)) {

                    swal({
                        type: "warning",
                        title: "El número ingresado en tirante no cuenta con el formato permitido (0 a 10 y dos decimales)",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(function() {
                        e.value = '';
                        $("#gasto_edicion").val('');
                    });

                } else {
                    alertaTiranteEdicion(punto_id, tirante, e);
                    gasto = (((0.331) * (parseFloat(tirante)) * 1000));
                    gasto = parseFloat(gasto.toFixed(5));
                    $("#gasto_edicion").val(gasto);
                }

            }

        } else if (pozo_text == "ATARASQUILLO") {
            // $("#unidad").val("l/s");
            if (e.value != "") {
                var regex = /^([0-9]|[1-9][0-9]|[1-3][0-9][0-9]|400)(\.\d{0,2})?$/g;
                if (!regex.test(e.value)) {

                    swal({
                        type: "warning",
                        title: "El número ingresado en tirante no cuenta con el formato permitido (0 a 400 y dos decimales)",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(function() {
                        e.value = '';
                        $("#gasto_edicion").val('');
                    });

                } else {
                    alertaTiranteEdicion(punto_id, tirante, e);
                    gasto = (Math.pow((1.949 * ((Number.parseFloat(tirante)) / 100)), 1.675)) * 1000;
                    gasto = parseFloat(gasto.toFixed(5));
                    $("#gasto_edicion").val(gasto);
                }

            }
        } else if (pozo_text == "VENADO") {
            // $("#unidad").val("l/s");
            if (e.value != "") {
                var regex = /^([0-9]|[1-9][0-9]|[1-2][0-9][0-9]|300)(\.\d{0,2})?$/g;
                if (!regex.test(e.value)) {

                    swal({
                        type: "warning",
                        title: "El número ingresado en tirante no cuenta con el formato permitido (0 a 300 y dos decimales)",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(function() {
                        e.value = '';
                        $("#gasto_edicion").val('');
                    });

                } else {
                    alertaTiranteEdicion(punto_id, tirante, e);
                    gasto = (Math.pow(((142.90613) * ((parseFloat(tirante)) / 100)), 1.59325551));
                    gasto = parseFloat(gasto.toFixed(5));
                    $("#gasto_edicion").val(gasto);
                }

            }
        } else if (pozo_text == "DOLORES") {
            // $("#unidad").val("l/s");
            if (e.value != "") {
                var regex = /^([0-9]|[1-9][0-9]|[1-6][0-9][0-9]|700)(\.\d{0,2})?$/g;
                if (!regex.test(e.value)) {

                    swal({
                        type: "warning",
                        title: "El número ingresado en tirante no cuenta con el formato permitido (0 a 700 y dos decimales)",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(function() {
                        e.value = '';
                        $("#gasto_edicion").val('');
                    });

                } else {
                    alertaTiranteEdicion(punto_id, tirante, e);

                    $('#gasto_edicion').val("0.00");

                }

            }



        } else if (pozo_text == "CAIDA DEL BORRACHO") {
            // $("#unidad").val("l/s");
            if (e.value != "") {
                var regex = /^([0-9])(\.\d{0,2})?$/g;
                if (!regex.test(e.value)) {

                    swal({
                        type: "warning",
                        title: "El número ingresado en tirante no cuenta con el formato permitido (0 a 9 y dos decimales)",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(function() {
                        e.value = '';
                        $("#gasto_edicion").val('');
                    });

                } else {
                    alertaTiranteEdicion(punto_id, tirante, e);
                    gasto = tirante * 1.02875 * 1000;
                    $('#gasto_edicion').val(gasto);
                }

            }
        } else if (pozo_text == "ALZATE") {
            if (e.value != "") {
                var regex = /^([0-9]|[1-9][0-9]|[1-3][0-9][0-9]|400)(\.\d{0,2})?$/g;
                if (!regex.test(e.value)) {
                    swal({
                        type: "warning",
                        title: "El número ingresado en tirante no cuenta con el formato permitido (0 a 400 y dos decimales)",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(function() {
                        e.value = '';
                    });

                } else {
                    alertaTiranteEdicion(punto_id, tirante, e);
                }
            }
            // $("#unidad").val("l/s");
        }

    }, 1000);


}



/*************************************
        Function: $("#check_bombas").change((e))
        Params: 
        Action: Verifica el estado del check de bombas para activar/desactivar el selector
    Return: 
  **************************************/


$("#bomba_id_edicion").change(function(e) {
    var suma = 0;
    $('#bomba_id_edicion option').each(function(key, element) {
        element.selected == true ? suma += obtenValorBomba(element.text) : '';
    });
    $("#gasto_edicion").val(suma);
});


/*************************************
        Function: obtenValorBomba(cadena)
    Params: String(cadena) -  Texto de la opcion del selector de bombas elegida, ej: 'BOMBA1 (500)'
        Action: Verifica el estado del check de bombas para activar/desactivar el selector
    Return: Int(valor) - ej: 500
  **************************************/


function obtenValorBomba(cadena) {

    var inicio = cadena.indexOf('(') + 1;
    var fin = cadena.indexOf(')');

    if (inicio >= 0 && fin >= 0) {
        console.log(inicio);
        console.log(fin);
        console.log(cadena.substring(inicio, fin));
        valor = parseInt(cadena.substring(inicio, fin));

    } else {
        valor = 0;
    }

    return valor;
}


/*************************************
        Function: $("#check_desc_novedades").change(function (e)
        Params: Object(e)
        Action: Presenta/oculta leyenda 'SIN NOVEDADES' segun el estado de check_desc_novedades
        Return:
  **************************************/

$("#check_desc_novedades_edicion").change(function(e) {
    var id = e.target.id;
    var idnuevo = id.replace("check_", "");
    if ($("#" + id).prop("checked") == true) {

        $("#" + idnuevo).val("SIN NOVEDAD");
        $("#" + idnuevo).prop("readonly", true);
        $("#" + idnuevo).select();
        $("#" + idnuevo).removeClass("validate invalid");

        //$("label[for="+idnuevo+"]").hide();


    } else {

        $("#" + idnuevo).val("");
        $("#" + idnuevo).prop("readonly", false);
        $("#" + idnuevo).addClass("validate invalid");
        //$("label[for="+idnuevo+"]").show();

    }
})