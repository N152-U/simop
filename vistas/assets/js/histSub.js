const decimalsPlaces = 2;
const timezone = new Date().getTimezoneOffset();
defs_datatable.order = [[2, "desc"]];
var sub_id;

/*
    [
        {
            "id_subestacion": {
                "min": int,
                "max": int
            }
        }
    ]


*/
var info_subestaciones = {
    "1": {
        "min": 40,
        "max": 80
    }
}

var tabla = $('#tabla_historico_sub').DataTable(defs_datatable);

var concentrado = [];
var datos_contenedor = [];

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
                    "permisos": "('HISTORICOSUBESTACIONIXTLAHUACA')"
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
                    if (res.length) {
                        $.each(res, (key, value) => {

                            if (value.permiso == "HISTORICOSUBESTACIONIXTLAHUACA") {
                                $("#subestacion_id [value='1']").attr("disabled", false);
                            }

                        });
                        $("#subestacion_id > option").each(function () {
                            if ($("#subestacion_id [value='" + this.value + "']").attr("disabled") == 'disabled')
                                $("#subestacion_id [value='" + this.value + "']").remove();
                            $('#subestacion_id').trigger('change.select2');
                        });

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

    $('#subestacion_id').select2(defs_select2);
    $('#fecha_hora_programada').select2(defs_select2);

    $("#subestacion_id").trigger('change');

    $('.dataTables_wrapper').find("select").formSelect();

    $("#excel").click(function () {
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
});

$("#ayuda").click(function () {
    introJs().start();
});

$('#form_historico_subestacion').submit((e) => {

    e.preventDefault();

    if (tiposubmit == 1) {

        var subestacion_id = document.getElementById('subestacion_id');
        sub_id = subestacion_id.value;
        var rango_fechas = $("#daterange_historico").val();
        var fecha_inicial = rango_fechas.substring(0, rango_fechas.indexOf("/"));
        var fecha_final = rango_fechas.substring(rango_fechas.indexOf("/") + 1, rango_fechas.length);

        //console.log(subestacion_id.value);

        swal({
            title: 'CARGANDO',
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
                var formulario = $(e.currentTarget).serializeArray();

                //console.log(formulario);
                $.ajax({
                    url: serverurl + "ajax/histSubAjax.php",
                    method: "post",
                    data: { "fecha_hora_inicial": fecha_inicial, "fecha_hora_final": fecha_final, "subestacion_id": sub_id, "accion": "CONSULTA" },

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
                        //console.log(res);
                        swal.close();
                        res = JSON.parse(res);

                        //console.log(res);
                        if (res.length) {
                            var $el = $("#hora_programada");

                            tabla.clear().draw();
                            datos_contenedor = [];
                            $.each(res, function (key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos

                                subestacion = value.subestacion;
                                fecha_hora_programada = value.fecha_hora_programada;
                                amperaje = value.amperaje;
                                transmite = value.transmite;
                                novedades = value.sub_novedades;
                                var fecha_epoch = moment(fecha_hora_programada).format('x');
                                datos_contenedor.push([parseInt(fecha_epoch), parseInt(amperaje)]);
                                addRow();

                            });
                            console.log(datos_contenedor);
                            grafica();
                            tabla.columns.adjust().draw(); // Redraw the DataTable

                            $el.empty(); //Se vacia la lista de opciones de articulos para volverla a formar
                            $.each(res.fechas_restantes, function (key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos

                                $el.append($("<option></option>").attr("value", value).text(value));

                            });

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

        var subestacion_id = document.getElementById('subestacion_id');
        var subestacion_text = subestacion_id.options[subestacion_id.selectedIndex].text.replace(" ", "_");
        //console.log(subestacion_text);
        var rango_fechas = $("#daterange_historico").val();
        var fecha_inicial = rango_fechas.substring(0, rango_fechas.indexOf("/"));
        var fecha_final = rango_fechas.substring(rango_fechas.indexOf("/") + 1, rango_fechas.length);

        $.ajax({
            url: serverurl + "ajax/histSubAjax.php",
            method: "post",
            data: {
                "fecha_hora_inicial": fecha_inicial,
                "fecha_hora_final": fecha_final,
                "subestacion_id": subestacion_id.value,
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

                    excel(subestacion_text, fecha_inicial, fecha_final);
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

function addRow() {

    tabla.row.add([
        "<input type='hidden'  value =" + (tabla.page.info().recordsTotal + 1) + ">" + (tabla.page.info().recordsTotal + 1),
        '<input type="hidden"  value ="' + subestacion + '">' + subestacion,
        '<input type="hidden"  value ="' + fecha_hora_programada + '">' + fecha_hora_programada,
        '<input type="hidden"  value ="' + amperaje + '">' + amperaje,
        '<input type="hidden"  value ="' + transmite + '">' + transmite,
        '<input type="hidden"  value ="' + novedades + '">' + novedades
    ]).draw();

    $('#submit').prop("disabled", false);

}

function excel(subestacion_text, fecha_inicial, fecha_final) {

    var data = [];

    $.each(concentrado, function (key, value) {

        data.push({
            "Subestacion": value.subestacion,
            "Hora Programada": value.fecha_hora_programada,
            "amperaje": parseFloat(value.amperaje).toFixed(decimalsPlaces),
            "Transmite": value.transmite,
            "Observaciones": value.sub_novedades
        });

    });

    /* this line is only needed if you are not adding a script tag reference */
    if (typeof XLSX == 'undefined') XLSX = require('xlsx');

    /* make the worksheet */
    var ws = XLSX.utils.json_to_sheet(data);

    /* add to workbook */
    var wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Subestacion");

    /* write workbook (use type 'binary') */
    var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });

    /* generate a download */
    function s2ab(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i = 0; i != s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
        return buf;
    }

    saveAsCustom(new Blob([s2ab(wbout)], { type: "application/octet-stream" }), "HISTORICO_SUBESTACION_" + subestacion_text +"_"+ fecha_inicial+"_"+fecha_final+ ".xlsx");
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
                //day: '%e of %b'
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
    Highcharts.chart('grafica_subestaciones', {
        title: {
            text: 'Amperaje en ' + subestacion + ' '
        },
        subtitle: {
            text: ''
        },
        legend: {
            enabled: false
        },
        series: [{
            type: 'line',
            name: 'Amperaje',
            data: datos_contenedor
        }],
        yAxis: [{
            title: {
                text: 'Amperaje [A]'
            },
            min: 0,
            max: 100,
            plotLines: [{
                color: '#FF0000',
                width: 2,
                value: info_subestaciones[sub_id].max,
                label: {
                    text: 'Amperaje Maximo: 80 A',
                    align: 'center',
                    style: {
                        color: 'gray'
                    }
                }
            },
            {
                color: '#0000FF',
                width: 2,
                value: info_subestaciones[sub_id].min,
                label: {
                    text: 'Amperaje Minimo: 40 A',
                    align: 'center',
                    style: {
                        color: 'gray'
                    }
                }
            }
            ],
            opposite: false
        }],
        tooltip: {
            shared: true,
            valueSuffix: ' A'
        }
    });
}
