const decimalsPlaces = 2;
var defs_select2 = {
    language: {
        noResults: function(params) {
            return "No se encontraron resultados";
        }
    }
};
var locale = {
    "format": 'YYYY-MM-DD H:mm',
    "separator": " / ",
    "applyLabel": "ACEPTAR",
    "cancelLabel": "CANCELAR",
    "fromLabel": "De",
    "toLabel": "Hasta",
    "customRangeLabel": "Custom",
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
};


var fecha_hora_inicial;
var fecha_hora_final;


$(document).ready(() => {

    new Highcharts.chart("grafica_comparativa_tablero_totales", {
        chart: {
            type: 'column',
            /* options3d: {
                enabled: true,
                alpha: 15,
                beta: 0,
                viewDistance: 25,
                depth: 40
            } */
        },

        title: {
            text: 'Gráfica Comparativa de Acumulados en Puntos'
        },


        series: []
    });


    new Highcharts.chart("grafica_comparativa_tablero_promedios", {
        chart: {
            type: 'column',
            /*  options3d: {
                 enabled: true,
                 alpha: 15,
                 beta: 0,
                 viewDistance: 25,
                 depth: 40
             } */
        },

        title: {
            text: 'Gráfica Comparativa de Promedios en Puntos'
        },


        series: []
    });


    $("#intervalo_id").select2(defs_select2);

    $("#intervalo_id").trigger("change");

    $('#daterange_horas_reporte_sistemas').daterangepicker({
        autoUpdateInput: true,
        forceUpdate: true,
        callbackAtInit: false,
        singleMultiHourDatePicker: false,
        opens: 'center',
        showDropdowns: true,
        timePicker: true,
        startDate: moment().startOf('day'),
        endDate: moment(),
        maxDate: moment().endOf('day'),
        minYear: 1999,
        maxYear: moment().year(),
        timePicker24Hour: true,
        locale: locale
    }, function(start, end, label) {
        $("#submit").trigger("click")
            // + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });




    $('#daterange_diario_reporte_sistemas').daterangepicker({
        autoUpdateInput: true,
        forceUpdate: true,

        opens: 'center',
        showDropdowns: true,
        startDate: moment().subtract(1, 'day').startOf('day'),
        endDate: moment().subtract(1, 'day').startOf('day').add(23, 'hour'),
        minYear: 1999,
        maxYear: moment().year(),
        maxDate: moment().subtract(1, 'day').startOf('day').add(23, 'hour'),
        timePicker24Hour: true,
        locale: locale
    }, function(start, end, label) {
        // + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });

    $('#daterange_meses_reporte_sistemas').daterangepicker({
        monthDatePicker: true,
        autoUpdateInput: true,
        forceUpdate: true,
        opens: 'center',
        showDropdowns: true,
        startDate: moment().subtract(2, 'month').startOf("month"),
        endDate: moment().subtract(1, 'month').endOf('month'),
        maxDate: moment().subtract(1, 'month').endOf('month'),
        timePicker24Hour: true,
        minYear: 1999,
        maxYear: moment().year(),
        locale: locale
    }, function(start, end, label) {
        // + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });
    //.endOf("year"));
    $('#daterange_anios_reporte_sistemas').daterangepicker({
        yearsDatePicker: true,
        autoUpdateInput: true,
        forceUpdate: true,
        callbackAtInit: true,
        opens: 'center',
        showDropdowns: true,
        startDate: moment().subtract(1, 'year').startOf("year"),
        endDate: moment().subtract(1, 'year').endOf("year"),
        maxDate: moment().subtract(1, 'year').endOf('year'),
        timePicker24Hour: true,
        minYear: 1999,
        maxYear: moment().year(),
        locale: locale
    }, function(start, end, label) {
        // + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });

    $('#tabs_graficas_comparativas').tabs({
        onShow() {

            $('#grafica_comparativa_tablero_totales').highcharts().reflow();
            $('#grafica_comparativa_tablero_promedios').highcharts().reflow();

        }
    });

    (function(H) {
        //    console.log(window.zipcelx)
        if (window.zipcelx && H.getOptions().exporting) {

            H.Chart.prototype.downloadXLSX = function() {
                var div = document.createElement('div'),
                    name,
                    xlsxRows = [],
                    rows;
                div.style.display = 'none';
                document.body.appendChild(div);
                rows = this.getDataRows(true);
                xlsxRows = rows.slice(1).map(function(row) {
                    return row.map(function(column) {
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
                onclick: function() {
                    this.downloadXLSX();
                }
            };

            // Replace the menu item
            var menuItems = H.getOptions().exporting.buttons.contextButton.menuItems;
            menuItems[menuItems.indexOf('downloadXLS')] = 'downloadXLSX';
        }

    }(Highcharts));

})






$("#intervalo_id").change(function(e) {
    $("#daterange_horas_reporte_sistemas").hide();
    $("#daterange_horas_reporte_sistemas").prop("disabled", true);
    $("#daterange_diario_reporte_sistemas").hide();
    $("#daterange_diario_reporte_sistemas").prop("disabled", true);
    $("#daterange_meses_reporte_sistemas").hide();
    $("#daterange_meses_reporte_sistemas").prop("disabled", true);
    $("#daterange_anios_reporte_sistemas").hide();
    $("#daterange_anios_reporte_sistemas").prop("disabled", true);

    switch (parseInt(e.target.value)) {
        case 1:

            $("#daterange_horas_reporte_sistemas").show();
            $("#daterange_horas_reporte_sistemas").prop("disabled", false);

            break;

        case 2:

            $("#daterange_diario_reporte_sistemas").show();
            $("#daterange_diario_reporte_sistemas").prop("disabled", false);

            break;

        case 3:

            $("#daterange_meses_reporte_sistemas").show();
            $("#daterange_meses_reporte_sistemas").prop("disabled", false);

            break;

        case 4:

            $("#daterange_anios_reporte_sistemas").show();
            $("#daterange_anios_reporte_sistemas").prop("disabled", false);

            break;

        default:
            break;
    }
});


$("form").on("submit", function(e) {
    e.preventDefault();
    var formulario = $(e.currentTarget).serializeArray(); //Convierte a los campos que forman parte del formulario en un arreglo indexado
    var rango_fechas = formulario[1].value;
    fecha_hora_inicial = rango_fechas.substring(0, rango_fechas.indexOf("/")).trim();
    fecha_hora_final = rango_fechas.substring(rango_fechas.indexOf("/") + 1, rango_fechas.length).trim();
    var intervalo_id = formulario[0].value;
    //console.log(formulario);
    ////
    swal({
        title: 'CARGANDO',
        allowEscapeKey: false,
        allowOutsideClick: false,
        onOpen: () => {
            swal.showLoading();

            //Añadimos el parametro para la accion que tomara del modelo
            $.ajax({
                //url: serverurl + "/vistas/assets/js/data.json",
                url: serverurl + "ajax/tableroAjax.php",
                method: "post",
                data: { "intervalo_id": intervalo_id, "fecha_hora_inicial": fecha_hora_inicial, "fecha_hora_final": fecha_hora_final, "puntos": "('VENTURYII','VENTURYIII','ALZATE','ATARASQUILLO','VENADO','DOLORES','CAIDA DEL BORRACHO')", "accion": "CONSULTA" },
                error: function(error) {
                    //Se activa cuando se termina el tiempo de espera
                    //
                    // swal.close();
                    
                    swal({
                        type: "error",
                        title: "El tiempo de espera se ha agotado",
                        showConfirmButton: true,
                        allowOutsideClick: false
                    }).then(function() {

                    });
                },
                success: function(res) {

                    res = JSON.parse(res);
                    console.log("Respu",res)
                    //console.log(res.length)

                    graficaCompartiva(res, "grafica_comparativa_tablero_totales");
                    graficaCompartiva(res, "grafica_comparativa_tablero_promedios");
                    swal.close();


                },
                timeout: 5000
            })
        }
    });
});



function graficaCompartiva(data_util, element) {

    var index = 0;
    var data_series = [];
    var data_xAxis = [];
    console.log("Ejemplo",data_util)
    if (element == "grafica_comparativa_tablero_totales") {
        title_text = 'Gráfica Comparativa de Acumulados en Puntos'
        title_text_yAxis = 'Gasto Total Acumulado (L/s)';
        $.each(data_util, (key, value) => {

                subdata = data_util[key]["data_util_acumulados_gasto"];
                data_series.push(new Object({ name: key, id: key, data: new Array() }));

                $.each(subdata, (key, value) => {
                    console.log(key)
                    console.log(value)
                    data_xAxis[key] = value.name;
                    data_series[index].data.push([parseFloat(parseFloat(value.y).toFixed(decimalsPlaces))])
                })
                index++;
            })
            // console.log(data_xAxis)
            //  console.log(data_series)
    } else if (element == "grafica_comparativa_tablero_promedios") {
        title_text = 'Gráfica Comparativa de Promedios en Puntos'
        title_text_yAxis = 'Gasto Promedio (L/s)';
        $.each(data_util, (key, value) => {

                subdata = data_util[key]["data_util_promedios_gasto"];
                data_series.push(new Object({ name: key, id: key, data: new Array() }));

                $.each(subdata, (key, value) => {
                    //console.log(key)
                    data_xAxis[key] = value.name;
                    data_series[index].data.push([parseFloat(parseFloat(value.y).toFixed(decimalsPlaces))])
                })
                index++;
            })
            /* console.log(data_xAxis)
            console.log(data_series) */
    }

    options = {
        credits: {
            enabled: false
        },
        lang: {
            drillUpText: '< Regresar {series.name}',
            loading: 'Cargando...',
            months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            shortMonths: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            viewFullscreen: "Ver pantalla completa",
            viewData: "Ver datos en tabla",
            exportButtonTitle: "Exportar",
            printButtonTitle: "Importar",
            rangeSelectorFrom: "Desde",
            rangeSelectorTo: "Hasta",
            rangeSelectorZoom: "Período",
            downloadPNG: 'Descargar imagen PNG',
            downloadJPEG: 'Descargar imagen JPEG',
            downloadPDF: 'Descargar imagen PDF',
            downloadSVG: 'Descargar imagen SVG',
            downloadCSV: 'Descargar archivo CSV',
            downloadXLS: 'Descargar archivo XLS',
            printChart: 'Imprimir',
            resetZoom: 'Reiniciar zoom',
            resetZoomTitle: 'Reiniciar zoom',
            thousandsSep: ",",
            decimalPoint: '.'
        },
        title: {
            text: title_text
        },
        chart: {
            zoomType: 'x'
        },

        subtitle: {
            text: fecha_hora_inicial + ' / ' + fecha_hora_final
        },

        xAxis: {
            type: 'category',
            categories: data_xAxis
        },
        yAxis: {
            title: {
                text: title_text_yAxis
            }

        },
        legend: {
            enabled: false
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        series: data_series,
        tooltip: {
            shared: false,
            pointFormat: '{point.y:.2f} L/s',

        },
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        },
        exporting: {
            tableDecimalPoint: ".", // "." or ","
            tableDecimalValue: 2
        }

    };
    //console.log(element)
    chart = new Highcharts.chart(element, options);
}