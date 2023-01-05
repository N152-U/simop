defs_datatable.columnDefs=[  {
    className: "center-align",
    "targets": "_all",
},
{
    searchable: false, 
    orderable: false,
    targets: [4],
}];



var tabla_usuarios_activos=$("#tabla_usuarios_activos").DataTable(defs_datatable);
var tabla_usuarios_inactivos=$("#tabla_usuarios_inactivos").DataTable(defs_datatable);


$(document).ready(() => {
    // <?php echo ($usuariosInstancia::consulta_permisos_rol("CREARUSUARIO",$usuariosInstancia::decryption($_SESSION[GUID]["rol_id"]))->rowCount()==1)?"":"disabled"?>
    $(".leer-usuario").addClass("disabled");
    $(".crear-usuario").addClass("disabled");
    $(".editar-usuario").addClass("disabled");
    $(".eliminar-usuario").addClass("disabled");
    $(".restablecer-usuario").addClass("disabled");

    $.ajax({
        url: serverurl + "ajax/permisosAjax.php",
        method: "post",
        data: { "accion": "CONSULTAPERMISOS", "permisos": "('LEERUSUARIO','CREARUSUARIO','EDITARUSUARIO','RESTABLECERUSUARIO','ELIMINARUSUARIO')" },
        success: (res) => {
            res = JSON.parse(res);
            $.each(res, (key, value) => {
                if (value.permiso == "LEERUSUARIO") {
                    $(".leer-usuario").removeClass("disabled");
                } else if (value.permiso == "CREARUSUARIO") {
                    $(".crear-usuario").removeClass("disabled");
                } else if (value.permiso == "EDITARUSUARIO") {
                    $(".editar-usuario").removeClass("disabled");
                }else if (value.permiso == "RESTABLECERUSUARIO") {
                    $(".restablecer-usuario").removeClass("disabled");
                } else if (value.permiso == "ELIMINARUSUARIO") {
                    $(".eliminar-usuario").removeClass("disabled");
                }
            });

        }
    });

    $('#tabs_usuarios').tabs({
        onShow() {
            // //
            tabla_usuarios_activos.columns.adjust().draw();
            tabla_usuarios_inactivos.columns.adjust().draw();
        }
    });


});

function eliminar_usuario(usuario_id)
{
    swal({
        allowOutsideClick: false,
        title: '¿Deseas desactivar al usuario?',
        text: "El usuario podrá ser restablecido despúes",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#03A9F4',
        cancelButtonColor: '#F44336',
        confirmButtonText: '<i class="zmdi zmdi-run"></i>Sí',
        cancelButtonText: '<i class="zmdi zmdi-close-circle"></i>No'
    }).then((res) => {
        $.ajax({
            url: serverurl + "ajax/usuarioAjax.php",
            method: "post",
            data: { "accion": "ELIMINAR", "usuario_id": usuario_id },
            success: function (res) {
                if(res==0)
                {
                    swal({
                        type: "success",
                        title: "El usuario se ha desactivado",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(() => {
                        window.location=serverurl+"usuarios";

                    });
                }
    
            }
    
        });
    });
}

function restablecer_usuario(usuario_id)
{
    swal({
        allowOutsideClick: false,
        title: '¿Deseas restablecer al usuario?',
        text: "El usuario podra volver a realizar acciones en el sistema",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#03A9F4',
        cancelButtonColor: '#F44336',
        confirmButtonText: '<i class="zmdi zmdi-run"></i>Sí',
        cancelButtonText: '<i class="zmdi zmdi-close-circle"></i>No'
    }).then((res) => {
        $.ajax({
            url: serverurl + "ajax/usuarioAjax.php",
            method: "post",
            data: { "accion": "RESTABLECER", "usuario_id": usuario_id },
            success: function (res) {
                if(res==0)
                {
                    swal({
                        type: "success",
                        title: "El usuario se ha restablecido",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(() => {
                        window.location=serverurl+"usuarios";

                    });
                }
    
            }
    
        });
    });
}