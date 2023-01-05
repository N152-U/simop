
$(document).ready(function () {

    $('.timepicker').timepicker({
        twelveHour: false
    });

});
$('form').on('submit', function (e) {

    $("#crear_reporte").addClass("disabled");
    var activa_campos = false;

    $.ajax({
        url: serverurl + "ajax/permisosAjax.php",
        method: "post",
        data: { "accion": "CONSULTAPERMISOS", "permisos": "('CREARREPORTE','EDITARREPORTE','ELIMINARREPORTE')" },
        success: (res) => {
            res = JSON.parse(res);
            console.log(res);
            $.each(res, (key, value) => {

                if (value.permiso == "CREARREPORTE") {
                    $("#crear_reporte").removeClass("disabled");
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


    e.preventDefault();
    var fecha = document.getElementById("fecha");

    console.log($(e.currentTarget).serializeArray());
    
    var valido = false;


    ////Se validan condiciones para añadir campos a la tabla
    if (fecha.value != null) {
        valido = true;
    }

    if (valido) {
        swal({
            allowOutsideClick: false,
            title: '¿Deseas guardar el reporte?',
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
                url: serverurl + "ajax/reporteAjax.php",
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

                    }
                    else if (res == 1) {

                        swal({
                            type: "error",
                            title: "Error a la hora de crear el reporte, no se ha podido guardar",
                            showConfirmButton: true,
                            allowOutsideClick: false
                        }).then(function () {

                        });

                    }
                    else if (res == 2) {

                        swal({
                            type: "error",
                            title: "Error al unir el reporte con las notas, no se ha podido guardar",
                            showConfirmButton: true,
                            allowOutsideClick: false
                        }).then(function () {

                        });

                    }
                    else if (res == 3) {

                        swal({
                            type: "error",
                            title: "Error al unir el reporte con las novedades, no se ha podido guardar",
                            showConfirmButton: true,
                            allowOutsideClick: false
                        }).then(function () {

                        });

                    }
                    else if (res == 4) {

                        swal({
                            type: "error",
                            title: "Ya se encuentra generado el reporte",
                            showConfirmButton: true,
                            allowOutsideClick: false
                        }).then(function () {
                            //window.location.href = serverurl + "reportes";
                        });

                    }

                    else if (res == 0) {
                        swal({
                            type: "success",
                            title: "El registro se ha guardado con exito",
                            showConfirmButton: true,
                            allowOutsideClick: false
                        }).then(function () {
                            // SI TODO SALE BIEN SE HACE LA REDIRECCIÓN A LA MISMA PAGINA
                            window.location.href = serverurl + "reportes";
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

$(".checkboxes_lluvia_almoloya").change(function (e) {
    var id = e.target.id;
    var idnuevo = id.replace("check_", "");
    if ($("#" + id).prop("checked") == true) {

        $("#" + idnuevo).val("SIN LLUVIA");
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

$(".checkboxes_lluvia_villa_carmela").change(function (e) {
    var id = e.target.id;
    var idnuevo = id.replace("check_", "");
    if ($("#" + id).prop("checked") == true) {

        $("#" + idnuevo).val("SIN LLUVIA");
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

$(".checkboxes_lluvia_alzate").change(function (e) {
    var id = e.target.id;
    var idnuevo = id.replace("check_", "");
    if ($("#" + id).prop("checked") == true) {

        $("#" + idnuevo).val("SIN LLUVIA");
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

$(".checkboxes_lluvia_ixtlahuaca").change(function (e) {
    var id = e.target.id;
    var idnuevo = id.replace("check_", "");
    if ($("#" + id).prop("checked") == true) {

        $("#" + idnuevo).val("SIN LLUVIA");
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