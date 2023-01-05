const decimalsPlaces = 2;
defs_datatable.order = [
    [2, "desc"]
];

//var tabla = $('#tabla_captura').DataTable(defs_datatable);
var defs_select2 = {
    placeholder: 'Selecciona una opción',
    language: {
        noResults: function(params) {

            return "No se encontraron resultados";
        }
    }
};


$(document).ready(function() {

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
                    "permisos": "('')"
                },
                success: (res) => {
                    res = JSON.parse(res);
                    $.each(res, (key, value) => {});
                    swal.close();
                }
            });
        }
    });
});

//$('#anio').select2(defs_select2);
/* console.log("first",$("#anio option:selected").val());

if ($("#anio option:selected").val() == '') {

    $("#tabla_captura").hide();
} else {
    $("#tabla_captura").show();
} */
/*************************************
        Function: $('form').on('submit', function (e))
    Params:
    Action: Manda el formulario a traves de POST con valores parametrizados 
        Return:
  **************************************/
/* let anio = moment().year();
$("#anio").val(anio); */

$('#formularioCaptura').on('submit', function(e) {
    console.log("Entra formulario", e);
    e.preventDefault();


    var anio = document.getElementById("anio");
    var meta_volumen_acueducto = document.getElementById("meta_volumen_acueducto");
    var meta_superficie_acueducto = document.getElementById("meta_superficie_acueducto");
    var meta_volumen_otras_fuentes = document.getElementById("meta_volumen_otras_fuentes");
    var meta_superficie_otras_fuentes = document.getElementById("meta_superficie_otras_fuentes");

    /*     for (var i in fecha){
            console.log("first",i);
            var id = fecha[i].value;
     
    	   document.getElementById(id);
    	} */

    var valido = false;

    ////Se validan condiciones para añadir campos a la tabla
    if (anio.value != null && meta_volumen_acueducto.value != null && meta_superficie_acueducto.value != null && meta_volumen_otras_fuentes.value != null && meta_superficie_otras_fuentes.value != null) {
        valido = true;
    }

    if (valido) {

        swal({
            allowOutsideClick: false,
            title: '¿Deseas guardar los valores del año?',
            text: "El registro será guardado con la información proporcionada",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#03A9F4',
            cancelButtonColor: '#F44336',
            confirmButtonText: '<i class="zmdi zmdi-run"></i> Sí!',
            cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> No, Cancelar!'
        }).then(function(res) {
            console.log("datos del formulario", res);

            console.log("Datos", $(e.currentTarget).serializeArray());
            var formulario = $(e.currentTarget).serializeArray();

            formulario.push({
                name: "accion",
                value: 'GUARDAR',
            });
            $.ajax({
                url: serverurl + "ajax/registroAnioRiegoAjax.php",
                method: "post",
                data: $.param(formulario),

                success: function(res) {
                    if (res == 0) {
                        swal({
                                type: "success",
                                title: "El registro se ha guardado con éxito",
                                showConfirmButton: true,
                                allowOutsideClick: false
                            })
                            .then(function() {
                                window.location.href = serverurl + "controlRiego";
                            });
                    } else {
                        swal({
                            type: "error",
                            title: "El registro no se ha podido guardar",
                            showConfirmButton: true,
                            allowOutsideClick: false
                        }).then(function() {});
                        console.log(res);
                    }
                }
            });
        }).catch(function(e) {
            console.log(e);
        });
    } else {

        swal({
            title: 'Advertencia',
            text: 'Complete todos los campos para poder agregar el registro',
            type: 'warning',
            showConfirmButton: true
        }).then(function() {

        }).catch(function() {

        });
    }
    valido = false;
});


/*************************************
        Function: $("input[type=number]").on("focus", function () )
        Params:
        Action: Deniega la accion de aumento y decremento lanzada por las flechas del teclado (arriba/abajo) para los campos de tipo number
        Return:
  **************************************/

$("input[type=number]").on("focus", function() {
    $(this).on("keydown", function(event) {
        if (event.keyCode === 38 || event.keyCode === 40) {
            event.preventDefault();
        }
    });
});

function onChangeTest(data) {

    alert("Value is " + data.value + "\n" + "Old Value is " + data.oldvalue);
}

$("#anio").change(function(e) {

    console.log("narita", e.target.value);
    const valueanio = e.target.value
    if (e.target.value != '') {
        $("#tabla_captura").show();
    } else {

        $("#tabla_captura").hide();
    }
});

function anios() {
    var diasEntreFechas = function(desde, hasta) {
        var dia_actual = desde;
        var fechas = [];
        while (dia_actual.isSameOrBefore(hasta)) {
            fechas.push(dia_actual.format('DD-MM-YYYY'));
            dia_actual.add(1, 'days');
        }
        return fechas;
    };

    let desde = moment("2021-02-29");
    let hasta = moment("2021-12-05");
    let results = diasEntreFechas(desde, hasta);
    console.log(results);
}