const decimalsPlaces = 2;
defs_datatable.order = [
    [1, "asc"]
];

var tabla = $('#tabla_captura').DataTable(defs_datatable);

var defs_select2 = {
    placeholder: 'Selecciona una opción',
    language: {
        noResults: function(params) {

            return "No se encontraron resultados";
        }
    }
};

var tabla_edicion = $('#tabla_captura_edicion').DataTable(defs_datatable);
var current_location_id = 0;


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
                    "permisos": "('CREARANIORIEGO', 'EDITARREGISTROANIO')"
                },
                success: (res) => {
                    res = JSON.parse(res);
                    $.each(res, (key, value) => {

                      /*   if (value.permiso == "EDITARREGISTROANIO") { */
                            $("#editar_anio").show();
                        /* }  */
                    });
                    swal.close();
                }
            });
        }
    });
});

$('#fecha').select2(defs_select2);


$('#transmitio').select2(defs_select2);

$('#transmitio').characterCounter();

/* let anio = moment().format('MM-DD');
const valores = window.location.search;
//Creamos la instancia
const urlParams = new URLSearchParams(valores);

//Accedemos a los valores
var aniourl = urlParams.get('anio');
anio = aniourl+"-"+anio;
console.log("first",anio);  */


/*************************************
        Function: $('form').on('submit', function (e))
    Params:
    Action: Manda el formulario a traves de POST con valores parametrizados 
        Return:
  **************************************/

$('#formularioCaptura').on('submit', function (e) {
    console.log("Entra formulario",e);
    e.preventDefault();

    var fecha = document.getElementById("fecha");
    var transmitio = document.getElementById("transmitio");
    
    var gasto_acueducto_real = document.getElementById("gasto_acueducto_real");
    var gasto_otras_fuentes_real = document.getElementById("gasto_otras_fuentes_real");

    var valido = false;
   

    ////Se validan condiciones para añadir campos a la tabla
    if (fecha.value,transmitio.value != null && gasto_acueducto_real.value != null && gasto_otras_fuentes_real.value != null) {
        console.log("datos del formulario",fecha.value,transmitio.value,gasto_acueducto_real.value,gasto_otras_fuentes_real.value);
        valido = true;
    }

    if (valido) {

        swal({
            allowOutsideClick: false,
            title: '¿Deseas guardar los gastos?',
            text: "El registro será guardado con la información proporcionada",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#03A9F4',
            cancelButtonColor: '#F44336',
            confirmButtonText: '<i class="zmdi zmdi-run"></i> Sí!',
            cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> No, Cancelar!'
        }).then(function (res) {
            console.log("datos del formulario",res);

            console.log("Datos",$(e.currentTarget).serializeArray());
            var formulario = $(e.currentTarget).serializeArray();
            var transmitio = document.getElementById("transmitio");
            transmitio = transmitio.options[transmitio.selectedIndex].text;
            formulario.push({
                name: "transmitio",
                value: transmitio
            });
            formulario.push({
                name: "accion",
                value: 'GUARDAR',
            });
            $.ajax({
                url: serverurl + "ajax/registroRiegoAjax.php",
                method: "post",
                data: $.param(formulario),

                success: function (res) {
                    if (res == 0) {
                        swal({
                            type: "success",
                            title: "El registro se ha guardado con éxito",
                            showConfirmButton: true,
                            allowOutsideClick: false
                        })
                        .then(function () {
                            const valores = window.location.search;
                            const urlParams = new URLSearchParams(valores);
                            var aniourl = urlParams.get('anio');
                            console.log("first",aniourl);
                            //.'/?anio=' .$anio."
                         window.location.href = serverurl + "registroRiego"+"/?anio="+aniourl;
                        });
                    } else {
                        swal({
                            type: "error",
                            title: "El registro no se ha podido guardar",
                            showConfirmButton: true,
                            allowOutsideClick: false
                        }).then(function () {
                        });
                        console.log(res);
                    }
                }
            });
        }).catch(function (e) {
            console.log(e);
        });
    }
    else {

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



$('#formularioConsultaEdicion').on('submit', function(e) {
    e.preventDefault();
    if (current_location_id != "" && current_location_id != null && current_location_id != undefined) {
      
        getTableData(e.target.value).then(function(data) {

            //console.log(JSON.parse(data));
            registers = JSON.parse(data)
            tabla_edicion.clear().draw();
            $.each(registers.fechas_registradas, function(key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos

                addRowEdicion(value.registro_id, value.punto, value.bomba_id, value.bombas_usadas, value.presion, value.tirante, value.gasto, value.hora_programada, value.transmitio, value.novedades, true)

            });

            $.each(registers.fechas_restantes, function(key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos
                //console.log(data)
                addRowEdicion("", "", "", "", "", "", "", value, "", "", false)


            });
            tabla_edicion.columns.adjust().draw(); // Redraw the DataTable


        }).finally(function() {
            //Reasignamos la cuenta para asignar los ids de las filas que se mostraran en la tabla
            countEmptyRegisters = 0;
            countRegisters = 10000;
            swal.close();
        });

    }


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
