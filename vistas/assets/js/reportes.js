

 $('#tabla_reportes').DataTable(defs_datatable);


 $(document).ready(()=>{

    $(".crear-reporte").addClass("disabled");
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
                    $(".crear-reporte").removeClass("disabled");
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
 })