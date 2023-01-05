defs_datatable.columnDefs=[  {
    className: "center-align",
    "targets": "_all",
},
{
    searchable: false, 
    orderable: false,
    targets: [2],
}];

var tabla_roles_activos=$("#tabla_roles_activos").DataTable(defs_datatable);
var tabla_roles_inactivos=$("#tabla_roles_inactivos").DataTable(defs_datatable);


$(document).ready(()=>{
    // <?php echo ($usuariosInstancia::consulta_permisos_rol("CREARUSUARIO",$usuariosInstancia::decryption($_SESSION[GUID]["rol_id"]))->rowCount()==1)?"":"disabled"?>
    $(".leer-rol").addClass("disabled");
    $(".crear-rol").addClass("disabled");
    $(".editar-rol").addClass("disabled");
    $(".eliminar-rol").addClass("disabled");
    $(".restablecer-rol").addClass("disabled");

    $.ajax({
        url: serverurl + "ajax/permisosAjax.php",
        method: "post",
        data: { "accion": "CONSULTAPERMISOS", "permisos": "('LEERROL','CREARROL','EDITARROL','RESTABLECERROL','ELIMINARROL')" },
        success: function (res) {
            res = JSON.parse(res);
            $.each(res, (key, value)=>{

                if (value.permiso == "LEERROL") {
                    $(".leer-rol").removeClass("disabled");
                } else if (value.permiso == "CREARROL") {
                    $(".crear-rol").removeClass("disabled");
                } else if (value.permiso == "EDITARROL") {
                    $(".editar-rol").removeClass("disabled");
                } else if (value.permiso == "RESTABLECERROL") {
                    $(".restablecer-rol").removeClass("disabled");
                }else if (value.permiso == "ELIMINARROL") {
                    $(".eliminar-rol").removeClass("disabled");
                }
            });

        }
    });
    $('#tabs_roles').tabs({
        onShow() {
            // //
            tabla_roles_activos.columns.adjust().draw();
            tabla_roles_inactivos.columns.adjust().draw();
        }
    });

});

function eliminar_rol(rol_id)
{

    swal({
        allowOutsideClick: false,
        title: '¿Deseas desactivar el rol?',
        text: "El rol podrá ser restablecido despúes",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#03A9F4',
        cancelButtonColor: '#F44336',
        confirmButtonText: '<i class="zmdi zmdi-run"></i>Sí',
        cancelButtonText: '<i class="zmdi zmdi-close-circle"></i>No'
    }).then((res) => {
        $.ajax({
            url: serverurl + "ajax/rolAjax.php",
            method: "post",
            data: { "accion": "ELIMINAR", "rol_id": rol_id },
            success: function (res) {
                if(res==0)
                {
                    swal({
                        type: "success",
                        title: "El rol se ha desactivado",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(() => {
                        window.location=serverurl+"roles";

                    });
                }
    
            }
    
        });
    });
    
}

function restablecer_rol(rol_id)
{
    swal({
        allowOutsideClick: false,
        title: '¿Deseas restablecer el rol?',
        text: "El rol volvera a estar disponible despúes de esta acción",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#03A9F4',
        cancelButtonColor: '#F44336',
        confirmButtonText: '<i class="zmdi zmdi-run"></i>Sí',
        cancelButtonText: '<i class="zmdi zmdi-close-circle"></i>No'
    }).then((res) => {
        $.ajax({
            url: serverurl + "ajax/rolAjax.php",
            method: "post",
            data: { "accion": "RESTABLECER", "rol_id": rol_id },
            success: function (res) {
                if(res==0)
                {
                    swal({
                        type: "success",
                        title: "El rol se ha restablecido",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(() => {
                        window.location=serverurl+"roles";

                    });
                }
    
            }
    
        });
    });
}