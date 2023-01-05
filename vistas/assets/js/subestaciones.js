
defs_datatable.order = [[2, "desc"]];

var tabla = $('#tabla_subestaciones').DataTable(defs_datatable);

var gasto = "0";
var defs_select2 = {
    placeholder: 'Seleccione una opción',
    language: {
        noResults: function (params) {

            return "No se encontraron resultados";
        }
    }
};
//console.log(usuario_id);
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
                    "permisos": "('CREARSUBESTACIONIXTLAHUACA')"
                },
                success: (res) => {

                    res = JSON.parse(res);
                    $.each(res, (key, value) => {

                        if (value.permiso == "CREARSUBESTACIONIXTLAHUACA") {
                            $("#subestacion_id [value='1']").attr("disabled", false);
                        }

                    });
                    $("#subestacion_id > option").each(function () {
                        if ($("#subestacion_id [value='" + this.value + "']").attr("disabled") == 'disabled')
                            $("#subestacion_id [value='" + this.value + "']").remove();
                        $('#subestacion_id').trigger('change.select2');
                    });
                    swal.close();
                }
            });
        }
    });

    $('#subestacion_id').select2(defs_select2);
    $('#fecha_hora_programada').select2(defs_select2);
    $('#transmite').select2(defs_select2);

    $("#subestacion_id").trigger('change');
    $('input#transmite, input#sub_novedades').characterCounter();

    $('.dataTables_wrapper').find("select").formSelect();

});

$("#ayuda").click(function () {
    introJs().start();
});

$('#form-captura-subestacion').submit((e) => {

    e.preventDefault();
    e.stopPropagation();

    swal({
        allowOutsideClick: false,
        title: '¿Deseas guardar el registro de la subestacion?',
        text: "El registro será guardado con la información proporcionada",
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#03A9F4',
        cancelButtonColor: '#F44336',
        confirmButtonText: '<i class="zmdi zmdi-run"></i> Si',
        cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> No'
    }).then(() => {
        //document.getElementById('fecha_hora_programada').disabled = false;
        var formulario = $(e.currentTarget).serializeArray();
        var transmite = document.getElementById("transmite");
        transmite = transmite.options[transmite.selectedIndex].text;


        formulario.push({
            name: "transmite",
            value: transmite
        });
        formulario.push({
            name: "accion",
            value: "GUARDAR",
        });
      
        $.ajax({
            url: serverurl + "ajax/subestacionesAjax.php",
            method: "post",
            data: $.param(formulario),
            success: (res) => {

                if (res == -1) {

                    swal({
                        type: "error",
                        title: "El registro no se ha podido guardar",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(() => { });

                } else if (res == 0) {

                    swal({
                        type: "success",
                        title: "El registro se ha guardado correctamente",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(() => {
                        //document.getElementById('fecha_hora_programada').disabled = true;
                        var experimento = document.getElementById('subestacion_id');
                        //console.log(experimento);
                        lasHoras(experimento);

                        //addRow();


                    });

                }

            }

        });

    }).catch(function () { });

});

function lasHoras(e) {

    //console.log(e.value);
    if (e.value != "") {
        swal({
            title: 'CARGANDO',
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
                $.ajax({
                    url: serverurl + "ajax/subestacionesAjax.php",
                    method: "post",
                    data: {
                        "subestacion_id": e.value,
                        "accion": "CONSULTA"
                    },
                    success: (res) => {
                        res = JSON.parse(res);
                        //console.log(res);
                        $("#fecha_hora_programada").empty();
                        $.each(res.fechas_restantes, (key, value) => {

                            $("#fecha_hora_programada").append('<option value="' + value + '">' + value + '</option>');

                        });

                        tabla.clear().draw();
                        $.each(res.fechas_registradas, (key, value) => {

                            addRow(value);

                        });

                        swal.close();

                    },
                });
            }
        });
    }

}

let timeout = null;
function revisarAmperaje(e) {
    var amperaje = document.getElementById('amperaje').value;

    //console.log(amperaje);

    clearTimeout(timeout);
    timeout = setTimeout(() => {

        if (amperaje < 0 || amperaje >= 90) {
            swal({
                type: "warning",
                title: "El amperaje ingresado no cuenta con el formato permitido (0 a 90 amp)",
                showConfirmButton: true,
                allowOutsideClick: false
            }).then(() => {
                e.value = '';
            });
        }

    }, 1000);
}

function sinNovedad(e) {

    var x = document.getElementById('sub_novedades');

    if (e.checked == true) {

        x.classList.add("disabled");
        x.value = "SIN NOVEDAD";

    } else {

        x.classList.remove("disabled");
        x.value = "";

    }

}

function addRow(e) {

    //console.log(e);

    tabla.row.add([
        "<input type='hidden'  value =" + (tabla.page.info().recordsTotal + 1) + ">" + (tabla.page.info().recordsTotal + 1),
        '<input type="hidden"  value ="' + e.subestacion + '">' + e.subestacion,
        '<input type="hidden"  value ="' + e.fecha_hora_programada + '">' + e.fecha_hora_programada,
        '<input type="hidden"  value ="' + e.amperaje + '">' + e.amperaje,
        '<input type="hidden"  value ="' + e.transmite + '">' + e.transmite,
        '<input type="hidden"  value ="' + e.sub_novedades + '">' + e.sub_novedades
    ]).draw();

    $("#amperaje").val("");
    //$("#transmite").val("");
    //$("#transmite").select2(defs_select2);
    
    $("#subnovedades").val("");
    $('#sin_novedad').prop("checked", false);
    sinNovedad(document.getElementById('sub_novedades'));



}
