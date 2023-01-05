const timezone = new Date().getTimezoneOffset();

var defs_select2 = {
    placeholder: 'Selecciona una opción',
    language: {
        noResults: function (params) {

            return "No se encontraron resultados";
        }
    }
};
var grafica;
var nombre,propiedad,bomba,fecha_bitacora,valor_bitacora,unidades_bitacora,fecha_scada,valor_scada,unidades_scada;
var tabla = $('#tabla_comparacion_scada').DataTable(defs_datatable);
Highcharts.setOptions({
    lang: {
        loading: 'Cargando...',
        months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        weekdays: ['Domingo', 'Lunes', 'Martes', 'MiÃ©rcoles', 'Jueves', 'Viernes', 'SÃ¡bado'],
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
        contextButtonTitle: 'Menu grÃ¡fica',
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
    yAxis: {
        min: 0,
        labels: {
            format: '{value} m'
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
                },
                navigator: {
                    enabled: false
                }
            }
        }]
    }, credits: {
        enabled: false
    },
    exporting: {
        csv:{
            decimalPoint:"."
        }
    }
});

$(document).ready(function () {




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


    Highcharts.chart("grafica_comparativa_scada", {
        chart: {
            type: 'line',
            /* options3d: {
                enabled: true,
                alpha: 15,
                beta: 0,
                viewDistance: 25,
                depth: 40
            } */
        },

        title: {
            text: 'Gráfica Comparativa de Bitacora y Scada'
        },


        series: []
    });


    $('#tabla_comparativo').select2(defs_select2);
    //$("#tabla_comparativo").trigger('change');
    $('#registro_id').select2(defs_select2);
    $("#registro_id").empty();
    //$("#registro_id").trigger('change');
    $("#registro_id").prop("disabled", true);
    $('#propiedad_id').select2(defs_select2);
    $("#propiedad_id").empty();
    //$("#propiedad_id").trigger('change');
    $("#propiedad_id").prop("disabled", true);
    $.ajax({
        url: serverurl + "ajax/comparativoScadaAjax.php",
        method: "post",
        data: {
            "accion": "CONSULTAR"
        },
        success: function (res) {
            res = JSON.parse(res);
            tabla.clear().draw();
            console.log(res);
            $.each(res, function (key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos

                nombre = value.nombre;
                propiedad = value.propiedad;
                fecha_bitacora = value.fecha_bitacora;
                valor_bitacora = parseFloat(value.valor_bitacora).toFixed(3);
                unidades_bitacora = value.unidades_bitacora;
                fecha_scada = value.fecha_scada;
                valor_scada = parseFloat(value.valor_scada).toFixed(3);
                unidades_scada = value.unidades_scada;
                //console.log(moment(value.fecha_scada).format('dddd, MMMM Do, YYYY h:mm:ss A'));

                addRow();

            });
            tabla.columns.adjust().draw(); // Redraw the DataTable

        }

    });
    $('#daterange_scada').daterangepicker({
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


$("#tabla_comparativo").change(function () {
    $("#propiedad").val("");
    $("#registro_id").empty();
    $("#propiedad_id").empty();
    $("#registro_id").prop("disabled", false);
    $("#propiedad_id").prop("disabled", true);

    console.log($("#tabla_comparativo").val());
    //
    $.ajax({
        url: serverurl + "ajax/comparativoScadaAjax.php",
        method: "post",
        data: {
            "accion": "OBTENER_REGISTROS",
            "tabla": $("#tabla_comparativo").val(),
        },
        success: function (res) {
            console.log(res);
            res = JSON.parse(res);
            $("#registro_id").append($("<option></option>")).prop("selected", true).prop("disabled", false);
            if (res.length > 0) {
                $.each(res, function (key, value) {
                    $("#registro_id").append($("<option></option>")
                        .attr("value", value["registro_id"]).text(value["nombre"])).prop("disabled", false);
                });
            }
        }
    });

});

$("#registro_id").change(function () {
    $("#propiedad").val("");
    $("#propiedad_id").prop("disabled", false);
    $("#propiedad_id").empty();
    $.ajax({
        url: serverurl + "ajax/comparativoScadaAjax.php",
        method: "post",
        data: {
            "accion": "OBTENER_PROPIEDADES",
            "tabla": $("#tabla_comparativo").val(),
            "registro_id": $("#registro_id").val()
        },
        success: function (res) {
            console.log(res);
            res = JSON.parse(res);
            $("#propiedad_id").append($("<option></option>")).prop("selected", true).prop("disabled", false);
            if (res.length > 0) {
                $.each(res, function (key, value) {
                    $("#propiedad_id").append($("<option></option>")
                        .attr("value", value["gateId"]).text(value["propiedad"])).prop("disabled", false);
                });
            }
        }
    });
});

$("#propiedad_id").change(function () {
    $("#propiedad").val($("#propiedad_id").text());
    console.log($("#propiedad").val());
});

$("form").on("submit", function (e) {
    e.preventDefault();

    var formulario = $(e.currentTarget).serializeArray(); //Convierte a los campos que forman parte del formulario en un arreglo indexado
    //console.log(formulario);
    var rango_fechas = formulario[4].value;
    var propiedad = formulario[0].value;
    var tabla_comparativa = formulario[1].value;
    var gateId = formulario[3].value;
    var registro_id = formulario[2].value;

    fecha_hora_inicial = rango_fechas.substring(0, rango_fechas.indexOf("/")).trim();
    fecha_hora_final = rango_fechas.substring(rango_fechas.indexOf("/") + 1, rango_fechas.length).trim();

    ////
    /*     swal({
            title: 'CARGANDO',
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
     */
    //Añadimos el parametro para la accion que tomara del modelo
    $.ajax({
        //url: serverurl + "/vistas/assets/js/data.json",
        url: serverurl + "ajax/comparativoScadaAjax.php",
        method: "post",
        timeout: 5000,
        //dataType: "json",
        data: {
            "fecha_hora_inicial": fecha_hora_inicial,
            "fecha_hora_final": fecha_hora_final,
            "propiedad": propiedad,
            "tabla_comparativa": tabla_comparativa,
            "gateId": gateId,
            "registro_id": registro_id,
            "accion": "CONSULTAR_COMPARATIVO"
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

            try {

                res = JSON.parse(res);
                console.log(res);
                var simop_data = [];
                var scada_data = [];
                $.each(res.simop, (_key, value) => {
                    simop_data.push([parseInt(value.fecha), parseFloat(value.propiedad)]);
                });
                $.each(res.scada, (_key, value) => {
                    scada_data.push([parseInt(value.fecha), parseFloat(value.propiedad)]);
                });

                $('.highcharts-data-table').remove();
                Highcharts.chart('grafica_comparativa_scada', {

                    title: {
                        text: "Gráfica Comparativa de Bitacora y Scada"
                    },
                    subtitle: {
                        text: fecha_hora_inicial + ' / ' + fecha_hora_final
                    },

                    yAxis: {
                        title: {
                            text: propiedad
                        }
                    },

                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle'
                    },
                    series: [{
                        name: 'Bitacora',
                        data: simop_data,
                        type: 'spline',
                        dashStyle: 'shortdot',
                        threshold: null,
                        tooltip: {
                            valueDecimals: 3

                        },
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        }
                    }, {
                        name: 'Scada',
                        data: scada_data,
                        type: 'spline',
                        dashStyle: 'shortdot',
                        threshold: null,
                        tooltip: {
                            valueDecimals: 3

                        },
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[1]],
                                [1, Highcharts.color(Highcharts.getOptions().colors[1]).setOpacity(0).get('rgba')]
                            ]
                        }
                    }],
                    tooltip: {
                        shared: true
                    },
                })
            }
            catch (e) {
            }


        }
    });
    /*         }
        }); */



});

function addRow() {

    tabla.row.add([
        "<input type='hidden'  value =" + (tabla.page.info().recordsTotal + 1) + ">" + (tabla.page.info().recordsTotal + 1),
        '<input  type="hidden"  value ="' + nombre + '">' + nombre,
        '<input type="hidden"   value ="' + propiedad + '">' + propiedad,
        '<input type="hidden"   value ="' + fecha_bitacora + '">' + fecha_bitacora,
        '<input type="hidden"   value ="' + valor_bitacora + '">' + valor_bitacora + " "+unidades_bitacora,
        '<input type="hidden"   value ="' + fecha_scada + '">' + fecha_scada,
        '<input type="hidden"   value ="' + valor_scada + '">' + valor_scada + " "+unidades_scada,

    ]).draw();        
}
