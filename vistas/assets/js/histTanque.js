const decimalsPlaces=2;
const timezone = new Date().getTimezoneOffset();
defs_datatable.order = [[2, "desc"]];

var tabla = $('#tabla_historico_tanque').DataTable(defs_datatable);

var concentrado = [];

var datos_grafica_d1 = [];
var datos_grafica_d2 = [];
var datos_grafica_d3 = [];
var datos_grafica_d4 = [];
var datos_grafica_d5 = [];
var datos_grafica_d6 = [];

var defs_select2 = {
    placeholder: 'Seleccione una opción',
    language: {
        noResults: function (params) {

            return "No se encontraron resultados";

        }
    }
};

var columnDefs;

$(document).ready(() => {

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
                    "permisos": "('HISTORICOTANQUEAEROCLUB'," +
                        "'HISTORICOTANQUECARTERO'," +
                        "'HISTORICOTANQUEPALOALTO'," +
                        "'HISTORICOTANQUEZARAGOZA'," +
                        "'HISTORICOTANQUEDOLORES'," +
                        "'HISTORICOTANQUESTALUCIA1'," +
                        "'HISTORICOTANQUESTALUCIA2'," +
                        "'HISTORICOTANQUESTALUCIA3'," +
                        "'HISTORICOTANQUESTALUCIA4'," +
                        "'HISTORICOTANQUESTALUCIA5'," +
                        "'HISTORICOTANQUEVILLAVERDUN'," +
                        "'HISTORICOTANQUEAGUILAS2'," +
                        "'HISTORICOTANQUEAGUILAS3'," +
                        "'HISTORICOTANQUEAGUILAS4'," +
                        "'HISTORICOTANQUEAGUILAS5'," +
                        "'HISTORICOTANQUEAGUILAS6'," +
                        "'HISTORICOTANQUEMIMOSA'," +
                        "'HISTORICOTANQUELIENZO'," +
                        "'HISTORICOTANQUEJUDIO'," +
                        "'HISTORICOTANQUESANFRANCISCO'," +
                        "'HISTORICOTANQUEPADIERNA'," +
                        "'HISTORICOTANQUEPICACHO'," +
                        "'HISTORICOTANQUEMADEDEROSII'," +
                        "'HISTORICOTANQUEMADEDEROSIII'," +
                        "'HISTORICOTANQUEMAPLE'," +
                        "'HISTORICOTANQUEZAPOTE'," +
                        "'HISTORICOTANQUEZAPOTE'," +
                        "'HISTORICOTANQUEFABRIQUITA'," +
                        "'HISTORICOTANQUECURVA'," +
                        "'HISTORICOTANQUEROMPEDOR'," +
                        "'HISTORICOTANQUEMERCEDGOMEZ'," +
                        "'HISTORICOTANQUEYAQUI'," +
                        "'HISTORICOTANQUECALVARIO'," +
                        "'HISTORICOTANQUECONTADERO1'," +
                        "'HISTORICOTANQUECONTADERO2'," +
                        "'HISTORICOTANQUELIMBO'," +
                        "'HISTORICOTANQUELAERA'," +
                        "'HISTORICOTANQUEAO8')"
                },
                success: (res) => {

                    res = JSON.parse(res);
                    $.each(res, (key, value) => {

                        if (value.permiso == "HISTORICOTANQUEAEROCLUB") {
                            $("#tanque_id [value='1']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUECARTERO") {
                            $("#tanque_id [value='4']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEPALOALTO") {
                            $("#tanque_id [value='5']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEZARAGOZA") {
                            $("#tanque_id [value='6']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEDOLORES") {
                            $("#tanque_id [value='7']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUESTALUCIA1") {
                            $("#tanque_id [value='8']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUESTALUCIA2") {
                            $("#tanque_id [value='9']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUESTALUCIA3") {
                            $("#tanque_id [value='10']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUESTALUCIA4") {
                            $("#tanque_id [value='11']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUESTALUCIA5") {
                            $("#tanque_id [value='12']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEVILLAVERDUN") {
                            $("#tanque_id [value='13']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEAGUILAS2") {
                            $("#tanque_id [value='14']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEAGUILAS3") {
                            $("#tanque_id [value='15']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEAGUILAS4") {
                            $("#tanque_id [value='16']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEAGUILAS5") {
                            $("#tanque_id [value='17']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEAGUILAS6") {
                            $("#tanque_id [value='18']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEMIMOSA") {
                            $("#tanque_id [value='19']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUELIENZO") {
                            $("#tanque_id [value='20']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEJUDIO") {
                            $("#tanque_id [value='21']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUESANFRANCISCO") {
                            $("#tanque_id [value='22']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEPADIERNA") {
                            $("#tanque_id [value='23']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEPICACHO") {
                            $("#tanque_id [value='24']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEMADEDEROSII") {
                            $("#tanque_id [value='25']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEMADEDEROSIII") {
                            $("#tanque_id [value='26']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEMAPLE") {
                            $("#tanque_id [value='27']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEZAPOTE") {
                            $("#tanque_id [value='28']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEFABRIQUITA") {
                            $("#tanque_id [value='29']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUECURVA") {
                            $("#tanque_id [value='30']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEROMPEDOR") {
                            $("#tanque_id [value='31']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEMERCEDGOMEZ") {
                            $("#tanque_id [value='32']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEYAQUI") {
                            $("#tanque_id [value='33']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUECALVARIO") {
                            $("#tanque_id [value='34']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUECONTADERO1") {
                            $("#tanque_id [value='35']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUECONTADERO2") {
                            $("#tanque_id [value='36']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUELIMBO") {
                            $("#tanque_id [value='37']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUELAERA") {
                            $("#tanque_id [value='38']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOTANQUEAO8") {
                            $("#tanque_id [value='39']").attr("disabled", false);
                        }

                    });
                    $("#tanque_id > option").each(function () {
                        if ($("#tanque_id [value='" + this.value + "']").attr("disabled") == 'disabled')
                            $("#tanque_id [value='" + this.value + "']").remove();
                        $('#tanque_id').trigger('change.select2');
                    });
                    swal.close();
                }
            });
        }
    });

    $('#tanque_id').select2(defs_select2);
    $('#fecha_hora_programada').select2(defs_select2);

    $("#tanque_id").trigger('change');

    $('.dataTables_wrapper').find("select").formSelect();

    $("#excel").click(function () {
        tiposubmit = 2;
    });

    $("#submit").click(function () {
        tiposubmit = 1;
    });

    (function (H) {
        console.log(window.zipcelx)
        if (window.zipcelx && H.getOptions().exporting) {

            H.Chart.prototype.downloadXLSX = function () {
                var div = document.createElement('div'),
                    name,
                    xlsxRows = [],
                    rows;
                div.style.display = 'none';
                document.body.appendChild(div);
                rows = this.getDataRows(true);
                xlsxRows = rows.slice(1).map(function (row) {
                    return row.map(function (column) {
                        return {
                            type: typeof column === 'number' ? 'number' : 'string',
                            value: column
                        };
                    });
                });

                // Get the filename, copied from the Chart.fileDownload function
                if (this.options.exporting.filename) {
                    name = this.options.exporting.filename;
                } else if (this.title && this.title.textStr) {
                    name = this.title.textStr.replace(/ /g, '-').toLowerCase();
                } else {
                    name = 'chart';
                }

                window.zipcelx({
                    filename: name,
                    sheet: {
                        data: xlsxRows
                    }
                });
            };

            // Default lang string, overridable in i18n options
            H.getOptions().lang.downloadXLSX = 'Descargar archivo XLSX';

            // Add the menu item handler
            H.getOptions().exporting.menuItemDefinitions.downloadXLSX = {
                textKey: 'downloadXLSX',
                onclick: function () {
                    this.downloadXLSX();
                }
            };

            // Replace the menu item
            var menuItems = H.getOptions().exporting.buttons.contextButton.menuItems;
            menuItems[menuItems.indexOf('downloadXLS')] = 'downloadXLSX';
        }

    }(Highcharts));

    $('#daterange_historico').daterangepicker({
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(23, 'hour'),
        maxDate: moment().startOf('day'),
        timePicker24Hour: true,
        locale: {

            "format": 'YYYY-MM-DD H:mm',
            "separator": " / ",
            "applyLabel": "ACEPTAR",
            "cancelLabel": "CANCELAR",
            "fromLabel": "De",
            "toLabel": "Hasta",
            "customRangeLabel": "Personalizado",
            "weekLabel": "W",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        },
        ranges: {
            'Hoy': [moment(), moment()],
            'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Ultimos 7 días': [moment().subtract(6, 'days'), moment()],
            'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
            'Este Mes': [moment().startOf('month'), moment().endOf('month')],
            'Mes Anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

});

$("#ayuda").click(() => {
    introJs().start();
});

$('#form_historico_tanque').submit((e) => {

    e.preventDefault();

    if (tiposubmit == 1) {

        var tanque_id = document.getElementById('tanque_id');

        var rango_fechas = $("#daterange_historico").val();
        var fecha_inicial = rango_fechas.substring(0, rango_fechas.indexOf("/"));
        var fecha_final = rango_fechas.substring(rango_fechas.indexOf("/") + 1, rango_fechas.length);

        swal({
            title: 'CARGANDO',
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();

                //console.log(formulario);
                $.ajax({
                    url: serverurl + "ajax/histTanqueAjax.php",
                    method: "post",
                    data: {
                        "fecha_hora_inicial": fecha_inicial,
                        "fecha_hora_final": fecha_final,
                        "tanque_id": tanque_id.value,
                        "accion": "CONSULTA"
                    },
                    error: function (error) {
                        //Se activa cuando se termina el tiempo de espera
                        //
                        // swal.close();
                        swal({
                            type: "error",
                            title: "El tiempo de espera se ha agotado",
                            showConfirmButton: true,
                            allowOutsideClick: false
                        }).then(function () {

                        });
                    },
                    success: (res) => {


                        res = JSON.parse(res);
                        // console.log(res);
                        if (res.length) {
                            var tab = document.getElementById('div-tabs');

                            while (tab.firstChild) {

                                tab.removeChild(tab.firstChild);

                            };

                            ocultaGraficas();

                            $("#fecha_hora_programada").empty();

                            $.each(res.fechas_restantes, (key, value) => {

                                $("#fecha_hora_programada").append('<option value="' + value + '">' + value + '</option>');

                            });

                            var columnas = [
                                tabla.column(3),
                                tabla.column(4),
                                tabla.column(5),
                                tabla.column(6),
                                tabla.column(7),
                                tabla.column(8),
                                tabla.column(9),
                                tabla.column(10),
                                tabla.column(11),
                                tabla.column(12),
                                tabla.column(13),
                                tabla.column(14),
                                tabla.column(15),
                                tabla.column(16),
                                tabla.column(17),
                                tabla.column(18),
                                tabla.column(19),
                                tabla.column(20)
                            ];

                            if (tanque_id.value == 1) { // 1 .

                                for (var i = 0; i < columnas.length; i++) {

                                    var pasa = columnas[i];

                                    if (pasa[0] == 3 || pasa[0] == 4 || pasa[0] == 5) {

                                        pasa.visible(true);

                                    } else {

                                        pasa.visible(false);

                                    }

                                }

                                tabla.clear().draw();

                                datos_grafica_d1 = [];
                                datos_grafica_d2 = [];
                                datos_grafica_d3 = [];

                                $.each(res, (key, value) => {

                                    // cambia el formato de la fecha a puro entero (como cadena); la x -> Unix ms timestamp
                                    var fecha_format = moment(value.fecha_hora_programada).format('x');

                                    // cambiamos una vez mas el formato de los datos a puros enteros (fecha)
                                    datos_grafica_d1.push(
                                        [parseInt(fecha_format), parseFloat(value.tirante_uno)]
                                    );
                                    datos_grafica_d2.push(
                                        [parseInt(fecha_format), parseFloat(value.tirante_dos)]
                                    );
                                    datos_grafica_d3.push(
                                        [parseInt(fecha_format), parseFloat(value.tirante_tres)]
                                    );

                                    addRow(value);

                                });

                                var datos = ['uno', datos_grafica_d1, datos_grafica_d2, datos_grafica_d3, 'Aero Club', 'Tirante'];

                                tab.hidden = true;

                                grafica();
                                graficaTres(datos);

                            } else if (tanque_id.value == 4) { // 2 .

                                for (var i = 0; i < columnas.length; i++) {

                                    var pasa = columnas[i];

                                    if (pasa[0] == 3 || pasa[0] == 13 || pasa[0] == 20) {

                                        pasa.visible(true);

                                    } else {

                                        pasa.visible(false);

                                    }

                                }

                                tabla.clear().draw();

                                datos_grafica_d1 = [];
                                datos_grafica_d2 = [];

                                $.each(res, (key, value) => {

                                    var fecha_format = moment(value.fecha_hora_programada).format('x');

                                    datos_grafica_d1.push(
                                        [parseInt(fecha_format), parseFloat(value.tirante_uno)]
                                    );

                                    datos_grafica_d2.push(
                                        [parseInt(fecha_format), parseFloat(value.gasto)]
                                    );

                                    addRow(value);

                                });

                                var d1 = ['uno', datos_grafica_d1, 'Cartero', 'Tirante'];
                                var d2 = ['dos', datos_grafica_d2, 'Cartero', 'Gasto'];;

                                grafica();
                                graficaUno(d1);
                                graficaUno(d2);

                                ocultaGraficas();

                                tab.hidden = false;

                                var d1_btn = ['Tirante', 'tablinks active', 'uno'];
                                var d2_btn = ['Gasto', 'tablinks', 'dos'];

                                crearBoton(d1_btn);
                                crearBoton(d2_btn);

                            } else if (tanque_id.value == 7) { // 2 .

                                for (var i = 0; i < columnas.length; i++) {

                                    var pasa = columnas[i];

                                    if (pasa[0] == 3 || pasa[0] == 4 || pasa[0] == 5 || pasa[0] == 6 || pasa[0] == 8 || pasa[0] == 9) {

                                        pasa.visible(true);

                                    } else {

                                        pasa.visible(false);

                                    }

                                }

                                tabla.clear().draw();

                                datos_grafica_d1 = [];
                                datos_grafica_d2 = [];
                                datos_grafica_d3 = [];
                                datos_grafica_d4 = [];
                                datos_grafica_d5 = [];
                                datos_grafica_d6 = [];

                                $.each(res, (key, value) => {

                                    var fecha_format = moment(value.fecha_hora_programada).format('x');

                                    datos_grafica_d1.push(
                                        [parseInt(fecha_format), parseFloat(value.tirante_uno)]
                                    );

                                    datos_grafica_d2.push(
                                        [parseInt(fecha_format), parseFloat(value.tirante_dos)]
                                    );

                                    datos_grafica_d3.push(
                                        [parseInt(fecha_format), parseFloat(value.tirante_tres)]
                                    );

                                    datos_grafica_d4.push(
                                        [parseInt(fecha_format), parseFloat(value.tirante_cuatro)]
                                    );

                                    datos_grafica_d5.push(
                                        [parseInt(fecha_format), parseFloat(value.descarga_uno)]
                                    );

                                    datos_grafica_d6.push(
                                        [parseInt(fecha_format), parseFloat(value.descarga_dos)]
                                    );

                                    addRow(value);

                                });

                                var d1 = ['uno', datos_grafica_d1, datos_grafica_d2, datos_grafica_d3, datos_grafica_d4, 'Dolores', 'Tirante'];
                                var d2 = ['dos', datos_grafica_d5, datos_grafica_d6, 'Dolores', 'Descarga'];

                                grafica();
                                graficaCuatro(d1);
                                graficaDos(d2);

                                ocultaGraficas();

                                tab.hidden = false;

                                var d1_btn = ['Tirante', 'tablinks active', 'uno'];
                                var d2_btn = ['Descarga', 'tablinks', 'dos'];

                                crearBoton(d1_btn);
                                crearBoton(d2_btn);

                            } else if (tanque_id.value == 13) { // 2 .

                                for (var i = 0; i < columnas.length; i++) {

                                    var pasa = columnas[i];

                                    if (pasa[0] == 3 || pasa[0] == 12 || pasa[0] == 14) {

                                        pasa.visible(true);

                                    } else {

                                        pasa.visible(false);

                                    }

                                }

                                tabla.clear().draw();

                                datos_grafica_d1 = [];
                                datos_grafica_d2 = [];

                                $.each(res, (key, value) => {

                                    var fecha_format = moment(value.fecha_hora_programada).format('x');

                                    datos_grafica_d1.push(
                                        [parseInt(fecha_format), parseFloat(value.tirante_uno)]
                                    );

                                    datos_grafica_d2.push(
                                        [parseInt(fecha_format), parseFloat(value.presion)]
                                    );

                                    addRow(value);

                                });

                                var d1 = ['uno', datos_grafica_d1, 'Villa Verdun', 'Tirante'];
                                var d2 = ['dos', datos_grafica_d2, 'Villa Verdun', 'Presión'];

                                grafica();
                                graficaUno(d1);
                                graficaUno(d2);

                                ocultaGraficas();

                                tab.hidden = false;

                                var d1_btn = ['Tirante', 'tablinks active', 'uno'];
                                var d2_btn = ['Presión', 'tablinks', 'dos'];

                                crearBoton(d1_btn);
                                crearBoton(d2_btn);

                            } else if (tanque_id.value == 20) { // 4 .

                                for (var i = 0; i < columnas.length; i++) {

                                    var pasa = columnas[i];

                                    if (pasa[0] == 3 || pasa[0] == 7 || pasa[0] == 8 || pasa[0] == 11 || pasa[0] == 19) {

                                        pasa.visible(true);

                                    } else {

                                        pasa.visible(false);

                                    }

                                }

                                tabla.clear().draw();

                                datos_grafica_d1 = [];
                                datos_grafica_d2 = [];
                                datos_grafica_d3 = [];
                                datos_grafica_d4 = [];
                                datos_grafica_d5 = [];

                                $.each(res, (key, value) => {

                                    var fecha_format = moment(value.fecha_hora_programada).format('x');

                                    datos_grafica_d1.push(
                                        [parseInt(fecha_format), parseFloat(value.tirante_uno)]
                                    );

                                    datos_grafica_d2.push(
                                        [parseInt(fecha_format), parseFloat(value.vertedor)]
                                    );

                                    datos_grafica_d3.push(
                                        [parseInt(fecha_format), parseFloat(value.descarga_uno)]
                                    );

                                    datos_grafica_d4.push(
                                        [parseInt(fecha_format), parseFloat(value.local)]
                                    );

                                    datos_grafica_d5.push(
                                        [parseInt(fecha_format), parseFloat(value.bypass)]
                                    );

                                    addRow(value);

                                });

                                var d1 = ['uno', datos_grafica_d1, 'Lienzo', 'Tirante'];
                                var d2 = ['dos', datos_grafica_d2, 'Lienzo', 'Vertedor'];
                                var d3 = ['tres', datos_grafica_d3, 'Lienzo', 'Descarga'];
                                var d4 = ['cuatro', datos_grafica_d4, 'Lienzo', 'Local'];
                                var d5 = ['cinco', datos_grafica_d5, 'Lienzo', 'Bypass'];

                                grafica();
                                graficaUno(d1);
                                graficaUno(d2);
                                graficaUno(d3);
                                graficaUno(d4);
                                graficaUno(d5);

                                ocultaGraficas();

                                tab.hidden = false;

                                var d1_btn = ['Tirante', 'tablinks active', 'uno'];
                                var d2_btn = ['Vertedor', 'tablinks', 'dos'];
                                var d3_btn = ['Descarga', 'tablinks', 'tres'];
                                var d4_btn = ['Local', 'tablinks', 'cuatro'];
                                var d5_btn = ['Bypass', 'tablinks', 'cinco'];

                                crearBoton(d1_btn);
                                crearBoton(d2_btn);
                                crearBoton(d3_btn);
                                crearBoton(d4_btn);
                                crearBoton(d5_btn);


                            } else if (tanque_id.value == 30) { // 2 .

                                for (var i = 0; i < columnas.length; i++) {

                                    var pasa = columnas[i];

                                    if (pasa[0] == 3 || pasa[0] == 11) {

                                        pasa.visible(true);

                                    } else {

                                        pasa.visible(false);

                                    }

                                }

                                tabla.clear().draw();

                                datos_grafica_d1 = [];
                                datos_grafica_d2 = [];

                                $.each(res, (key, value) => {

                                    var fecha_format = moment(value.fecha_hora_programada).format('x');

                                    datos_grafica_d1.push(
                                        [parseInt(fecha_format), parseFloat(value.tirante_uno)]
                                    );

                                    datos_grafica_d2.push(
                                        [parseInt(fecha_format), parseFloat(value.local)]
                                    );

                                    addRow(value);

                                });

                                var d1 = ['uno', datos_grafica_d1, 'La Curva', 'Tirante'];
                                var d2 = ['dos', datos_grafica_d2, 'La Curva', 'Local'];

                                grafica();
                                graficaUno(d1);
                                graficaUno(d2);

                                ocultaGraficas();

                                tab.hidden = false;

                                var d1_btn = ['Tirante', 'tablinks active', 'uno'];
                                var d2_btn = ['Local', 'tablinks', 'dos'];

                                crearBoton(d1_btn);
                                crearBoton(d2_btn);

                            } else if (tanque_id.value == 33) { // 1 .

                                for (var i = 0; i < columnas.length; i++) {

                                    var pasa = columnas[i];

                                    if (pasa[0] == 3 || pasa[0] == 14 || pasa[0] == 15) {

                                        pasa.visible(true);

                                    } else {

                                        pasa.visible(false);

                                    }

                                }

                                tabla.clear().draw();

                                datos_grafica_d1 = [];

                                $.each(res, (key, value) => {

                                    var fecha_format = moment(value.fecha_hora_programada).format('x');

                                    datos_grafica_d1.push(
                                        [parseInt(fecha_format), parseFloat(value.tirante_uno)]
                                    );

                                    addRow(value);

                                });

                                var datos = ['uno', datos_grafica_d1, 'Yaqui', 'Tirante'];
                                var tab = document.getElementById('div-tabs');
                                tab.hidden = true;
                                grafica();
                                graficaUno(datos);

                            } else if (tanque_id.value == 37) { // 2 .

                                for (var i = 0; i < columnas.length; i++) {

                                    var pasa = columnas[i];

                                    if (pasa[0] == 3 || pasa[0] == 8 || pasa[0] == 14) {

                                        pasa.visible(true);

                                    } else {

                                        pasa.visible(false);

                                    }

                                }

                                tabla.clear().draw();

                                datos_grafica_d1 = [];
                                datos_grafica_d2 = [];

                                $.each(res, (key, value) => {

                                    var fecha_format = moment(value.fecha_hora_programada).format('x');

                                    datos_grafica_d1.push(
                                        [parseInt(fecha_format), parseFloat(value.tirante_uno)]
                                    );

                                    datos_grafica_d2.push(
                                        [parseInt(fecha_format), parseFloat(value.descarga_uno)]
                                    );

                                    addRow(value);

                                });

                                var d1 = ['uno', datos_grafica_d1, 'Limbo', 'Tirante'];
                                var d2 = ['dos', datos_grafica_d2, 'Limbo', 'Descarga'];

                                grafica();
                                graficaUno(d1);
                                graficaUno(d2);

                                ocultaGraficas();

                                tab.hidden = false;

                                var d1_btn = ['Tirante', 'tablinks active', 'uno'];
                                var d2_btn = ['Descarga', 'tablinks', 'dos'];

                                crearBoton(d1_btn);
                                crearBoton(d2_btn);

                            } else if (tanque_id.value == 38 || tanque_id.value == 39) { // 1 .

                                for (var i = 0; i < columnas.length; i++) {

                                    var pasa = columnas[i];

                                    if (pasa[0] == 3 || pasa[0] == 14) {

                                        pasa.visible(true);

                                    } else {

                                        pasa.visible(false);

                                    }

                                }

                                tabla.clear().draw();

                                datos_grafica_d1 = [];

                                $.each(res, (key, value) => {

                                    var fecha_format = moment(value.fecha_hora_programada).format('x');

                                    datos_grafica_d1.push(
                                        [parseInt(fecha_format), parseFloat(value.tirante_uno)]
                                    );

                                    addRow(value);

                                });

                                var datos = ['uno', datos_grafica_d1, 'Varios', 'Tirante'];
                                var tab = document.getElementById('div-tabs');
                                tab.hidden = true;
                                grafica();
                                graficaUno(datos);

                            } else if (tanque_id.value == 25 || tanque_id.value == 26 || tanque_id.value == 29 || tanque_id.value == 32) { // 1 .

                                for (var i = 0; i < columnas.length; i++) {

                                    var pasa = columnas[i];

                                    if (pasa[0] == 3) {

                                        pasa.visible(true);

                                    } else {

                                        pasa.visible(false);

                                    }

                                }

                                tabla.clear().draw();

                                datos_grafica_d1 = [];

                                $.each(res, (key, value) => {

                                    var fecha_format = moment(value.fecha_hora_programada).format('x');

                                    datos_grafica_d1.push(
                                        [parseInt(fecha_format), parseFloat(value.tirante_uno)]
                                    );

                                    addRow(value);

                                });

                                var datos = ['uno', datos_grafica_d1, 'Varios', 'Tirante'];
                                var tab = document.getElementById('div-tabs');
                                tab.hidden = true;
                                grafica();
                                graficaUno(datos);

                            } else if (tanque_id.value == 9 || tanque_id.value == 10 || tanque_id.value == 11 || tanque_id.value == 12 || tanque_id.value == 16 || tanque_id.value == 17 || tanque_id.value == 18) { // 4 .

                                for (var i = 0; i < columnas.length; i++) {

                                    var pasa = columnas[i];

                                    if (pasa[0] == 3 || pasa[0] == 7 || pasa[0] == 8 || pasa[0] == 11) {

                                        pasa.visible(true);

                                    } else {

                                        pasa.visible(false);

                                    }

                                }

                                tabla.clear().draw();

                                datos_grafica_d1 = [];
                                datos_grafica_d2 = [];
                                datos_grafica_d3 = [];
                                datos_grafica_d4 = [];

                                $.each(res, (key, value) => {

                                    var fecha_format = moment(value.fecha_hora_programada).format('x');

                                    datos_grafica_d1.push(
                                        [parseInt(fecha_format), parseFloat(value.tirante_uno)]
                                    );

                                    datos_grafica_d2.push(
                                        [parseInt(fecha_format), parseFloat(value.vertedor)]
                                    );

                                    datos_grafica_d3.push(
                                        [parseInt(fecha_format), parseFloat(value.descarga_uno)]
                                    );

                                    datos_grafica_d4.push(
                                        [parseInt(fecha_format), parseFloat(value.local)]
                                    );

                                    addRow(value);

                                });

                                var d1 = ['uno', datos_grafica_d1, 'Varios', 'Tirante'];
                                var d2 = ['dos', datos_grafica_d2, 'Varios', 'Vertedor'];
                                var d3 = ['tres', datos_grafica_d3, 'Varios', 'Descarga'];
                                var d4 = ['cuatro', datos_grafica_d4, 'Varios', 'Local'];

                                grafica();
                                graficaUno(d1);
                                graficaUno(d2);
                                graficaUno(d3);
                                graficaUno(d4);

                                ocultaGraficas();

                                tab.hidden = false;

                                var d1_btn = ['Tirante', 'tablinks active', 'uno'];
                                var d2_btn = ['Vertedor', 'tablinks', 'dos'];
                                var d3_btn = ['Descarga', 'tablinks', 'tres'];
                                var d4_btn = ['Local', 'tablinks', 'cuatro'];

                                crearBoton(d1_btn);
                                crearBoton(d2_btn);
                                crearBoton(d3_btn);
                                crearBoton(d4_btn);

                            } else if (tanque_id.value == 5 || tanque_id.value == 8 || tanque_id.value == 21 || tanque_id.value == 22 || tanque_id.value == 23) { // 3 .

                                for (var i = 0; i < columnas.length; i++) {

                                    var pasa = columnas[i];

                                    if (pasa[0] == 3 || pasa[0] == 7 || pasa[0] == 8) {

                                        pasa.visible(true);

                                    } else {

                                        pasa.visible(false);

                                    }

                                }

                                tabla.clear().draw();

                                datos_grafica_d1 = [];
                                datos_grafica_d2 = [];
                                datos_grafica_d3 = [];

                                $.each(res, (key, value) => {

                                    var fecha_format = moment(value.fecha_hora_programada).format('x');

                                    datos_grafica_d1.push(
                                        [parseInt(fecha_format), parseFloat(value.tirante_uno)]
                                    );

                                    datos_grafica_d2.push(
                                        [parseInt(fecha_format), parseFloat(value.vertedor)]
                                    );

                                    datos_grafica_d3.push(
                                        [parseInt(fecha_format), parseFloat(value.descarga_uno)]
                                    );

                                    addRow(value);

                                });

                                var d1 = ['uno', datos_grafica_d1, 'varios', 'Tirante'];
                                var d2 = ['dos', datos_grafica_d2, 'varios', 'Vertedor'];
                                var d3 = ['tres', datos_grafica_d3, 'varios', 'Descarga'];

                                grafica();
                                graficaUno(d1);
                                graficaUno(d2);
                                graficaUno(d3);

                                ocultaGraficas();

                                tab.hidden = false;

                                var d1_btn = ['Tirante', 'tablinks active', 'uno'];
                                var d2_btn = ['Vertedor', 'tablinks', 'dos'];
                                var d3_btn = ['Descarga', 'tablinks', 'tres'];

                                crearBoton(d1_btn);
                                crearBoton(d2_btn);
                                crearBoton(d3_btn);

                            } else if (tanque_id.value == 6 || tanque_id.value == 14 || tanque_id.value == 15 || tanque_id.value == 19 || tanque_id.value == 27 || tanque_id.value == 28 || tanque_id.value == 31 || tanque_id.value == 34) { // 2 .

                                for (var i = 0; i < columnas.length; i++) {

                                    var pasa = columnas[i];

                                    if (pasa[0] == 3 || pasa[0] == 8) {

                                        pasa.visible(true);

                                    } else {

                                        pasa.visible(false);

                                    }

                                }

                                tabla.clear().draw();

                                datos_grafica_d1 = [];
                                datos_grafica_d2 = [];

                                $.each(res, (key, value) => {

                                    var fecha_format = moment(value.fecha_hora_programada).format('x');

                                    datos_grafica_d1.push(
                                        [parseInt(fecha_format), parseFloat(value.tirante_uno)]
                                    );

                                    datos_grafica_d2.push(
                                        [parseInt(fecha_format), parseFloat(value.descarga_uno)]
                                    );

                                    addRow(value);

                                });

                                var d1 = ['uno', datos_grafica_d1, 'varios', 'Tirante'];
                                var d2 = ['dos', datos_grafica_d2, 'varios', 'Descarga'];

                                grafica();
                                graficaUno(d1);
                                graficaUno(d2);

                                ocultaGraficas();

                                tab.hidden = false;

                                var d1_btn = ['Tirante', 'tablinks active', 'uno'];
                                var d2_btn = ['Descarga', 'tablinks', 'dos'];

                                crearBoton(d1_btn);
                                crearBoton(d2_btn);

                            }

                            swal.close();
                        } else {
                            swal({
                                type: "warning",
                                title: "No se encontraron datos, intente con otros valores",
                                showConfirmButton: true,
                                allowOutsideClick: false
                            }).then(function () {

                            });
                        }

                    },
                    timeout: 5000

                });

            }

        });

    }

    if (tiposubmit == 2) {

        var tanque_id = document.getElementById('tanque_id');
        var tanque_text = tanque_id.options[tanque_id.selectedIndex].text.replace(" ","_");

        var rango_fechas = $("#daterange_historico").val();
        var fecha_inicial = rango_fechas.substring(0, rango_fechas.indexOf("/"));
        var fecha_final = rango_fechas.substring(rango_fechas.indexOf("/") + 1, rango_fechas.length);

        $.ajax({
            url: serverurl + "ajax/histTanqueAjax.php",
            method: "post",
            data: {
                "fecha_hora_inicial": fecha_inicial,
                "fecha_hora_final": fecha_final,
                "tanque_id": tanque_id.value,
                "accion": "CONSULTA"
            },
            error: function (error) {
                //Se activa cuando se termina el tiempo de espera
                //
                // swal.close();
                swal({
                    type: "error",
                    title: "El tiempo de espera se ha agotado",
                    showConfirmButton: true,
                    allowOutsideClick: false
                }).then(function () {

                });
            },
            success: function (res) {

                res = JSON.parse(res);
                if (res.length) {
                    concentrado = [];

                    $.each(res, function (key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos

                        concentrado.push(value);

                    });

                    excel(tanque_text, fecha_inicial, fecha_final);
                } else {
                    swal({
                        type: "warning",
                        title: "No se encontraron datos, intente con otros valores",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(function () {

                    });
                }


            },
            timeout: 5000

        });

    }

});

function addRow(e) {


    e.presion=parseFloat(e.presion).toFixed(decimalsPlaces);
    e.gasto=parseFloat(e.gasto).toFixed(decimalsPlaces);
    tabla.row.add([
        "<input type='hidden'  value =" + (tabla.page.info().recordsTotal + 1) + ">" + (tabla.page.info().recordsTotal + 1),
        '<input type="hidden"  value ="' + e.tanque + '">' + e.tanque,
        '<input type="hidden"  value ="' + e.fecha_hora_programada + '">' + e.fecha_hora_programada,

        '<input type="hidden"  value ="' + e.tirante_uno + '">' + e.tirante_uno + ' m',
        '<input type="hidden"  value ="' + e.tirante_dos + '">' + e.tirante_dos + ' m',
        '<input type="hidden"  value ="' + e.tirante_tres + '">' + e.tirante_tres + ' m',
        '<input type="hidden"  value ="' + e.tirante_cuatro + '">' + e.tirante_cuatro + ' m',

        '<input type="hidden"  value ="' + e.vertedor + '">' + e.vertedor,

        '<input type="hidden"  value ="' + e.descarga_uno + '">' + e.descarga_uno,
        '<input type="hidden"  value ="' + e.descarga_dos + '">' + e.descarga_dos,
        '<input type="hidden"  value ="' + e.descarga_tres + '">' + e.descarga_tres,

        '<input type="hidden"  value ="' + e.local + '">' + e.local,
        '<input type="hidden"  value ="' + e.presion + '">' + e.presion,
        '<input type="hidden"  value ="' + e.gasto + '">' + e.gasto,

        '<input type="hidden"  value ="' + e.eq1 + '">' + e.eq1,
        '<input type="hidden"  value ="' + e.eq2 + '">' + e.eq2,
        '<input type="hidden"  value ="' + e.eq3 + '">' + e.eq3,
        '<input type="hidden"  value ="' + e.eq4 + '">' + e.eq4,
        '<input type="hidden"  value ="' + e.eq5 + '">' + e.eq5,

        '<input type="hidden"  value ="' + e.bypass + '">' + e.bypass,
        '<input type="hidden"  value ="' + e.equipos + '">' + e.equipos,

        '<input type="hidden"  value ="' + e.transmite + '">' + e.transmite,
        '<input type="hidden"  value ="' + e.novedad + '">' + e.novedad
    ]).draw();

    $('#submit').prop("disabled", false);

}

function excel(tanque_text, fecha_inicial, fecha_final) {

    var data = [];
    var tanque_id = document.getElementById('tanque_id').value;

    if (tanque_id == 1) {

        $.each(concentrado, function (key, value) {

            data.push({
                "Tanque": parseFloat(value.tanque).toFixed(decimalsPlaces),
                "Hora Programada": value.fecha_hora_programada,
                "Tirante": parseFloat(value.tirante_uno).toFixed(decimalsPlaces),
                "2do Tirante": parseFloat(value.tirante_dos).toFixed(decimalsPlaces),
                "3er Tirante": parseFloat(value.tirante_tres).toFixed(decimalsPlaces),
                "Transmite": value.transmite,
                "Observaciones": value.novedad
            });

        });

    } else if (tanque_id == 4) {

        $.each(concentrado, function (key, value) {

            data.push({
                "Tanque": value.tanque,
                "Hora Programada": value.fecha_hora_programada,
                "Tirante": parseFloat(value.tirante_uno).toFixed(decimalsPlaces),
                "Gasto": value.gasto,
                "Equipos": value.equipos,
                "Transmite": value.transmite,
                "Observaciones": value.novedad
            });

        });

    } else if (tanque_id == 7) {

        $.each(concentrado, function (key, value) {

            data.push({
                "Tanque": value.tanque,
                "Hora Programada": value.fecha_hora_programada,
                "Tirante": parseFloat(value.tirante_uno).toFixed(decimalsPlaces),
                "2do Tirante": parseFloat(value.tirante_dos).toFixed(decimalsPlaces),
                "3er Tirante": parseFloat(value.tirante_tres).toFixed(decimalsPlaces),
                "4to Tirante": parseFloat(value.tirante_cuatro).toFixed(decimalsPlaces),
                "1er Descarga": value.descarga_uno,
                "2da Descarga": value.descarga_dos,
                "Transmite": value.transmite,
                "Observaciones": value.novedad
            });

        });

    } else if (tanque_id == 13) {

        $.each(concentrado, function (key, value) {

            data.push({
                "Tanque": value.tanque,
                "Hora Programada": value.fecha_hora_programada,
                "Tirante": parseFloat(value.tirante_uno).toFixed(decimalsPlaces),
                "Presion": value.presion,
                "Equipo Operativo": value.eq1,
                "Transmite": value.transmite,
                "Observaciones": value.novedad
            });

        });

    } else if (tanque_id == 20) {

        $.each(concentrado, function (key, value) {

            data.push({
                "Tanque": value.tanque,
                "Hora Programada": value.fecha_hora_programada,
                "Tirante": parseFloat(value.tirante_uno).toFixed(decimalsPlaces),
                "Vertedor": value.vertedor,
                "Descarga": value.descarga_uno,
                "Local": value.local,
                "Bypass": value.bypass,
                "Transmite": value.transmite,
                "Observaciones": value.novedad
            });

        });

    } else if (tanque_id == 30) {

        $.each(concentrado, function (key, value) {

            data.push({
                "Tanque": value.tanque,
                "Hora Programada": value.fecha_hora_programada,
                "Tirante": parseFloat(value.tirante_uno).toFixed(decimalsPlaces),
                "Local": value.local,
                "Transmite": value.transmite,
                "Observaciones": value.novedad
            });

        });

    } else if (tanque_id == 33) {

        $.each(concentrado, function (key, value) {

            data.push({
                "Tanque": value.tanque,
                "Hora Programada": value.fecha_hora_programada,
                "Tirante": parseFloat(value.tirante_uno).toFixed(decimalsPlaces),
                "Equipo Operativo": value.eq1,
                "2do Equipo Operativo": value.eq2,
                "Transmite": value.transmite,
                "Observaciones": value.novedad
            });

        });

    } else if (tanque_id == 37) {

        $.each(concentrado, function (key, value) {

            data.push({
                "Tanque": value.tanque,
                "Hora Programada": value.fecha_hora_programada,
                "Tirante": parseFloat(value.tirante_uno).toFixed(decimalsPlaces),
                "Descarga": value.descarga_uno,
                "Equipo Operativo": value.eq1,
                "Transmite": value.transmite,
                "Observaciones": value.novedad
            });

        });

    } else if (tanque_id == 38 || tanque_id == 39) {

        $.each(concentrado, function (key, value) {

            data.push({
                "Tanque": value.tanque,
                "Hora Programada": value.fecha_hora_programada,
                "Tirante": parseFloat(value.tirante_uno).toFixed(decimalsPlaces),
                "Equipo Operativo": value.eq1,
                "Transmite": value.transmite,
                "Observaciones": value.novedad
            });

        });

    } else if (tanque_id == 25 || tanque_id == 26 || tanque_id == 29 || tanque_id == 32) {

        $.each(concentrado, function (key, value) {

            data.push({
                "Tanque": value.tanque,
                "Hora Programada": value.fecha_hora_programada,
                "Tirante": parseFloat(value.tirante_uno).toFixed(decimalsPlaces),
                "Transmite": value.transmite,
                "Observaciones": value.novedad
            });

        });

    } else if (tanque_id == 9 || tanque_id == 10 || tanque_id == 11 || tanque_id == 12 || tanque_id == 16 || tanque_id == 17 || tanque_id == 18) {

        $.each(concentrado, function (key, value) {

            data.push({
                "Tanque": value.tanque,
                "Hora Programada": value.fecha_hora_programada,
                "Tirante": parseFloat(value.tirante_uno).toFixed(decimalsPlaces),
                "Vertedor": value.vertedor,
                "Descarga": value.descarga_uno,
                "Local": value.local,
                "Transmite": value.transmite,
                "Observaciones": value.novedad
            });

        });

    } else if (tanque_id == 5 || tanque_id == 8 || tanque_id == 21 || tanque_id == 22 || tanque_id == 23) {

        $.each(concentrado, function (key, value) {

            data.push({
                "Tanque": value.tanque,
                "Hora Programada": value.fecha_hora_programada,
                "Tirante": parseFloat(value.tirante_uno).toFixed(decimalsPlaces),
                "Vertedor": value.vertedor,
                "Descarga": value.descarga_uno,
                "Transmite": value.transmite,
                "Observaciones": value.novedad
            });

        });

    } else if (tanque_id == 6 || tanque_id == 14 || tanque_id == 15 || tanque_id == 19 || tanque_id == 27 || tanque_id == 28 || tanque_id == 31 || tanque_id == 34) {

        $.each(concentrado, function (key, value) {

            data.push({
                "Tanque": value.tanque,
                "Hora Programada": value.fecha_hora_programada,
                "Tirante": parseFloat(value.tirante_uno).toFixed(decimalsPlaces),
                "Descarga": value.descarga_uno,
                "Transmite": value.transmite,
                "Observaciones": value.novedad
            });

        });

    }

    /* this line is only needed if you are not adding a script tag reference */
    if (typeof XLSX == 'undefined') XLSX = require('xlsx');

    /* make the worksheet */
    var ws = XLSX.utils.json_to_sheet(data);

    /* add to workbook */
    var wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Tanque");

    /* write workbook (use type 'binary') */
    var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });

    /* generate a download */
    function s2ab(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i = 0; i != s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
        return buf;
    }

    saveAsCustom(new Blob([s2ab(wbout)], { type: "application/octet-stream" }), "HISTORICO_TANQUE_"+tanque_text+"_"+fecha_inicial+"_"+fecha_final+".xlsx");

}

function grafica() {

    Highcharts.setOptions({
        lang: {
            drillUpText: '< Regresar {series.name}',
            loading: 'Cargando...',
            months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            shortMonths: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            viewFullscreen: "Ver pantalla completa",
            exitFullscreen: 'Salir de pantalla completa',
            viewData: "Ver datos en tabla",
            exportButtonTitle: "Exportar",
            printButtonTitle: "Importar",
            rangeSelectorFrom: "Desde",
            rangeSelectorTo: "Hasta",
            rangeSelectorZoom: "Vista",
            downloadPNG: 'Descargar imagen PNG',
            downloadJPEG: 'Descargar imagen JPEG',
            downloadSVG: 'Descargar imagen SVG',
            downloadCSV: 'Descargar archivo CSV',
            downloadXLS: 'Descargar archivo XLS',
            downloadPDF: 'Descargar archivo PDF',
            contextButtonTitle: 'Menu gráfica',
            printChart: 'Imprimir',
            resetZoom: 'Reiniciar zoom',
            resetZoomTitle: 'Reiniciar zoom',
            thousandsSep: ",",
            decimalPoint: '.'
        },
        chart: {
            zoomType: 'xy'
        },
        tooltip: {
            followPointer: true
        },
        time: {
            timezoneOffset: timezone
        },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: {
                hour: '%e/%b %H:%M',
                minute: '%e/%b %H:%M',
            }
        },
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    chart: {
                        height: 300
                    },
                    subtitle: {
                        text: null
                    }
                }
            }]
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(
                            Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                marker: {
                    radius: 2
                },
                lineWidth: 1,
                states: {
                    hover: {
                        lineWidth: 1
                    }
                },
                threshold: null
            }
        },
        credits: {
            enabled: false
        }
    });

}

// para un solo dato
function graficaUno(arreglo) {

    document.getElementById('div-grafica-' + arreglo[0]).hidden = false;

    Highcharts.chart('grafica_' + arreglo[0], {
        title: {
            // text: arreglo[3] + ' en ' + arreglo[2]
            text: arreglo[3]
        },
        subtitle: {
            text: ''
        },
        legend: {
            enabled: false
        },
        series: [{
            type: 'line',
            name: arreglo[3],
            data: arreglo[1]
        }],
        yAxis: [{
            title: {
                text: arreglo[3] + ' [m]'
            },
            min: arreglo[4],
            max: arreglo[5],
            opposite: false
        }],
        tooltip: {
            shared: true,
            valueSuffix: ' m'
        }
    });

}

// para dos datos
function graficaDos(arreglo) {

    document.getElementById('div-grafica-' + arreglo[0]).hidden = false;

    Highcharts.chart('grafica_' + arreglo[0], {
        title: {
            // text: arreglo[4] + ' en ' + arreglo[3]
            text: arreglo[4]
        },
        subtitle: {
            text: ''
        },
        legend: {
            enabled: false
        },
        series: [{
            type: 'line',
            name: arreglo[4] + ' Uno',
            data: arreglo[1]
        }, {
            type: 'line',
            name: arreglo[4] + ' Dos',
            data: arreglo[2]
        }],
        yAxis: [{
            title: {
                text: arreglo[4] + ' [m]'
            },
            min: arreglo[5],
            max: arreglo[6],
            opposite: false
        }],
        tooltip: {
            shared: true,
            valueSuffix: ' m'
        }
    });

}

// para tres datos
function graficaTres(arreglo) {

    document.getElementById('div-grafica-' + arreglo[0]).hidden = false;

    Highcharts.chart('grafica_' + arreglo[0], {
        title: {
            // text: arreglo[5] + ' en ' + arreglo[4]
            text: arreglo[5]
        },
        subtitle: {
            text: ''
        },
        legend: {
            enabled: false
        },
        series: [{
            type: 'line',
            name: arreglo[5] + ' Uno',
            data: arreglo[1]
        }, {
            type: 'line',
            name: arreglo[5] + ' Dos',
            data: arreglo[2]
        }, {
            type: 'line',
            name: arreglo[5] + ' Tres',
            data: arreglo[3]
        }],
        yAxis: [{
            title: {
                text: arreglo[5] + ' [m]'
            },
            min: arreglo[6],
            max: arreglo[7],
            // plotLines: [{
            //     color: '#FF0000',
            //     width: 2,
            //     value: info_subestaciones[sub_id].max,
            //     label: {
            //         text: 'Amperaje Maximo: 80 A',
            //         align: 'center',
            //         style: {
            //             color: 'gray'
            //         }
            //     }
            // },
            // {
            //     color: '#0000FF',
            //     width: 2,
            //     value: info_subestaciones[sub_id].min,
            //     label: {
            //         text: 'Amperaje Minimo: 40 A',
            //         align: 'center',
            //         style: {
            //             color: 'gray'
            //         }
            //     }
            // }
            // ],
            opposite: false
        }],
        tooltip: {
            shared: true,
            valueSuffix: ' m'
        }
    });

}

// para cuatro datos
function graficaCuatro(arreglo) {

    document.getElementById('div-grafica-' + arreglo[0]).hidden = false;

    Highcharts.chart('grafica_' + arreglo[0], {
        title: {
            // text: arreglo[6] + ' en ' + arreglo[5]
            text: arreglo[6]
        },
        subtitle: {
            text: ''
        },
        legend: {
            enabled: false
        },
        series: [{
            type: 'line',
            name: arreglo[6] + ' Uno',
            data: arreglo[1]
        }, {
            type: 'line',
            name: arreglo[6] + ' Dos',
            data: arreglo[2]
        }, {
            type: 'line',
            name: arreglo[6] + ' Tres',
            data: arreglo[3]
        }, {
            type: 'line',
            name: arreglo[6] + ' Cuatro',
            data: arreglo[4]
        }],
        yAxis: [{
            title: {
                text: arreglo[6] + ' [m]'
            },
            min: arreglo[7],
            max: arreglo[8],

            opposite: false
        }],
        tooltip: {
            shared: true,
            valueSuffix: ' m'
        }
    });

}

function ocultaGraficas() {

    var divs = [
        document.getElementById('div-grafica-uno'),
        document.getElementById('div-grafica-dos'),
        document.getElementById('div-grafica-tres'),
        document.getElementById('div-grafica-cuatro'),
        document.getElementById('div-grafica-cinco'),
        document.getElementById('div-grafica-seis')
    ];

    // ocultar las graficas (deja la primera)
    for (var i = 1; i < divs.length; i++) {

        var pasa = divs[i];

        pasa.hidden = true;

    }

}

function crearBoton(arreglo) {

    var tab = document.getElementById('div-tabs');

    var new_btn = document.createElement('button');

    new_btn.type = 'button';
    new_btn.innerHTML = arreglo[0];
    new_btn.className = arreglo[1];
    new_btn.value = arreglo[2];
    new_btn.onclick = function () { motorTabs(this); };

    tab.appendChild(new_btn);

}

function motorTabs(e) {

    var divs = [
        document.getElementById('div-grafica-uno'),
        document.getElementById('div-grafica-dos'),
        document.getElementById('div-grafica-tres'),
        document.getElementById('div-grafica-cuatro'),
        document.getElementById('div-grafica-cinco'),
        document.getElementById('div-grafica-seis')
    ];

    var tab = document.getElementById('div-tabs');
    var botones = tab.getElementsByTagName('button');

    for (var i = 0; i < botones.length; i++) {

        var pasa = botones[i];

        if (pasa.innerText == e.innerText) {

            pasa.classList.add('active');

        } else {

            pasa.classList.remove('active');

            for (var i = 0; i < divs.length; i++) {

                var muestra = divs[i];

                if (muestra.id === 'div-grafica-' + e.value) {

                    muestra.hidden = false;

                } else {

                    muestra.hidden = true;

                }

            }

        }

    }

}