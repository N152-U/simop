
const decimalsPlaces=2;
defs_datatable.order = [[2, "desc"]];

var tabla = $('#tabla_captura').DataTable(defs_datatable);

var gasto = "0";

var defs_select2 = {
    placeholder: 'Selecciona una opción',
    language: {
        noResults: function (params) {

            return "No se encontraron resultados";
        }
    }
};
$(document).ready(function () {





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
                    "permisos": "('CAPTURA_LUMBRERA0')"
                },
                success: (res) => {

                    res = JSON.parse(res);
                    $.each(res, (key, value) => {

                        console.log(value)
                        if(value.permiso.split("_")[0]=='CAPTURA')
                        {console.log(value.permiso.split("_")[1])
                            console.log( $(`option:contains(${value.permiso.split("_")[1]})`))
                            $(`option:contains('${value.permiso.split("_")[1]}')`).removeAttr('disabled');
                            /* $('#lumbrera_id').val() */
                        }else if(value.permiso.split("_")[0]=='EDITAR'){
                            $("#editar_lumbrera").show();
                        }                          
                    });
                    //Removemos las opciones que no estan autorizadas para el usuario
                    $("#lumbrera_id > option").each(function (key, element) {
                        console.log(key)
                        console.log(element.value)
                        console.log($("#lumbrera_id [value='" + element.value + "']").attr("disabled"));
                        if ($("#lumbrera_id [value='" + element.value + "']").attr("disabled") == 'disabled') {
                        /*     $("#lumbrera_id [value='" + element.value + "']").remove();
                            $('#lumbrera_id').trigger('change.select2'); */
                        }
                    });
                    swal.close();
                }
            });
        }
    });



    $('#lumbrera_id').select2(defs_select2);
    $('#hora_programada').select2(defs_select2);
    $('#transmitio').select2(defs_select2);


/* 
    if ($("#lumbrera_id option:selected").val() != "ALZATE") {

        $("#bombas_contenedor").hide();
        $("#presion_contenedor").hide();
    } else {
        $("#bombas_contenedor").show();
        $("#presion_contenedor").show();
    } */


    $('textarea').characterCounter();
    $('#transmitio').characterCounter();
    $("#lumbrera_id").trigger('change');

    $('.dataTables_wrapper').find("select").formSelect();

});


$("#ayuda").click(function () {
    introJs().start();
});



$("#lumbrera_id").change(function (e) {

    console.log(e.target.value);
    var lumbrera_text = $('#lumbrera_id option:selected').text();
    $("#check_bombas").prop("checked", false);
    $("#check_bombas").trigger("change");

    // $('#bomba_id option').each(function (key, element) {

    //     element.removeAttribute("selected");

    // });

    $('#bomba_id').trigger('change.select2');

    $('#gasto').val("");
    $('#tirante').val("");
    $('#transmitio option').each(function (key, element) {

        element.removeAttribute("selected");

    });

    $('#transmitio').trigger('change.select2');
    $("#presion").val("0.00");
    $('#presion').prop("readonly", true);
    $('#desc_novedades').val("");
    $('#desc_novedades').prop("readonly", false);
    $('#check_desc_novedades').prop("checked", false);

    $('#gasto').prop("readonly", true);

    //Condiciones especiales para los puntos
    if (lumbrera_text == "ALZATE") {

        $('#bomba_id option').each(function (key, element) {
            if (element.value == 1) {
                $(element).prop("disabled", true);
            } else {
                $(element).prop("disabled", false);
            }
        });
        $("#presion").val("3.7");
        $('#bomba_id').val("");
        $('#bomba_id').trigger('change.select2');
        $("#gasto").val("0");

        $("#header_bomba").show();
        $("#header_bomba").css({
            "width": "50px",
            "display": "block",
            "display": "table-cell",
            "text-align": "left",
            "vertical-align": "middle",
            "border-radius": "2px"
        });

        $("#bombas_contenedor").show();
        $("#bomba_id").attr("readonly", false);
        $("#bomba_id").show();
        $("#presion_contenedor").show();
        $("#gasto_contenedor").show();


    } else if (lumbrera_text == "CAIDA DEL BORRACHO") {
        //$('#gasto').prop("readonly",false);
        $('#bomba_id option').each(function (key, element) {
            if (element.value == 1) {
                $(element).prop("disabled", false);
            } else {
                $(element).prop("disabled", true);
            }


        });

        $("#gasto").val("0");
        $("#bombas_contenedor").hide();
        $("#presion_contenedor").hide();
    } else {
        $('#bomba_id option').each(function (key, element) {
            if (element.value == 1) {
                $(element).prop("disabled", false);
            } else {
                $(element).prop("disabled", true);
            }
        });

        $("#gasto").val("0");
        $("#bombas_contenedor").hide();
        $("#presion_contenedor").hide();
    }

    //Inicia peticion para traer datos del punto seleccionado e irlos desplegando en la tabla
    if (lumbrera_text != "") {
        swal({
            title: 'CARGANDO',
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
                $.ajax({
                    url: serverurl + "ajax/capturaLumbreraAjax.php",
                    method: "post",
                    data: {
                        "lumbrera_id": e.target.value,
                        "accion": "CONSULTA"
                    },
                    success: function (res) {
                        res = JSON.parse(res);

                        console.log(res);
                        var $el = $("#hora_programada");
                        //console.log($el);
                        tabla.clear().draw();
                        $.each(res.fechas_registradas, function (key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos

                            addRow(value.lumbrera,value.tirante,value.compuertas, value.hora_programada, value.transmitio, value.novedades)


                        });
                        tabla.columns.adjust().draw(); // Redraw the DataTable

                        $el.empty(); //Se vacia la lista de opciones de articulos para volverla a formar
                        $.each(res.fechas_restantes, function (key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos

                            // console.log(value);
                            $el.append($("<option></option>").attr("value", value).text(value));


                        });
                        swal.close();

                    }

                });


            }

        });



    }

});


/*************************************
        Function: $(".decimal").keyup()
        Params: 
        Action: Da formato decimal a los campos de tipo number que ocupen el nombre de la clase
        Return: 
  **************************************/
$('.decimal').keyup(function () {
    var val = $(this).val();
    if (isNaN(val)) {
        val = val.replace(/[^0-9\.]/g, '');
        if (val.split('.').length > 2)
            val = val.replace(/\.+$/, "");
    }
    $(this).val(val);
});



/*************************************
        Function: addRow(nombre_punto, bomba_id, presion, tirante, gasto, fecha_hora, transmitio, novedades)
        Params: String(nombre_punto), Int(bomba_id), Float(presion), Float(tirante), Float(gasto), String(fecha_hora), String(novedades)
        Action: Añade valores traidos por peticion a la tabla de los registros
        Return: 
  **************************************/

function addRow(nombre_lumbrera, tirante, compuertas, fecha_hora, transmitio, novedades) {

/*     presion = parseFloat(presion).toFixed(decimalsPlaces); */
    tirante = parseFloat(tirante).toFixed(decimalsPlaces);
    gasto = parseFloat(gasto).toFixed(decimalsPlaces);
    tabla.row.add([
        "<input type='hidden'  value =" + (tabla.page.info().recordsTotal + 1) + ">" + (tabla.page.info().recordsTotal + 1),
        '<input  type="hidden"  value ="' + nombre_lumbrera + '">' + nombre_lumbrera,
        '<input type="hidden"   value ="' + fecha_hora + '">' + fecha_hora,
        '<input type="hidden"  value ="' + tirante + '">' + tirante,
        '<input type="hidden"  value ="' + compuertas + '">' + compuertas?'C':'A',
       /*  '<input type="hidden"  value ="' + gasto + '">' + gasto, */
        '<input type="hidden" value ="' + transmitio + '">' + transmitio,
        '<input type="hidden" value ="' + novedades + '">' + novedades

    ]).draw();
    $('#submit').prop("disabled", false);
    $('#bomba_id option').each(function (key, element) {

        element.removeAttribute("selected");

    });

    $('#bomba_id').trigger('change.select2');

    $("#tirante").val("");
    $("#gasto").val("0");
    // $("#transmitio").val("");
    $("#desc_novedades").val("");

}

/*************************************
        Function: $('form').on('submit', function (e))
    Params:
    Action: Manda el formulario a traves de POST con valores parametrizados 
        Return:
  **************************************/

$('#formularioCapturaLumbrera').on('submit', function (e) {
    console.log("Entra formulario");
    e.preventDefault();
    var lumbrera_id = document.getElementById("lumbrera_id");
    var lumbrera_text = $('#lumbrera_id option:selected').text();

    var hora_programada = document.getElementById("hora_programada");

    var presion = document.getElementById("presion");
    var tirante = document.getElementById("tirante");
    var gasto = document.getElementById("gasto").value;


    var transmitio = document.getElementById("transmitio");
    var desc_novedades = document.getElementById("desc_novedades");
    var valido = false;


    ////Se validan condiciones para añadir campos a la tabla
    if (lumbrera_id.value > 0 && tirante.value >= 0 && hora_programada.value != null && transmitio.value != null && desc_novedades.value != null) {
        valido = true;
    }

    if (valido) {

        swal({
            allowOutsideClick: false,
            title: '¿Deseas guardar el registro del punto?',
            text: "El registro será guardado con la información de la tabla",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#03A9F4',
            cancelButtonColor: '#F44336',
            confirmButtonText: '<i class="zmdi zmdi-run"></i> Sí!',
            cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> No, Cancelar!'
        }).then(function (res) {

            console.log($(e.currentTarget).serializeArray());
            var formulario = $(e.currentTarget).serializeArray();
            var transmitio = document.getElementById("transmitio");
            transmitio = transmitio.options[transmitio.selectedIndex].text;


            formulario.push({
                name: "transmitio",
                value: transmitio
            });
            formulario.push({
                name: "accion",
                value: 'GUARDAR',
            });
            $.ajax({
                url: serverurl + "ajax/capturaLumbreraAjax.php",
                method: "post",
                data: $.param(formulario),

                success: function (res) {
                    console.log(res)

                    if (res == 0) {

                        swal({
                            type: "success",
                            title: "El registro se ha guardado con exito",
                            showConfirmButton: true,
                            allowOutsideClick: false
                        }).then(function () {
                            $("#lumbrera_id").trigger('change');
                        });

                    } else {
                        swal({
                            type: "error",
                            title: "El registro no se ha podido guardar",
                            showConfirmButton: true,
                            allowOutsideClick: false
                        }).then(function () {

                        });
                        console.log(res);
                    }


                }



            });


        }).catch(function (e) {
            console.log(e);
        });

    }
    else {

        swal({
            title: 'Advertencia',
            text: 'Complete todos los campos para poder agregar el registro',
            type: 'warning',
            showConfirmButton: true
        }).then(function () {

        }).catch(function () {

        });
    }
    valido = false;





});

/*************************************
        Function: deleteRow(obj)
        Params:
        Action: Elimina registros de la tabla desplegada
        Return:
    Comments: Actualmente sin uso
  **************************************/
function deleteRow(obj) {

    if ($("#lumbrera_id option").length + 1 > 0) {
        $("#lumbrera_id").prop("disabled", false);
        $('#add').show();
    }



    var index = obj.parentNode.parentNode.parentNode.rowIndex;
    var id = parseInt($.parseHTML(tabla.cell($(obj).parents('tr'), 0).data())[0].value);


    tabla.row($(obj).parents('tr'))
        .remove()
        .draw();
    if (tabla.row().count() == 0) {
        $("#transmitio").prop("disabled", false);
        $("#hora_programada").prop("disabled", false);
        $('#submit').prop("disabled", true);
    }
}

/*************************************
        Function: $("input[type=number]").on("focus", function () )
        Params:
        Action: Deniega la accion de aumento y decremento lanzada por las flechas del teclado (arriba/abajo) para los campos de tipo number
        Return:
  **************************************/

$("input[type=number]").on("focus", function () {
    $(this).on("keydown", function (event) {
        if (event.keyCode === 38 || event.keyCode === 40) {
            event.preventDefault();
        }
    });
});


/*************************************
        Function: alertaTirante(lumbrera_id, tirante, target)
    Params: Int(lumbrera_id), Float(tirante), Object(target)
        Action: Muestra alerta de tirante cuando este queda fuera del rango normal de captura del punto en cuestion, permite continuar con el valor utilizado o borrarlo de la etiqueta objetivo (target)
        Return:
  **************************************/

function alertaTirante(lumbrera_id, tirante, target) {

    console.log(lumbrera_id)

    $.ajax({
        url: serverurl + "ajax/capturaLumbreraAjax.php",
        method: "post",
        data: {
            "lumbrera_id": lumbrera_id,
            "accion": "VALIDACION"
        },
        success: function (res) {
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
                }).then(function () {

                }).catch(() => {
                    target.value = '';
                    if (lumbrera_id != 3) {
                        $("#gasto").val('');
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
                }).then(function () {

                }).catch(() => {
                    target.value = '';
                    if (lumbrera_id != 3) {
                        $("#gasto").val('');
                    }

                });

            }

        }
    });
    // $("#unidad").val("l/s");
    /* var regex = /^([0-9]|10)(\.\d{0,2})?$/g;
    if (!regex.test(e.value)) {

        swal({
            type: "warning",
            title: "El número ingresado en tirante no se encuentra dentro del rango permitido (" + min + " a " + max + " y dos decimales)",
            showConfirmButton: true,
            allowOutsideClick: false
        }).then(function () {
            e.value = '';
            $("#gasto").val('');
        });

    } */
}


/*************************************
        Function: calculaGasto(e)
    Params: Object(e)
        Action: Recibe la etiqueta de tirante para hacer el calculo del gasto y asignarle su valor (espera entre cada pulsacion 1 segundo para darle tiempo al usuario que termine de ingresar el dato) valida el dato con alertaTirante
    Return:
  **************************************/


let timeout = null;
function calculaGasto(e) {

    var lumbrera_id = document.getElementById("lumbrera_id").value;
    var lumbrera_text = $('#lumbrera_id option:selected').text();
    var tirante = parseFloat(e.value);
    tirante = tirante.toFixed(5);

    gasto = "0";
    clearTimeout(timeout);

    // Inicia cuenta regresiva de un segundo
    timeout = setTimeout(function () {


        //Inician las condiciones y calculo mediante formula requqerida para cada punto

        if (lumbrera_text.includes("LUMBRERA0")) {
            // gasto = (((0.3324) * (parseInt(tirante))) * 100);
            $("#gasto").val("");
            if (e.value != "") {

                // $("#unidad").val("l/s");
                var regex = /^([0-6])(\.\d{0,2})?$/g;
                if (!regex.test(e.value)) {

                    swal({
                        type: "warning",
                        title: "El número ingresado en tirante no cuenta con el formato permitido (0 a 6 y dos decimales)",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(function () {
                        e.value = '';
                        $("#gasto").val('');
                    });

                } else {
                    alertaTirante(lumbrera_id, tirante, e);
                   
                    const S = 0.002;
                    const n = 0.016;
                    const D = 6.5;
                    const R = 3.25;
                    const teta = 2 * Math.acos(1 - tirante / R);
                    console.log(teta);
                    const Pm = (teta * D) / 2;
                    console.log(Pm);
                    const A = ((R * R) / 2) * (teta - Math.sin(teta));
                    console.log(A);
                    const Rh = A / Pm;
                    console.log(Rh);
                    const V = (1 / n) * Math.pow(Rh, 2 / 3) * Math.pow(S, 1 / 2);
                    console.log(V);
                    const Q = A * V;
                    gasto= Q.toFixed(2);
                    $("#gasto").val(gasto);
                }

            }



        } else if (lumbrera_text == "VENTURYIII") {
            // gasto = (((0.331) * (parseFloat(tirante))) * 100);
            // $("#unidad").val("l/s");
            $("#gasto").val("");
            if (e.value != "") {
                var regex = /^([0-9]|10)(\.\d{0,2})?$/g;
                if (!regex.test(e.value)) {

                    swal({
                        type: "warning",
                        title: "El número ingresado en tirante no cuenta con el formato permitido (0 a 10 y dos decimales)",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(function () {
                        e.value = '';
                        $("#gasto").val('');
                    });

                } else {
                    alertaTirante(lumbrera_id, tirante, e);
                    gasto = (((0.331) * (parseFloat(tirante)) * 1000));
                    gasto = parseFloat(gasto.toFixed(5));
                    $("#gasto").val(gasto);
                }

            }

        } else if (lumbrera_text == "ATARASQUILLO") {
            // $("#unidad").val("l/s");
            if (e.value != "") {
                var regex = /^([0-9]|[1-9][0-9]|[1-3][0-9][0-9]|400)(\.\d{0,2})?$/g;
                if (!regex.test(e.value)) {

                    swal({
                        type: "warning",
                        title: "El número ingresado en tirante no cuenta con el formato permitido (0 a 400 y dos decimales)",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(function () {
                        e.value = '';
                        $("#gasto").val('');
                    });

                } else {
                    alertaTirante(lumbrera_id, tirante, e);
                    gasto = (Math.pow((1.949 * ((Number.parseFloat(tirante)) / 100)), 1.675)) * 1000;
                    gasto = parseFloat(gasto.toFixed(5));
                    $("#gasto").val(gasto);
                }

            }
        } else if (lumbrera_text == "VENADO") {
            // $("#unidad").val("l/s");
            if (e.value != "") {
                var regex = /^([0-9]|[1-9][0-9]|[1-2][0-9][0-9]|300)(\.\d{0,2})?$/g;
                if (!regex.test(e.value)) {

                    swal({
                        type: "warning",
                        title: "El número ingresado en tirante no cuenta con el formato permitido (0 a 300 y dos decimales)",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(function () {
                        e.value = '';
                        $("#gasto").val('');
                    });

                } else {
                    alertaTirante(lumbrera_id, tirante, e);
                    gasto = (Math.pow(((142.90613) * ((parseFloat(tirante)) / 100)), 1.59325551));
                    gasto = parseFloat(gasto.toFixed(5));
                    $("#gasto").val(gasto);
                }

            }
        } else if (lumbrera_text == "DOLORES") {
            // $("#unidad").val("l/s");
            if (e.value != "") {
                var regex = /^([0-9]|[1-9][0-9]|[1-6][0-9][0-9]|700)(\.\d{0,2})?$/g;
                if (!regex.test(e.value)) {

                    swal({
                        type: "warning",
                        title: "El número ingresado en tirante no cuenta con el formato permitido (0 a 700 y dos decimales)",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(function () {
                        e.value = '';
                        $("#gasto").val('');
                    });

                } else {
                    alertaTirante(lumbrera_id, tirante, e);

                    $('#gasto').val("0.00");

                }

            }



        } else if (lumbrera_text == "CAIDA DEL BORRACHO") {
            // $("#unidad").val("l/s");
            if (e.value != "") {
                var regex = /^([0-9])(\.\d{0,2})?$/g;
                if (!regex.test(e.value)) {

                    swal({
                        type: "warning",
                        title: "El número ingresado en tirante no cuenta con el formato permitido (0 a 9 y dos decimales)",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(function () {
                        e.value = '';
                        $("#gasto").val('');
                    });

                } else {
                    alertaTirante(lumbrera_id, tirante, e);
                    gasto = tirante * 1.02875 * 1000;
                    $('#gasto').val(gasto);
                }

            }
        } else if (lumbrera_text == "ALZATE") {
            if (e.value != "") {
                var regex = /^([0-9]|[1-9][0-9]|[1-3][0-9][0-9]|400)(\.\d{0,2})?$/g;
                if (!regex.test(e.value)) {
                    swal({
                        type: "warning",
                        title: "El número ingresado en tirante no cuenta con el formato permitido (0 a 400 y dos decimales)",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(function () {
                        e.value = '';
                    });

                } else {
                    alertaTirante(lumbrera_id, tirante, e);
                }
            }
            // $("#unidad").val("l/s");
        }

    }, 1000);


}

/*************************************
        Function: $("#check_desc_novedades").change(function (e)
        Params: Object(e)
        Action: Presenta/oculta leyenda 'SIN NOVEDADES' segun el estado de check_desc_novedades
        Return:
  **************************************/

$("#check_desc_novedades").change(function (e) {
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
