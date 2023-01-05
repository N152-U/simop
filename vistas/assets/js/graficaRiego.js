const decimalsPlaces = 2;
defs_datatable.order = false;
defs_datatable.paging = false;
defs_datatable.pageLength = false;
defs_datatable.searching = false;
defs_datatable.lengthChange = false;

var tabla = $("#tabla_captura").DataTable(defs_datatable);

var gasto = "0";

var defs_select2 = {
    placeholder: "Selecciona una opción",
    language: {
        noResults: function(params) {
            return "No se encontraron resultados";
        },
    },
};

var locale = {
    format: "YYYY-MM-DD H:mm",
    separator: " / ",
    applyLabel: "ACEPTAR",
    cancelLabel: "CANCELAR",
    fromLabel: "De",
    toLabel: "Hasta",
    customRangeLabel: "Custom",
    weekLabel: "W",
    daysOfWeek: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
    monthNames: [
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
        "Diciembre",
    ],
    firstDay: 1,
};


$(document).ready(() => {
    //Grafica Vacia
    new Highcharts.chart("grafica_comparativa_tablero_totales", {
        chart: {
            type: "column",
            /* options3d: {
                      enabled: true,
                      alpha: 15,
                      beta: 0,
                      viewDistance: 25,
                      depth: 40
                  } */
        },

        title: {
            text: "Grafica de Riego Sistema Lerma",
        },

        series: [],
    });

    new Highcharts.chart("grafica_comparativa_tablero_promedios", {
        chart: {
            type: "column",
            /*  options3d: {
                       enabled: true,
                       alpha: 15,
                       beta: 0,
                       viewDistance: 25,
                       depth: 40
                   } */
        },

        title: {
            text: "Grafica de Riego Sistema Lerma",
        },

        series: [],
    });




    $("#daterange_horas_reporte_sistemas").daterangepicker({
            autoUpdateInput: true,
            forceUpdate: true,
            callbackAtInit: false,
            singleMultiHourDatePicker: false,
            opens: "center",
            showDropdowns: true,
            timePicker: true,
            startDate: moment().startOf("day"),
            endDate: moment(),
            maxDate: moment().endOf("day"),
            minYear: 1999,
            maxYear: moment().year(),
            timePicker24Hour: true,
            locale: locale,
        },
        function(start, end, label) {
            $("#submit").trigger("click");
            // + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        }
    );

    $("#daterange_diario_reporte_sistemas").daterangepicker({
            autoUpdateInput: true,
            forceUpdate: true,

            opens: "center",
            showDropdowns: true,
            startDate: moment().subtract(1, "day").startOf("day"),
            endDate: moment().subtract(1, "day").startOf("day").add(23, "hour"),
            minYear: 1999,
            maxYear: moment().year(),
            maxDate: moment().subtract(1, "day").startOf("day").add(23, "hour"),
            timePicker24Hour: true,
            locale: locale,
        },
        function(start, end, label) {
            // + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        }
    );

    $("#daterange_meses_reporte_sistemas").daterangepicker({
            monthDatePicker: true,
            autoUpdateInput: true,
            forceUpdate: true,
            opens: "center",
            showDropdowns: true,
            startDate: moment().subtract(2, "month").startOf("month"),
            endDate: moment().subtract(1, "month").endOf("month"),
            maxDate: moment().subtract(1, "month").endOf("month"),
            timePicker24Hour: true,
            minYear: 1999,
            maxYear: moment().year(),
            locale: locale,
        },
        function(start, end, label) {
            // + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        }
    );
    //.endOf("year"));
    $("#daterange_anios_reporte_sistemas").daterangepicker({
            yearsDatePicker: true,
            autoUpdateInput: true,
            forceUpdate: true,
            callbackAtInit: true,
            opens: "center",
            showDropdowns: true,
            startDate: moment().subtract(1, "year").startOf("year"),
            endDate: moment().subtract(1, "year").endOf("year"),
            maxDate: moment().subtract(1, "year").endOf("year"),
            timePicker24Hour: true,
            minYear: 1999,
            maxYear: moment().year(),
            locale: locale,
        },
        function(start, end, label) {
            // + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        }
    );

    $("#tabs_graficas_comparativas").tabs({
        onShow() {
            $("#grafica_comparativa_tablero_totales").highcharts().reflow();
            /* $("#grafica_comparativa_tablero_promedios").highcharts().reflow(); */
        },
    });

    (function(H) {
        //    console.log(window.zipcelx)
        if (window.zipcelx && H.getOptions().exporting) {
            H.Chart.prototype.downloadXLSX = function() {
                var div = document.createElement("div"),
                    name,
                    xlsxRows = [],
                    rows;
                div.style.display = "none";
                document.body.appendChild(div);
                rows = this.getDataRows(true);
                xlsxRows = rows.slice(1).map(function(row) {
                    return row.map(function(column) {
                        return {
                            type: typeof column === "number" ? "number" : "string",
                            value: column,
                        };
                    });
                });

                // Get the filename, copied from the Chart.fileDownload function
                if (this.options.exporting.filename) {
                    name = this.options.exporting.filename;
                } else if (this.title && this.title.textStr) {
                    name = this.title.textStr.replace(/ /g, "-").toLowerCase();
                } else {
                    name = "chart";
                }

                window.zipcelx({
                    filename: name,
                    sheet: {
                        data: xlsxRows,
                    },
                });
            };

            // Default lang string, overridable in i18n options
            H.getOptions().lang.downloadXLSX = "Descargar archivo XLSX";

            // Add the menu item handler
            H.getOptions().exporting.menuItemDefinitions.downloadXLSX = {
                textKey: "downloadXLSX",
                onclick: function() {
                    this.downloadXLSX();
                },
            };

            // Replace the menu item
            var menuItems = H.getOptions().exporting.buttons.contextButton.menuItems;
            menuItems[menuItems.indexOf("downloadXLS")] = "downloadXLSX";
        }
    })(Highcharts);
});





  
    const valores = window.location.search;
    const urlParams = new URLSearchParams(valores);
    var anio = urlParams.get("anio");

    //console.log(formulario);
    ////
    swal({
      
        onOpen: () => {
            swal.showLoading();

            //Añadimos el parametro para la accion que tomara del modelo
            $.ajax({
                //url: serverurl + "/vistas/assets/js/data.json",

                url: serverurl + "ajax/graficaRiegoAjax.php",
                method: "post",
                data: {

                    anio: anio,
                    accion: "CONSULTA",
                },

                error: function(error) {
                    //Se activa cuando se termina el tiempo de espera
                    //
                    // swal.close();
                    swal({
                        type: "error",
                        title: "El tiempo de espera se ha agotado",
                        showConfirmButton: true,
                        allowOutsideClick: false,
                    }).then(function() {});
                },
                success: function(res) {
                    //console.log("sql",res)
                    res = JSON.parse(res);

                    graficaComparativa(res, "grafica_comparativa_tablero_totales");
                    /*   graficaComparativa(res, "grafica_comparativa_tablero_promedios"); */
                    swal.close();
                },
                timeout: 5000,
            });
        },
    });


//Grafica con Datos
function graficaComparativa(data_util, element) {
    var index = 0;
    var data_series = [];
    var data_xAxis = [];
    if (element == "grafica_comparativa_tablero_totales") {
        title_text = "Grafica de Riego  Sistema Lerma ";
        title_text_yAxis = "Gasto en I.p.s.";
        $.each(data_util, (key_year, value) => {

            subdata = data_util[key_year]

            $.each(data_util[key_year], (key_serie, value) => {
                /*console.log("subdata", data_util[key][key2]);
                console.log("key", data_util[key])*/
                data_series.push(
                    new Object({ name: data_util[key_year][key_serie]["name"], id: key_year, data: new Array() })
                );

                $.each(data_util[key_year][key_serie], (key, value) => {
                    //  console.log("subdatados", key); //Valores

                    data_xAxis[key] = value.name;
                    //console.log("valores", value.name); //año
                    data_series[index].data.push([
                        parseFloat(parseFloat(value.y).toFixed(decimalsPlaces)),
                    ]);
                });
                index++;
            });

        });





    }

    options = {
        credits: {
            enabled: false,
        },
        lang: {
            drillUpText: "< Regresar {series.name}",
            loading: "Cargando...",
            months: [
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
                "Diciembre",
            ],
            weekdays: [
                "Domingo",
                "Lunes",
                "Martes",
                "Miércoles",
                "Jueves",
                "Viernes",
                "Sábado",
            ],
            shortMonths: [
                "Ene",
                "Feb",
                "Mar",
                "Abr",
                "May",
                "Jun",
                "Jul",
                "Ago",
                "Sep",
                "Oct",
                "Nov",
                "Dic",
            ],
            viewFullscreen: "Ver pantalla completa",
            viewData: "Ver datos en tabla",
            exportButtonTitle: "Exportar",
            printButtonTitle: "Importar",
            rangeSelectorFrom: "Desde",
            rangeSelectorTo: "Hasta",
            rangeSelectorZoom: "Período",
            downloadPNG: "Descargar imagen PNG",
            downloadJPEG: "Descargar imagen JPEG",
            downloadPDF: "Descargar imagen PDF",
            downloadSVG: "Descargar imagen SVG",
            downloadCSV: "Descargar archivo CSV",
            downloadXLS: "Descargar archivo XLS",
            printChart: "Imprimir",
            resetZoom: "Reiniciar zoom",
            resetZoomTitle: "Reiniciar zoom",
            thousandsSep: ",",
            decimalPoint: ".",
        },
        title: {
            text: title_text,
        },
        chart: {
            zoomType: "x",
        },


        xAxis: {
            type: "category",
            categories: data_xAxis,
        },
        yAxis: {
            title: {
                text: title_text_yAxis,
            },
        },
        legend: {
            enabled: false,
        },
        legend: {
            layout: "vertical",
            align: "right",
            verticalAlign: "middle",
        },
        series: data_series,
        tooltip: {
            shared: false,
            pointFormat: "{point.y:.2f} L/s",
        },
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500,
                },
                chartOptions: {
                    legend: {
                        layout: "horizontal",
                        align: "center",
                        verticalAlign: "bottom",
                    },
                },
            }, ],
        },
        exporting: {
            tableDecimalPoint: ".", // "." or ","
            tableDecimalValue: 2,
        },
    };
    //console.log(element)
    chart = new Highcharts.chart(element, options);
}