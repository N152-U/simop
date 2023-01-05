
var tabla = $('#tabla_novedades').DataTable(defs_datatable);
$(document).ready(function () {
    //consulta para mostrar la tabla de las novedades del dia
    $("#crear_novedad").addClass("disabled");
    var activa_campos = false;
    $.ajax({
        url: serverurl + "ajax/permisosAjax.php",
        method: "post",
        data: { "accion": "CONSULTAPERMISOS", "permisos": "('LEERNOVEDAD','CREARNOVEDAD','EDITARNOVEDAD','ELIMINARNOVEDAD')" },
        success: (res) => {
            res = JSON.parse(res);
            console.log(res);
            $.each(res, (key, value) => {

                if (value.permiso == "CREARNOVEDAD") {
                    $("#crear_novedad").removeClass("disabled");
                    activa_campos = true;
                } 
            });
            //Segun los permisos consultados decide si permitira modificar los campos
            $("input").each((key, value) => {
                value.disabled = activa_campos ? false : true;
            });
            $("textarea").each((key, value) => {
                value.disabled = activa_campos ? false : true;
            });
            $("select").each((key, value) => {
                value.disabled = activa_campos ? false : true;
            });
        }
    });
    
    
    $.ajax({
        url: serverurl + "ajax/novedadesAjax.php",
        method: "post",
        data: {
            "accion": "CONSULTA"
        },
        success: function (res) {
            res = JSON.parse(res);
            // 
            tabla.clear().draw();
            $.each(res, function (key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos

                tipo = value.tipo_afectacion;
                hora_afectacion_inicio = value.hora_inicio;
                hora_afectacion_final = value.hora_final;
                lugar_afectacion = value.lugar_afectacion;
                gasto = value.gasto;
                razon = value.razon;
                reporto = value.reporto;
                centro_informacion = value.recibio_centro_informacion;
                hora_ci = value.hora_centro_informacion;
                san_joaquin = value.recibio_san_joaquin;
                hora_sj = value.hora_san_joaquin;

                console.log($(tipo).serializeArray());



                addRow();


            });

            tabla.columns.adjust().draw(); // Redraw the DataTable


            swal.close();

        }

    });
    var defs_select2 = {
        placeholder: 'Selecciona una opción',
        language: {
            noResults: function (params) {

                return "No se encontraron resultados";
            }
        }
    };

    $('#novedades_tipo').select2(defs_select2);
    $('.timepicker').timepicker({
        twelveHour: false
    });



    //Envio de notificaciones
    $('#send_to').select2(defs_select2);
    $("#check_send").prop("checked", true);
    $('#send_to option').each(function (key, element) {
        if (element.value =="all") {
            $(element).prop("disabled", false);
        } else {
            $(element).prop("disabled", true);
        }
    });
    $('#send_to').val("all");
    $('#send_to').trigger('change.select2');

});


$("#check_send").change((e) => {
    console.log("change");
    if (e.target.checked) {
        $('#send_to option').each(function (key, element) {

            if (element.value != "all") {
                element.selected != true ? element.selected = false : element.selected = false;
                element.disabled != true ? element.disabled = true : element.disabled = false;
            } else {
                element.selected = true;
                element.disabled = false;
                $("#send_to").attr("readonly", "readonly");
            }
        });
        $("#send_to").prop("required", false);
    } else {
        $('#send_to option').each(function (key, element) {
            if (element.value !=  "all") {
                // element.selected != false ? element.selected=false : element.selected=true;
                element.disabled != true ? element.disabled = true : element.disabled = false;
            } else {
                element.disabled = true;
                element.selected = false;
                $("#send_to").attr("readonly", false);
            }
        });
        $("#send_to").prop("required", true);
       
    }

    $('#send_to').trigger('change.select2');
});


$('form').on('submit', function (e) {

    e.preventDefault();
    var tipo = document.getElementById("novedades_tipo");
    var hora_inicio = document.getElementById("dateranage_inicio");
    var hora_final = document.getElementById("dateranage_fin");
    var lugar = document.getElementById("lugar");
    var gasto = document.getElementById("gasto");
    var razon = document.getElementById("razon");
    var reporto = document.getElementById("reporto");
    var centro_informacion = document.getElementById("centro_informacion");
    var ci_hora = document.getElementById("dateranage_ci_hora");
    var san_joaquin = document.getElementById("san_joaquin");
    var sj_hora = document.getElementById("dateranage_sj_hora");
    var valido = false;
    var send_to=[];
    $('#send_to option').filter(function (key, element) {
        if(element.selected)send_to.push(element.value);
     });
     console.log(send_to);

    ////Se validan condiciones para añadir campos a la tabla
    if (tipo.value != null && hora_inicio.value!= null && hora_final.value!= null && lugar.value!= null && gasto.value >= 0 && razon.value!= null && reporto.value!= null && centro_informacion.value!= null && ci_hora.value!= null && san_joaquin.value!= null && sj_hora.value!= null) {
        valido = true;
    }

    if (valido) {
        swal({
            allowOutsideClick: false,
            title: '¿Deseas guardar la novedad?',
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
            formulario.push({
                name: "accion",
                value: 'GUARDAR'

            });
            $.ajax({
                url: serverurl + "ajax/novedadesAjax.php",
                method: "post",
                data: $.param(formulario),

                success: function (res) {
                    if (res == -1) {

                        swal({
                            type: "error",
                            title: "El registro no se ha podido guardar",
                            showConfirmButton: true,
                            allowOutsideClick: false
                        }).then(function () {

                        });

                    } else
                        if (res == 0) {
                           wsocket.sendMessage(`Se ha publicado una novedad de tipo ${tipo.value}`,'notification-yellow');

                            swal({
                                type: "success",
                                title: "El registro se ha guardado con exito",
                                showConfirmButton: true,
                                allowOutsideClick: false
                            }).then(function () {
                                // SI TODO SALE BIEN SE HACE LA REDIRECCIÓN A LA MISMA PAGINA
                                window.location.href = serverurl + "novedades";
                            });

                        }


                }



            });


        }).catch(function () { });

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

function addRow() {


    tabla.row.add([
        "<input type='hidden'  value =" + (tabla.page.info().recordsTotal + 1) + ">" + (tabla.page.info().recordsTotal + 1),
        '<input  type="hidden"  value ="' + tipo + '">' + tipo,
        '<input  type="hidden"  value ="' + hora_afectacion_inicio + '">' + hora_afectacion_inicio,
        '<input  type="hidden"  value ="' + hora_afectacion_final + '">' + hora_afectacion_final,
        '<input  type="hidden"  value ="' + lugar_afectacion + '">' + lugar_afectacion,
        '<input  type="hidden"  value ="' + gasto + '">' + gasto,
        '<input  type="hidden"  value ="' + razon + '">' + razon,
        '<input  type="hidden"  value ="' + reporto + '">' + reporto,
        '<input  type="hidden"  value ="' + centro_informacion + '">' + centro_informacion,
        '<input  type="hidden"  value ="' + hora_ci + '">' + hora_ci,
        '<input  type="hidden"  value ="' + san_joaquin + '">' + san_joaquin,
        '<input  type="hidden"  value ="' + hora_sj + '">' + hora_sj,




    ]).draw();
    $('#submit').prop("disabled", false);
    $('#bomba_id option').each(function (key, element) {

        element.removeAttribute("selected");

    });


}

function withSelectionRange(e) {
    const elem = e;
    // get start position and end position, in case of an selection these values
    // will be different
    console.log(e)
    const startPos = elem.selectionStart;
    const endPos = elem.selectionEnd;
    elem.value = elem.value.toUpperCase();
    elem.setSelectionRange(startPos, endPos);
  }
  
