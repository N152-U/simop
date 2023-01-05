var tabla = $('#tabla_notas').DataTable(defs_datatable);


$(document).ready(function () {
    $('textarea').characterCounter();
    $("#crear_nota").addClass("disabled");
    var activa_campos = false;
    $.ajax({
        url: serverurl + "ajax/permisosAjax.php",
        method: "post",
        data: { "accion": "CONSULTAPERMISOS", "permisos": "('LEERNOTA','CREARNOTA','EDITARNOTA','ELIMINARNOTA')" },
        success: (res) => {
            console.log(res);
            res = JSON.parse(res);
            console.log(res);
            $.each(res, (key, value) => {

                if (value.permiso == "CREARNOTA") {
                    $("#crear_nota").removeClass("disabled");
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
        url: serverurl + "ajax/notasAjax.php",
        method: "post",
        data: {
            "accion": "CONSULTA"
        },
        success: function (res) {
            console.log(res);
            res = JSON.parse(res);
            
            tabla.clear().draw();
            $.each(res, function (key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos


                descripcion = value.descripcion;



                addRow();


            });
            tabla.columns.adjust().draw(); // Redraw the DataTable


            swal.close();

        }

    });
});


$('form').on('submit', function (e) {
    console.log("Entra formulario");
    e.preventDefault();
    const descripcion=document.getElementById("descripcion");
    var send_to=[];
    $('#send_to option').filter(function (key, element) {
        if(element.selected)send_to.push(element.value);
     });
     console.log(send_to);
    swal({
        allowOutsideClick: false,
        title: '¿Deseas guardar la nota?',
        text: "Los registros serán guardados con la información de la tabla",
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#03A9F4',
        cancelButtonColor: '#F44336',
        confirmButtonText: '<i class="zmdi zmdi-run"></i> Sí!',
        cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> No, Cancelar!'
    }).then(function (res) {

        console.log($(e.currentTarget).serializeArray());
        var formulario = $(e.currentTarget).serializeArray();
        formulario.push({ name: "accion", value: 'GUARDAR' });
        $.ajax({
            url: serverurl + "ajax/notasAjax.php",
            method: "post",
            data: $.param(formulario),

            success: function (res) {
                if (res == -1) {
                    swal({
                        type: "error",
                        title: "El registro no se ha podido guardar",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }
                    ).then(function () {

                    });
                    console.log(data);
                } else
                    if (res == 0) {
                        wsocket.sendMessage(`Se ha publicado una nota ${descripcion.value}`, "notification-blue");
                        swal({
                            type: "success",
                            title: "El registro se ha guardado con exito",
                            showConfirmButton: true,
                            allowOutsideClick: false
                        }
                        ).then(function () {
                            // SI TODO SALE BIEN SE HACE LA REDIRECCIÓN A LA MISMA PAGINA
                            window.location.href = serverurl + "notas";
                        });

                    }


            }


        });


    }).catch(function () {
    });





});

function addRow() {


    tabla.row.add([
        "<input type='hidden'  value =" + (tabla.page.info().recordsTotal + 1) + ">" + (tabla.page.info().recordsTotal + 1),
        '<input  type="hidden"  value ="' + descripcion + '">' + descripcion,


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

