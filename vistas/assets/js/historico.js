const decimalsPlaces=2;

defs_datatable.order = [[2, "desc"]];



var tabla = $('#tabla_historico').DataTable(defs_datatable);

var tiposubmit = 0;

var concentrado = [];
var gasto = "";
var tirante = "";
var hora_programada = "";
var transmitio = "";
var novedades = "";
var valido = false;


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
                    "permisos": "('HISTORICOPUNTOVENTURYII'," +
                        "'HISTORICOPUNTOVENTURYIII'," +
                        "'HISTORICOPUNTOALZATE'," +
                        "'HISTORICOPUNTOATARASQUILLO'," +
                        "'HISTORICOPUNTOVENADO'," +
                        "'HISTORICOPUNTODOLORES'," +
                        "'HISTORICOPUNTOBORRACHO')"
                },
                success: (res) => {

                    res = JSON.parse(res);
                    $.each(res, (key, value) => {

                        if (value.permiso == "HISTORICOPUNTOVENTURYII") {
                            $("#punto_id [value='1']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOPUNTOVENTURYIII") {
                            $("#punto_id [value='2']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOPUNTOALZATE") {
                            $("#punto_id [value='3']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOPUNTOATARASQUILLO") {
                            $("#punto_id [value='4']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOPUNTOVENADO") {
                            $("#punto_id [value='5']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOPUNTODOLORES") {
                            $("#punto_id [value='6']").attr("disabled", false);
                        } else if (value.permiso == "HISTORICOPUNTOBORRACHO") {
                            $("#punto_id [value='7']").attr("disabled", false);
                        }

                    });
                    $("#punto_id > option").each(function () {
                        //console.log(this.value);
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

    $("#excel").click(function (e) {
        tiposubmit = 2;
    });

    $("#submit").click(function () {
        tiposubmit = 1;
    });

    $('#daterange_historico').daterangepicker({
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(23, 'hour'),
        maxDate: moment().endOf('day'),
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

    $('#punto_id').select2(defs_select2);

});

$("form").on("submit", function (e) {

    e.preventDefault();
    if (tiposubmit == 1) {

        var punto_id = document.getElementById("punto_id");
        var rango_fechas = $("#daterange_historico").val();
        var fecha_inicial = rango_fechas.substring(0, rango_fechas.indexOf("/"));
        var fecha_final = rango_fechas.substring(rango_fechas.indexOf("/") + 1, rango_fechas.length);
        swal({
            title: 'CARGANDO',
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
                $.ajax({
                    url: serverurl + "ajax/historicoAjax.php",
                    method: "post",

                    data: { "fecha_hora_inicial": fecha_inicial, "fecha_hora_final": fecha_final, "punto_id": punto_id.value, "accion": "CONSULTA" },
                    
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
                        swal.close();
                        res = JSON.parse(res);
                        if(res.length)
                        {
                            var $el = $("#hora_programada");

                            tabla.clear().draw();
                            $.each(res, function (key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos
    
                                nombre_pozo = value.punto;
                                hora_programada = value.hora_programada;
                                bomba = value.bomba;
                                presion = value.presion;
                                tirante = value.tirante;
                                gasto = value.gasto;
                                transmitio = value.transmitio;
                                novedades = value.novedades;
    
                                addRow();
    
                            });
                            tabla.columns.adjust().draw(); // Redraw the DataTable
    
                            $el.empty(); //Se vacia la lista de opciones de articulos para volverla a formar
                            $.each(res.fechas_restantes, function (key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos
    
                                $el.append($("<option></option>").attr("value", value).text(value));
    
                            });
                        }else{
                            swal({
                                type: "warning",
                                title:  "No se encontraron datos, intente con otros valores",
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

        var punto_id = document.getElementById("punto_id");
        var punto_text = punto_id.options[punto_id.selectedIndex].text.replace(" ","_");

        var rango_fechas = $("#daterange_historico").val();
        var fecha_inicial = rango_fechas.substring(0, rango_fechas.indexOf("/"));
        var fecha_final = rango_fechas.substring(rango_fechas.indexOf("/") + 1, rango_fechas.length);
        $.ajax({
            url: serverurl + "ajax/historicoAjax.php",
            method: "post",

            data: { "fecha_hora_inicial": fecha_inicial, "fecha_hora_final": fecha_final, "punto_id": punto_id.value, "accion": "CONSULTA" },
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
                if(res.length){

                    var $el = $("#hora_programada");

                    concentrado = [];
                    $.each(res, function (key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos
    
                        concentrado.push(value);
                        //promedio = value.promedio;
    
                    });
                    tabla.columns.adjust().draw(); // Redraw the DataTable
    
                    $el.empty(); //Se vacia la lista de opciones de articulos para volverla a formar
                    $.each(res.fechas_restantes, function (key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos
    
                        $el.append($("<option></option>").attr("value", value).text(value));
    
                    });
                    excel(punto_text, fecha_inicial, fecha_final);
                }else{
                    swal({
                        type: "warning",
                        title: "No se encontraron datos, intente con otros valores",
                        showConfirmButton: true,
                        allowOutsideClick: false
                      }).then(function () {
          
                      });
                }
               

            },
            timeout:5000

        });
    }
});

function addRow() {
    presion=parseFloat(presion).toFixed(decimalsPlaces);
    tirante=parseFloat(tirante).toFixed(decimalsPlaces);
    gasto=parseFloat(gasto).toFixed(decimalsPlaces);

    tabla.row.add([
        "<input type='hidden'  value =" + (tabla.page.info().recordsTotal + 1) + ">" + (tabla.page.info().recordsTotal + 1),
        '<input  type="hidden"  value ="' + nombre_pozo + '">' + nombre_pozo,
        '<input type="hidden"   value ="' + hora_programada + '">' + hora_programada,
        '<input type="hidden"   value ="' + bomba + '">' + bomba,
        '<input type="hidden"   value ="' + presion + '">' + presion,
        '<input type="hidden"  value ="' + tirante + '">' + tirante,
        '<input type="hidden"  value ="' + gasto + '">' + gasto,
        '<input type="hidden" value ="' + transmitio + '">' + transmitio,
        '<input type="hidden" value ="' + novedades + '">' + novedades,

    ]).draw();
    $('#submit').prop("disabled", false);
    $("#gasto").val("");
    $("#tirante").val("");
    $("#datetimepicker3").val("");
    $("#transmitio").val("");
    $("#novedades").val("");

}
$('form').on('submit', function (e) {
    e.preventDefault();

    var punto = document.getElementById(" punto_id");

    var gasto = document.getElementById("gasto");
    var tirante = document.getElementById("tirante");
    var hora_programada = document.getElementById("hora_programada");
    var transmitio = document.getElementById("transmitio");
    var novedades = document.getElementById("novedades");
    var valido = false;
});


function excel(punto_text, fecha_inicial, fecha_final) {

    var data = [];

    $.each(concentrado, function (key, value) {

        data.push({ "Punto Monitoreo": value.punto, "Hora Programada": value.hora_programada, "Bomba": value.bomba, "Presion": parseFloat(value.presion).toFixed(decimalsPlaces), "Tirante": parseFloat(value.tirante).toFixed(decimalsPlaces), "Gasto (L/s)": parseFloat(value.gasto).toFixed(decimalsPlaces), "Transmite": value.transmitio, "Observaciones": value.novedades });
    });



    /* this line is only needed if you are not adding a script tag reference */
    if (typeof XLSX == 'undefined') XLSX = require('xlsx');

    /* make the worksheet */
    var ws = XLSX.utils.json_to_sheet(data);

    /* add to workbook */
    var wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Historico");

    /* write workbook (use type 'binary') */
    var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });

    /* generate a download */
    function s2ab(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i = 0; i != s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
        return buf;
    }

    saveAsCustom(new Blob([s2ab(wbout)], { type: "application/octet-stream" }), "HISTORICO_PUNTO_"+punto_text+"_"+fecha_inicial+"_"+fecha_final+".xlsx");
}
