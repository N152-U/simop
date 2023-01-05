	
$(document).ready(() => {
    defs_select2 = {
        placeholder: 'Selecciona una opción',
        language: {
            noResults: (params) => {

                return "No se encontraron resultados";
            }
        }
    };
    $('#rol_id').select2(defs_select2);


    //Inicializa las opciones a las que podra tener acceso el usuario
    $("#crear_editar_usuario").addClass("disabled");
    $("#eliminar_usuario").addClass("disabled");
    var activa_campos = false;
    $.ajax({
        url: serverurl + "ajax/permisosAjax.php",
        method: "post",
        data: { "accion": "CONSULTAPERMISOS", "permisos": "('LEERUSUARIO','CREARUSUARIO','EDITARUSUARIO','ELIMINARUSUARIO')" },
        success: (res) => {
            res = JSON.parse(res);
            //
            console.log($("#crear_editar_usuario").val());
            $.each(res, (key, value) => {


                if (value.permiso == "CREARUSUARIO" && $("#crear_editar_usuario").val() == "CREAR") {
                    $("#crear_editar_usuario").removeClass("disabled");
                    activa_campos = true;
                } else if (value.permiso == "EDITARUSUARIO" && $("#crear_editar_usuario").val() == "EDITAR") {
                    $("#crear_editar_usuario").removeClass("disabled");
                    activa_campos = true;
                } else if (value.permiso == "ELIMINARUSUARIO") {
                    $("#eliminar_usuario").removeClass("disabled");

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


});

/*************************************
        Function: $("form").change(e);
        Params: e - objeto que detono el evento
        Action: Envia los datos al ajax para crear o editar en base a la acción que adjuntamos al formulario
        Return: 
  **************************************/

$('form').submit((e) => {
    e.preventDefault();

    if ($("#usuario_id").val() != "" && $("#usuario_id").val() != undefined && $("#usuario_id").val() != null) {/*Se valida si todavia no existe el
        id del usuario, si existe se edita de lo contrario se crea al momento de guardar*/
        swal({
            allowOutsideClick: false,
            title: '¿Deseas editar los datos del usuario?',
            text: "El usuario se editará con los datos proporcionados",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#03A9F4',
            cancelButtonColor: '#F44336',
            confirmButtonText: '<i class="zmdi zmdi-run"></i>Sí',
            cancelButtonText: '<i class="zmdi zmdi-close-circle"></i>No'
        }).then((res) => {
            /*Inicia el swal para la carga*/
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
                        url: serverurl + "ajax/usuarioAjax.php",
                        method: "post",
                        data: $.param(formulario),
                        success: (res) => {

                            if (res == 0) {

                                swal({
                                    type: "success",
                                    title: "El usuario se ha editado correctamente",
                                    showConfirmButton: true,
                                    allowOutsideClick: false
                                }).then(() => {
                                    window.location.href = serverurl + "usuarios";
                                });
                            } else {

                                swal({
                                    type: "error",
                                    title: "El usuario no se ha podido editar con los datos proporcionados",
                                    showConfirmButton: true,
                                    allowOutsideClick: false
                                }).then(() => {

                                });
                            }
                        }

                    });
                }
            });
        });
    } else {

        swal({
            allowOutsideClick: false,
            title: '¿Deseas crear al usuario?',
            text: "El usuario sera creado con los datos proporcionados",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#03A9F4',
            cancelButtonColor: '#F44336',
            confirmButtonText: '<i class="zmdi zmdi-run"></i>Sí',
            cancelButtonText: '<i class="zmdi zmdi-close-circle"></i>No'
        }).then((res) => {
            /*Inicia el swal para la carga*/
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
                        url: serverurl + "ajax/usuarioAjax.php",
                        method: "post",
                        data: $.param(formulario),
                        success: (res) => {

                            if (res == 0) {

                                swal({
                                    type: "success",
                                    title: "El usuario se ha creado correctamente",
                                    showConfirmButton: true,
                                    allowOutsideClick: false
                                }).then(() => {
                                    window.location.href = serverurl + "usuarios";
                                });
                            } else {

                                swal({
                                    type: "error",
                                    title: "El usuario no se ha podido crear con los datos proporcionados",
                                    showConfirmButton: true,
                                    allowOutsideClick: false
                                }).then(() => {

                                });
                            }
                        }

                    });
                }
            });
        });

    }


});

/*************************************
        Function: $("#confirmacion_pwd").on("input", (e));
        Params: e - objeto que detono el evento
        Action: Comprueba que la contraseña introducida sea la correcta
        Return: 
  **************************************/

$("#confirmacion_pwd").on("input", (e) => {
    console.log(e.target.value)
    if (e.target.value === $("#pwd").val()) {

     
        $("#pwd").removeClass("invalid");
        $("#pwd").addClass("valid");
        $(e.target).removeClass("invalid");
        $(e.target).addClass("valid");
    } else {
        $(e.target).addClass("invalid");

    }
});

$("#pwd").on("input", (e) => {
    $("#confirmacion_pwd").val("");
    if(e.target.value!=""&&e.target.value!=undefined&&e.target.value!=null)
    {
        $("#confirmacion_pwd").prop("required",true);
        $("#confirmacion_pwd").prop("pattern",e.target.value);
        $("#confirmacion_pwd").addClass("invalid");
    }else
    {
        $("#confirmacion_pwd").prop("required",false);
        $("#confirmacion_pwd").prop("pattern","");
        $("#confirmacion_pwd").removeClass("invalid");
    }
   
});

/*************************************
        Function: $(".uppercase").on("input", (e));
        Params: e - objeto que detono el evento
        Action: Transforma el valor a mayusculas del objeto que detono el evento 
        Return: 
  **************************************/

$(".uppercase").on("input", (e) => {
    e.target.value = e.target.value.toUpperCase();
});

/*************************************
        Function: togglePassword(e)
        Params: e - objeto que detono el evento
        Action: Cambia el tipo de campo a la contraseña para poder alternar entre carácteres visibles y ocultos
        Return: 
  **************************************/

function togglePassword(e) {

    var icon_target = $(e).find("i")[0];
    var input_target = icon_target.closest("div").children[0];
    // var inputField = document.querySelector(input_target);
    if (input_target.getAttribute('type') == "password") {
        input_target.setAttribute('type', 'text');
        icon_target.innerHTML = "visibility_off";
    } else if (input_target.getAttribute('type') == "text") {
        input_target.setAttribute('type', 'password');
        icon_target.innerHTML = "visibility";
    }
}