var checked_permisos = [];

$(document).ready(() => {

    //Inicializa las opciones a las que podra tener acceso el usuario
    $("#crear_editar_rol").addClass("disabled");
    $("#eliminar_rol").addClass("disabled");

    var activa_campos = false;
    $.ajax({
        url: serverurl + "ajax/permisosAjax.php",
        method: "post",
        data: { "accion": "CONSULTAPERMISOS", "permisos": "('LEERROL','CREARROL','EDITARROL','ELIMINARROL')" },
        success: (res) => {
            res = JSON.parse(res);
            //
            $.each(res, (key, value) => {

                if (value.permiso == "CREARROL" && $("#crear_editar_rol").val() == "CREAR") {
                    $("#crear_editar_rol").removeClass("disabled");
                    activa_campos = true;
                } else if (value.permiso == "EDITARROL" && $("#crear_editar_rol").val() == "EDITAR") {
                    $("#crear_editar_rol").removeClass("disabled");
                    activa_campos = true;
                } else if (value.permiso == "ELIMINARROL") {
                    $("#eliminar_rol").removeClass("disabled");
                }
            });
            //Segun los permisos consultados decide si permitira modificar los campos
            $("input").each((key, value) => {
                value.disabled = activa_campos ? false : true;
            });
            $("select").each((key, value) => {
                value.disabled = activa_campos ? false : true;
            });
        }
    });





    //Inicializa los check box y los mete en un arreglo para poder validar que se envia el formulario con por lo menos una opcion
    if ($("#rol_id").val() != null && $("#rol_id").val() != undefined && $("#rol_id").val() != 0) {
        targets = $(".permisos").find(".filled-in");
        $.each(targets, (key, value) => {
            value.checked ? checked_permisos.push(value.id) : null;
        });
    }
});


/*************************************
        Function: $(".permisos").change(e);
        Params: e - objeto que detono el evento
        Action: Inserta en el arreglo checked_permisos los ids que se han seleccionado en caso contrario los remueve del arreglo
        Return: 
  **************************************/


$(".permisos").change((e) => {
    if (e.target.checked) {
        checked_permisos.push(e.target.id);

    } else {
        for (var i = 0; i < checked_permisos.length; i++) { checked_permisos[i] === e.target.id ? checked_permisos.splice(i, 1) : null };
    }
});

/*************************************
        Function: $("form").change(e);
        Params: e - objeto que detono el evento
        Action: Envia los datos al ajax para crear o editar en base a la acción que adjuntamos al formulario
        Return: 
  **************************************/

$('form').submit((e) => {
    e.preventDefault();

    if ($("#rol_id").val() != "" && $("#rol_id").val() != undefined && $("#rol_id").val() != null) {/*Se valida si todavia no existe el
        id del rol, si existe se edita de lo contrario se crea al momento de guardar*/
        swal({
            allowOutsideClick: false,
            title: '¿Deseas editar los datos del rol?',
            text: "El rol se editará con los datos proporcionados",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#03A9F4',
            cancelButtonColor: '#F44336',
            confirmButtonText: '<i class="zmdi zmdi-run"></i>Sí',
            cancelButtonText: '<i class="zmdi zmdi-close-circle"></i>No'
        }).then(() => {
            /*Inicia el swal para la carga*/

            if (checked_permisos.length == 0 || checked_permisos.length == undefined || checked_permisos.length == null) {
                swal({
                    type: "error",
                    title: "Debe seleccionar al menos un campo de los permisos",
                    showConfirmButton: true,
                    allowOutsideClick: false
                });

            } else {
                swal({
                    title: 'Cargando',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onOpen: () => {

                        swal.showLoading();
                        var formulario = $(e.currentTarget).serializeArray();//Convierte a los campos que forman parte del formulario en un arreglo indexado
                        //
                        formulario.push({ name: "accion", value: 'EDITAR' });//Añadimos el parametro para la accion que tomara del modelo
                        console.log($.param(formulario));
                        $.ajax({
                            url: serverurl + "ajax/rolAjax.php",
                            method: "post",
                            data: $.param(formulario),
                            success: (res) => {

                                if (res == 0) {

                                    swal({
                                        type: "success",
                                        title: "El rol se ha editado correctamente",
                                        showConfirmButton: true,
                                        allowOutsideClick: false
                                    }).then(() => {
                                        window.location.href = serverurl + "roles";
                                    });
                                } else {

                                    swal({
                                        type: "error",
                                        title: "El rol no se ha podido editar con los datos proporcionados",
                                        showConfirmButton: true,
                                        allowOutsideClick: false
                                    }).then(() => {

                                    });
                                }
                            }

                        });
                    }
                });
            }

        });
    } else {

        swal({
            allowOutsideClick: false,
            title: '¿Deseas crear al rol?',
            text: "El rol sera creado con los datos proporcionados",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#03A9F4',
            cancelButtonColor: '#F44336',
            confirmButtonText: '<i class="zmdi zmdi-run"></i>Sí',
            cancelButtonText: '<i class="zmdi zmdi-close-circle"></i>No'
        }).then(() => {
            /*Inicia el swal para la carga*/
            if (checked_permisos.length == 0 || checked_permisos.length == undefined || checked_permisos.length == null) {
                swal({
                    type: "error",
                    title: "Debe seleccionar al menos un campo de los permisos",
                    showConfirmButton: true,
                    allowOutsideClick: false
                });

            } else {
                swal({
                    title: 'Cargando',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onOpen: () => {

                        swal.showLoading();
                        var formulario = $(e.currentTarget).serializeArray();//Convierte a los campos que forman parte del formulario en un arreglo indexado
                        //
                        formulario.push({ name: "accion", value: 'CREAR' });//Añadimos el parametro para la accion que tomara del modelo
                        console.log($.param(formulario));
                        $.ajax({
                            url: serverurl + "ajax/rolAjax.php",
                            method: "post",
                            data: $.param(formulario),
                            success: function (res) {

                                if (res == 0) {

                                    swal({
                                        type: "success",
                                        title: "El rol se ha creado correctamente",
                                        showConfirmButton: true,
                                        allowOutsideClick: false
                                    }).then(() => {
                                        window.location.href = serverurl + "roles";
                                    });
                                } else {

                                    swal({
                                        type: "error",
                                        title: "El rol no se ha podido crear con los datos proporcionados",
                                        showConfirmButton: true,
                                        allowOutsideClick: false
                                    }).then(() => {

                                    });
                                }
                            }

                        });
                    }
                });
            }
        });

    }


});

/*************************************
        Function: $(".uppercase").on("input",(e));
        Params: e - objeto que detono el evento
        Action: Envia los datos al ajax para crear o editar en base a la acción que adjuntamos al formulario
        Return: 
  **************************************/

$(".uppercase").on("input", (e) => {
    e.target.value = e.target.value.toUpperCase();
});