
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
                    "permisos": "('CAPTURAPUNTOVENTURYII'," +
                        "'CAPTURAPUNTOVENTURYIII'," +
                        "'CAPTURAPUNTOALZATE'," +
                        "'CAPTURAPUNTOATARASQUILLO'," +
                        "'CAPTURAPUNTOVENADO'," +
                        "'CAPTURAPUNTODOLORES'," +
                        "'CAPTURAPUNTOCAIDADELBORRACHO'," +
                        "'EDITARREGISTROVENTURYII'," +
                        "'EDITARREGISTROVENTURYIII'," +
                        "'EDITARREGISTROALZATE'," +
                        "'EDITARREGISTROATARASQUILLO'," +
                        "'EDITARREGISTROVENADO'," +
                        "'EDITARREGISTRODOLORES'," +
                        "'EDITARREGISTROCAIDADELBORRACHO')"
                },
                success: (res) => {

                    res = JSON.parse(res);
                    $.each(res, (key, value) => {

                        if (value.permiso == "CAPTURAPUNTOVENTURYII") {
                            $("#punto_id [value='1']").attr("disabled", false);
                        } else if (value.permiso == "CAPTURAPUNTOVENTURYIII") {
                            $("#punto_id [value='2']").attr("disabled", false);
                        } else if (value.permiso == "CAPTURAPUNTOALZATE") {
                            $("#punto_id [value='3']").attr("disabled", false);
                        } else if (value.permiso == "CAPTURAPUNTOATARASQUILLO") {
                            $("#punto_id [value='4']").attr("disabled", false);
                        } else if (value.permiso == "CAPTURAPUNTOVENADO") {
                            $("#punto_id [value='5']").attr("disabled", false);
                        } else if (value.permiso == "CAPTURAPUNTODOLORES") {
                            $("#punto_id [value='6']").attr("disabled", false);
                        } else if (value.permiso == "CAPTURAPUNTOCAIDADELBORRACHO") {
                            $("#punto_id [value='7']").attr("disabled", false);
                        } else if (Array("EDITARREGISTROVENTURYII",
                            "EDITARREGISTROVENTURYIII",
                            "EDITARREGISTROALZATE",
                            "EDITARREGISTROATARASQUILLO",
                            "EDITARREGISTROVENADO",
                            "EDITARREGISTRODOLORES",
                            "EDITARREGISTROCAIDADELBORRACHO").includes(value.permiso, 0)) {
                           $("#editar_riego").show();
                        }

                    });
                    $("#punto_id > option").each(function () {
                        console.log(this.value);
                        if ($("#punto_id [value='" + this.value + "']").attr("disabled") == 'disabled') {
                            $("#punto_id [value='" + this.value + "']").remove();
                            $('#punto_id').trigger('change.select2');

                        }
                    });
                    swal.close();
                }
            });
        }
    });



    $('#punto_id').select2(defs_select2);
    $('#hora_programada').select2(defs_select2);
    $('#bomba_id').select2(defs_select2);
    $('#transmitio').select2(defs_select2);



    if ($("#punto_id option:selected").val() != "ALZATE") {

        $("#bombas_contenedor").hide();
        $("#presion_contenedor").hide();
    } else {
        $("#bombas_contenedor").show();
        $("#presion_contenedor").show();
    }


    $('textarea').characterCounter();
    $('#transmitio').characterCounter();
    $("#punto_id").trigger('change');

    $('.dataTables_wrapper').find("select").formSelect();

});


$("#ayuda").click(function () {
    introJs().start();
});



$("#punto_id").change(function (e) {

    console.log(e.target.value);
    var pozo_text = $('#punto_id option:selected').text();
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
    if (pozo_text == "ALZATE") {

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


    } else if (pozo_text == "CAIDA DEL BORRACHO") {
        //$('#gasto').prop("readonly",false);
        $('#bomba_id option').each(function (key, element) {
            if (element.value == 1) {
                $(element).prop("disabled", false);
            } else {
                $(element).prop("disabled", true);
            }


        });
        $('#bomba_id').val("1");
        $('#bomba_id').trigger('change.select2');
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
        $('#bomba_id').val("1");
        $('#bomba_id').trigger('change.select2');
        $("#gasto").val("0");
        $("#bombas_contenedor").hide();
        $("#presion_contenedor").hide();
    }

    //Inicia peticion para traer datos del punto seleccionado e irlos desplegando en la tabla
    if (pozo_text != "") {
        swal({
            title: 'CARGANDO',
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
                $.ajax({
                    url: serverurl + "ajax/controlRiegoAjax.php",
                    method: "post",
                    data: {
                        "punto_id": e.target.value,
                        "accion": "CONSULTA"
                    },
                    success: function (res) {
                        res = JSON.parse(res);

                        console.log(res);
                        var $el = $("#hora_programada");
                        //console.log($el);
                        tabla.clear().draw();
                        $.each(res.fechas_registradas, function (key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos

                            addRow(value.punto, value.bomba_id, value.presion, value.tirante, value.gasto, value.hora_programada, value.transmitio, value.novedades)


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
