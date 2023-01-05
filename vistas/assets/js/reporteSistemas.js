const decimalsPlaces=2;
var defs_select2 = {
    language: {
        noResults: function (params) {
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
        zoomType: 'x'
    },
    tooltip: {
        followPointer: true
    },
    time: {
        //timezoneOffset: timezone
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
        // min: 0,
        labels: {
            format: '{value} mm'
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
    }
});
$(document).ready(() => {




    new Highcharts.chart("grafica_totales", {
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
            text: 'Gráfica de Acumulados Sistemas'
        },


        series: []
    });


    new Highcharts.chart("grafica_promedios", {
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
            text: 'Gráfica de Promedios Sistemas'
        },


        series: []
    });

    new Highcharts.chart("grafica_comparativa_totales", {
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
            text: 'Gráfica Comparativa de Acumulados Sistemas'
        },


        series: []
    });

    new Highcharts.chart("grafica_comparativa_promedios", {
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
            text: 'Gráfica Comparativa de Promedios Sistemas'
        },


        series: []
    });


    var fecha_hora_inicial_consulta;
    var fecha_hora_final_consulta;
    $.ajax({
        //url: serverurl + "/vistas/assets/js/data.json",
        url: serverurl + "ajax/reporteSistemasAjax.php",
        method: "post",
        //dataType: "json",
        data: { "tipo": "ultima_fecha", "accion": "CONSULTA" },
        error: function (error) {
            // will fire when timeout is reached
            //
            // swal.close();
            swal({
                type: "error",
                title: "Hubo un error al procesar el reporte",
                showConfirmButton: true,
                allowOutsideClick: false
            }).then(function () {

            });
        },
        success: function (res) {
            res = JSON.parse(res)
            fecha_hora_inicial_consulta = String(res);
            fecha_hora_final_consulta = String(res);

            $('#daterange_horas_reporte_sistemas').daterangepicker({
                autoUpdateInput: true,
                forceUpdate: true,
                singleMultiHourDatePicker: false,
                opens: 'center',
                showDropdowns: true,
                timePicker: true,
                startDate: moment(fecha_hora_inicial_consulta, locale.format).startOf('day'),
                endDate: moment(fecha_hora_final_consulta, locale.format).startOf('day'),
                maxDate: moment(fecha_hora_final_consulta).endOf('day'),
                minYear: 1999,
                maxYear: moment().year(),
                timePicker24Hour: true,
                locale: locale
            }, function (start, end, label) {
                // + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
            });
            $("#daterange_horas_reporte_sistemas").val(fecha_hora_inicial_consulta + " / " + fecha_hora_final_consulta)
            $("#submit").trigger("click")

        }
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
    }, function (start, end, label) {
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
    }, function (start, end, label) {
        // + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });
    //.endOf("year"));
    $('#daterange_anios_reporte_sistemas').daterangepicker({
        yearsDatePicker: true,
        autoUpdateInput: true,
        forceUpdate: true,
        callbackAtInit: false,
        opens: 'center',
        showDropdowns: true,
        startDate: moment().subtract(1, 'year').startOf("year"),
        endDate: moment().subtract(1, 'year').endOf("year"),
        maxDate: moment().subtract(1, 'year').endOf('year'),
        timePicker24Hour: true,
        minYear: 1999,
        maxYear: moment().year(),
        locale: locale
    }, function (start, end, label) {
        // + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });

    $("#intervalo_id").select2(defs_select2);

    $("#intervalo_id").trigger("change");


    $('#tabs_graficas').tabs({
        onShow() {

            $('#grafica_totales').highcharts().reflow();
            $('#grafica_promedios').highcharts().reflow();

        }
    });

    $('#tabs_graficas_comparativas').tabs({
        onShow() {

            $('#grafica_comparativa_totales').highcharts().reflow();
            $('#grafica_comparativa_promedios').highcharts().reflow();

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



})


$("#intervalo_id").change(function (e) {
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


//grafica3D("2020-03-26 00:00","2020-03-26 23:00","grafica_totales")

$("form").on("submit", function (e) {
    e.preventDefault();
    if (tiposubmit == 1) {

        var formulario = $(e.currentTarget).serializeArray(); //Convierte a los campos que forman parte del formulario en un arreglo indexado
        var rango_fechas = formulario[1].value;
        fecha_hora_inicial = rango_fechas.substring(0, rango_fechas.indexOf("/")).trim();
        fecha_hora_final = rango_fechas.substring(rango_fechas.indexOf("/") + 1, rango_fechas.length).trim();
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
                    url: serverurl + "ajax/reporteSistemasAjax.php",
                    method: "post",
                    //dataType: "json",
                    data: { "fecha_hora_inicial": fecha_hora_inicial, "fecha_hora_final": fecha_hora_final, "puntos": "('VENTURYII','VENTURYIII','ATARASQUILLO','VENADO')", "accion": "CONSULTA" },
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
                            //
                            //
                            var data_util_puntos = {};//Objeto que contendra toda la informacion util que necesitamos para los sistemas

                            /**********
                            Composicion de estructura para data_util_puntos
                            data_util: Object() - tendra como llaves principales las claves de los puntos involucrados en el reporte,
                            dentro de cada llave tendra sus datos relacionados:
                                            ->name: String() - nombre del agrupamiento (fecha_key)
                                            ->promedio: Int() - promedio del agrupado
                                            ->gasto: Int() - gasto del registro actual
                                            ->acumulado_promedio: Int() - suma del promedio actual con anterior n+(n-1)
                                            ->acumulado_gasto: Int() - suma del gasto actual con anterior n+(n-1)
                                            ->numero_registros: Int() - cuenta del consecutivo del registro
                            **********/

                            var data_util_sistemas = {};//Objeto que contendra toda la informacion util que necesitamos para su transformacion posterior en el graficamiento

                            /**********
                            Composicion de estructura para data_util_sistemas
                            data_util: Object() - tendra como llaves principales las claves de los sistemas involucrados en el reporte,
                            dentro de cada llave tendra sus datos relacionados:
                                            ->gasto_total_acumulado: Int() - nombre del agrupamiento (fecha_key)
                                            ->gasto_total_promedio: Int() - Sumatoria del total
                                            ->data_util_puntos_acumulados: Array({ "name": fecha_key, "y": calculoGastoAcumuladoSistema}) - Acumulados del gasto con calculos pertinentes, listo para graficar
                                            ->data_util_puntos_promedios: Array({ "name": fecha_key, "y": calculoGastoPromedioSistema}) - Promedios del gasto con calculos pertinentes, listo para graficar
                            **********/

                            data_util_sistemas["CL"] = { gasto_total_acumulado: 0, gasto_total_promedio: 0, data_util_puntos_acumulados: [], data_util_puntos_promedios: [] };
                            data_util_sistemas["T1"] = { gasto_total_acumulado: 0, gasto_total_promedio: 0, data_util_puntos_acumulados: [], data_util_puntos_promedios: [] };
                            data_util_sistemas["VENADO"] = { gasto_total_acumulado: 0, gasto_total_promedio: 0, data_util_puntos_acumulados: [], data_util_puntos_promedios: [] };
                            data_util_sistemas["LERMA"] = { gasto_total_acumulado: 0, gasto_total_promedio: 0, data_util_puntos_acumulados: [], data_util_puntos_promedios: [] };
                            data_util_sistemas["TUNEL"] = { gasto_total_acumulado: 0, gasto_total_promedio: 0, data_util_puntos_acumulados: [], data_util_puntos_promedios: [] };

                            ////


                            var formato;//Formato agrupador (dia, mes o año), ej: "YYYY-MM-DD"

                            switch (formulario[0].value) {
                                case "1":
                                    formato = "YYYY-MM-DD H:mm"
                                    break;
                                case "2":
                                    formato = "YYYY-MM-DD"
                                    break;
                                case "3":
                                    formato = "YYYY-MM"
                                    break;
                                case "4":
                                    formato = "YYYY"
                                    break;
                                default:
                                    break;
                            }
                            //
                            var divisor = 0;//Al terminar cada iteracion se utiliza el divisor para sacar el promedio del gasto
                            var divisor_ref = 0; //Referencia para saber cuando tiene que dividir

                            var fecha_key;//Fecha que servira como llave para guardar los registros de forma agrupada, ej: [2020-12-12]
                            var gasto;//Gasto en cada iteracion
                            var acumulado_promedio = 0;
                            var acumulado_gasto = 0;
                            var nombre_punto = "";
                            var alerta_datos = false;

                            console.log(res)
                            $.each(res, function (key, value) {


                                gasto = parseFloat(value.gasto);



                                if (key == 0 || nombre_punto != value.punto || (fecha_key != moment(value.hora_programada).format(formato) && key < res.length)) {

                                    if (nombre_punto != value.punto) {


                                        //)
                                        acumulado_promedio = 0;
                                        acumulado_gasto = 0;
                                        nombre_punto = value.punto
                                        aux = 0;



                                        data_util_puntos[nombre_punto] = new Object({ registros_agrupados_formato: {}, registros: Array() });



                                    }


                                    //
                                    fecha_key = moment(value.hora_programada).format(formato);
                                    //Determina el divisor en base a la fecha y el formato solicitado
                                    divisor = parseInt(calcularDivisor(fecha_key, formato));
                                    divisor_ref += divisor;


                                    //Inicializar para promedio si cambia la fecha
                                    data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key] = new Object({ "name": fecha_key, "promedio": 0, "gasto": 0, "acumulado_promedio": 0, "acumulado_gasto": 0, "numero_registros": 0 });

                                }

                                ////

                                acumulado_gasto += gasto;
                                data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key]["numero_registros"] += 1
                                data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key]["gasto"] += gasto
                                data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key]["promedio"] += gasto;
                                data_util_puntos[nombre_punto].registros.push(value);

                                ////
                                // //
                                //Obtener el promedio

                                if (((key + 1) % divisor_ref) === 0) {
                                    // console.log(divisor)
                                    // console.log(key)
                                    //console.log(divisor_ref)
                                    data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key]["promedio"] /= parseFloat(parseFloat(divisor).toFixed(decimalsPlaces));
                                    data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key]["acumulado_gasto"] = parseFloat(parseFloat(acumulado_gasto).toFixed(decimalsPlaces));
                                    acumulado_promedio += parseFloat(parseFloat(data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key]["promedio"]).toFixed(decimalsPlaces))
                                    data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key]["acumulado_promedio"] = parseFloat(parseFloat(acumulado_promedio).toFixed(decimalsPlaces));

                                    switch (nombre_punto) {
                                        case "VENTURYII":
                                            break;
                                        case "VENTURYIII":
                                            //Hasta tener los dos venturys

                                            //promedios sistema cl
                                            data_util_sistemas["CL"].data_util_puntos_promedios.push({ "name": fecha_key, "y": parseFloat(parseFloat(data_util_puntos["VENTURYII"].registros_agrupados_formato[fecha_key].promedio + data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key].promedio).toFixed(decimalsPlaces)), "reporte_id": value.reporte_id, "reporte_folio": value.reporte_folio, "reporte_fecha": value.reporte_fecha, "custom":{"tipos_afectacion": value.tipos_afectacion}});
                                            //acumulados gasto sistema cl
                                            data_util_sistemas["CL"].data_util_puntos_acumulados.push({ "name": fecha_key, "y": parseFloat(parseFloat(data_util_puntos["VENTURYII"].registros_agrupados_formato[fecha_key].acumulado_gasto + data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key].acumulado_gasto).toFixed(decimalsPlaces)), "reporte_id": value.reporte_id, "reporte_folio": value.reporte_folio, "reporte_fecha": value.reporte_fecha,  "custom":{"tipos_afectacion": value.tipos_afectacion} });
                                            //Gasto total acumulado y promedio del rango para el sistema
                                            data_util_sistemas["CL"].gasto_total_acumulado = data_util_puntos["VENTURYII"].registros_agrupados_formato[fecha_key].acumulado_gasto + data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key].acumulado_gasto;
                                            data_util_sistemas["CL"].gasto_total_promedio = (data_util_puntos["VENTURYII"].registros_agrupados_formato[fecha_key].acumulado_promedio + (data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key].acumulado_promedio)) / data_util_sistemas["CL"].data_util_puntos_promedios.length
                                            break;
                                        case "ATARASQUILLO":
                                            //promedios sistema t1
                                            data_util_sistemas["T1"].data_util_puntos_promedios.push({ "name": fecha_key, "y": parseFloat(parseFloat(data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key].promedio).toFixed(decimalsPlaces)), "reporte_id": value.reporte_id, "reporte_folio": value.reporte_folio, "reporte_fecha": value.reporte_fecha, "custom":{"tipos_afectacion": value.tipos_afectacion} });
                                            //acumulados gasto sistema t1
                                            data_util_sistemas["T1"].data_util_puntos_acumulados.push({ "name": fecha_key, "y": parseFloat(parseFloat(data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key].acumulado_gasto).toFixed(decimalsPlaces)), "reporte_id": value.reporte_id, "reporte_folio": value.reporte_folio, "reporte_fecha": value.reporte_fecha, "custom":{"tipos_afectacion": value.tipos_afectacion} });

                                            //Gasto total acumulado y promedio del rango para el sistema
                                            data_util_sistemas["T1"].gasto_total_acumulado = acumulado_gasto;
                                            // data_util_sistemas["T1"].gasto_total_promedio = acumulado_promedio;
                                            data_util_sistemas["T1"].gasto_total_promedio = (acumulado_promedio / data_util_sistemas["T1"].data_util_puntos_promedios.length);

                                            //promedios sistema lerma
                                            data_util_sistemas["LERMA"].data_util_puntos_promedios.push({ "name": fecha_key, "y": parseFloat(parseFloat(data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key].promedio - (data_util_puntos["VENTURYII"].registros_agrupados_formato[fecha_key].promedio + data_util_puntos["VENTURYIII"].registros_agrupados_formato[fecha_key].promedio)).toFixed(decimalsPlaces)), "reporte_id": value.reporte_id, "reporte_folio": value.reporte_folio, "reporte_fecha": value.reporte_fecha, "custom":{"tipos_afectacion": value.tipos_afectacion} })
                                            //acumulados gasto sistema lerma
                                            data_util_sistemas["LERMA"].data_util_puntos_acumulados.push({ "name": fecha_key, "y": parseFloat(parseFloat(data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key].acumulado_gasto - (data_util_puntos["VENTURYII"].registros_agrupados_formato[fecha_key].acumulado_gasto + data_util_puntos["VENTURYIII"].registros_agrupados_formato[fecha_key].acumulado_gasto)).toFixed(decimalsPlaces)), "reporte_id": value.reporte_id, "reporte_folio": value.reporte_folio, "reporte_fecha": value.reporte_fecha,  "custom":{"tipos_afectacion": value.tipos_afectacion}})

                                            //Gasto total acumulado y promedio del rango para el sistema
                                            data_util_sistemas["LERMA"].gasto_total_acumulado = data_util_sistemas["T1"].gasto_total_acumulado - data_util_sistemas["CL"].gasto_total_acumulado;
                                            data_util_sistemas["LERMA"].gasto_total_promedio = data_util_sistemas["T1"].gasto_total_promedio - data_util_sistemas["CL"].gasto_total_promedio;
                                            break;
                                        case "VENADO":
                                            //promedios sistema venado
                                            data_util_sistemas["VENADO"].data_util_puntos_promedios.push({ "name": fecha_key, "y": parseFloat(parseFloat(data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key].promedio).toFixed(decimalsPlaces)), "reporte_id": value.reporte_id, "reporte_folio": value.reporte_folio, "reporte_fecha": value.reporte_fecha,  "tipos_afectacion": value.tipos_afectacion, "custom":{"tipos_afectacion": value.tipos_afectacion} });
                                            //acumulados gasto sistema venado
                                            data_util_sistemas["VENADO"].data_util_puntos_acumulados.push({ "name": fecha_key, "y": parseFloat(parseFloat(data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key].acumulado_gasto).toFixed(decimalsPlaces)), "reporte_id": value.reporte_id, "reporte_folio": value.reporte_folio, "reporte_fecha": value.reporte_fecha,  "tipos_afectacion": value.tipos_afectacion, "custom":{"tipos_afectacion": value.tipos_afectacion} });

                                            //Gasto total acumulado y promedio del rango para el sistema
                                            data_util_sistemas["VENADO"].gasto_total_acumulado = acumulado_gasto;
                                            // data_util_sistemas["VENADO"].gasto_total_promedio = acumulado_promedio;
                                            data_util_sistemas["VENADO"].gasto_total_promedio = (acumulado_promedio / data_util_sistemas["VENADO"].data_util_puntos_promedios.length);

                                            //promedios sistema tunel
                                            data_util_sistemas["TUNEL"].data_util_puntos_promedios.push({ "name": fecha_key, "y": parseFloat(parseFloat(data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key].promedio - data_util_puntos["ATARASQUILLO"].registros_agrupados_formato[fecha_key].promedio).toFixed(decimalsPlaces)), "reporte_id": value.reporte_id, "reporte_folio": value.reporte_folio, "reporte_fecha": value.reporte_fecha,  "custom":{"tipos_afectacion": value.tipos_afectacion} })
                                            //acumulados gasto sistema tunel
                                            data_util_sistemas["TUNEL"].data_util_puntos_acumulados.push({ "name": fecha_key, "y": parseFloat(parseFloat(data_util_puntos[nombre_punto].registros_agrupados_formato[fecha_key].acumulado_gasto - data_util_puntos["ATARASQUILLO"].registros_agrupados_formato[fecha_key].acumulado_gasto).toFixed(decimalsPlaces)), "reporte_id": value.reporte_id, "reporte_folio": value.reporte_folio, "reporte_fecha": value.reporte_fecha,  "custom":{"tipos_afectacion": value.tipos_afectacion} })

                                            //Gasto total acumulado y promedio del rango para el sistema
                                            data_util_sistemas["TUNEL"].gasto_total_acumulado = data_util_sistemas["VENADO"].gasto_total_acumulado - data_util_sistemas["T1"].gasto_total_acumulado;
                                            data_util_sistemas["TUNEL"].gasto_total_promedio = data_util_sistemas["VENADO"].gasto_total_promedio - data_util_sistemas["T1"].gasto_total_promedio;
                                            break;
                                        default:

                                    }



                                }
                                if (key + 1 == res.length) {
                                    //Se activa alerta, en caso de que los datos esten incompletos
                                    // console.log("decision final")
                                    res.length - divisor_ref != 0 ? alerta_datos = true : null;

                                }
                            });

                            console.log(data_util_sistemas)
                            grafica3D(data_util_sistemas, "grafica_totales");
                            grafica3D(data_util_sistemas, "grafica_promedios");


                            graficaCompartiva(data_util_sistemas, "grafica_comparativa_totales")
                            graficaCompartiva(data_util_sistemas, "grafica_comparativa_promedios")
                            if (alerta_datos) {
                                swal({
                                    type: "warning",
                                    title: "El reporte no se ha generado correctamente",
                                    text: "El reporte no cuenta con la información necesaria para ser procesado correctamente (Faltan registros)",
                                    showConfirmButton: true,
                                    allowOutsideClick: false
                                }).then(function () {

                                });
                            } else {
                                swal.close();
                            }
                        }
                        catch (e) {
                            //
                            console.log(e)
                            swal({
                                type: "error",
                                title: "Hubo un error al procesar el reporte",
                                text: "Intente con un intervalo diferente",
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

        var formulario = $(e.currentTarget).serializeArray(); //Convierte a los campos que forman parte del formulario en un arreglo indexado
        formulario.push({
            name: "accion",
            value: "CONSULTAR"
        }); //Añadimos el parametro para la accion que tomara del modelo
        swal({
            title: 'CARGANDO',
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
                //Añadimos el parametro para la accion que tomara del modelo
                $.ajax({
                    url: serverurl + "ajax/historicoSistemasAjax.php",
                    method: "post",
                    data: $.param(formulario),
                    success: function (res) {
                        swal.close();
                        res = JSON.parse(res);
                        //  tabla.clear().draw();

                        concentrado = [];
                        $.each(res, function (key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos


                            concentrado.push(value);


                            //promedio = value.promedio;





                        });

                        excel();
                    }
                });
            }
        });

    }
});


function calcularSistema(fecha_key, ob1, ob2) {


    return { "name": fecha_key, "y": (obj1.promedio - ob2.promedio) }
}
function calcularDivisor(fecha_key, formato) {
    // moment_verano = moment(4, "MM").startOf('month').isoWeekday(7);
    // moment_invierno = moment(10, "MM").endOf('month').day(moment(10, "MM").endOf('month').day() >= 7 ? 7 : 0)
    moment_fecha_key = moment(fecha_key, formato)

    switch (formato) {
        case "YYYY-MM-DD H:mm":
            divisor = 1;
            break;
        case "YYYY-MM-DD":
            //Obtener el primer Domingo del mes de Abril que es cuando ocurre el cambio de horario

            diaCambioHorario = getFirstWeekDay((moment().startOf('year').add(3, "month")).format("YYYY-MM"), 0)
            // console.log(diaCambioHorario)
            //Numero de registros que deberiamos de tener por cada punto en cada dia (excepto para cambio de horario)
            if (moment_fecha_key.format('YYYY-MM-DD') == diaCambioHorario) {
                divisor = 23;
            } else {
                divisor = 24;
            }

            break;
        case "YYYY-MM":
            //Numero de registros que deberiamos de tener por cada punto en cada mes (segun el mes)
            // let moment_fecha_key=moment(fecha_key, formato)
            // if(fecha_key){}

            if (String(moment_fecha_key.format('MM')) == "04") {
                divisor = (moment_fecha_key.daysInMonth() * 24) - 1;

            } else {
                divisor = moment_fecha_key.daysInMonth() * 24;
            }

            break;
        case "YYYY":
            //Numero de registros que deberiamos de tener por cada punto en cada año (segun el año)

            divisor = (moment_fecha_key.getYear() % 4 == 0) ? 366 * 12 * 24 : 365 * 12 * 24;
            break;
        default:
            break;
    }
    return divisor;
}


$("#excel").click(function (e) {
    tiposubmit = 2;
});

$("#submit").click(function () {
    tiposubmit = 1;
});

function getFirstWeekDay(dateString, dayOfWeek) {
    var date = moment(dateString, "YYYY-MM-DD");

    var day = date.day();
    var diffDays = 0;

    if (day > dayOfWeek) {
        diffDays = 7 - (day - dayOfWeek);
    } else {
        diffDays = dayOfWeek - day
    }

    // console.log(date.add(diffDays, 'day').format("YYYY-MM-DD"));
    return date.add(diffDays, 'day').format("YYYY-MM-DD");
}



function grafica3D(data_util_sistemas, element) {
    var series_data_util = [];
    var title_text = '';
    if (element == "grafica_totales") {
        title_text = 'Gráfica de Acumulados Sistemas'
        title_text_yAxis = 'Gasto Total Acumulado (L/s)';
        series_data_util = [{
            name: 'CL (VenturyII + VenturyIII)',

            data: [{ name: "CL", y: parseFloat(parseFloat(data_util_sistemas["CL"].gasto_total_acumulado).toFixed(decimalsPlaces)), drilldown: true }, { name: "T1", y: null }, { name: "VENADO", y: null }, { name: "LERMA", y: null }, { name: "TUNEL", y: null }]
            // stack: 'male'

        }, {
            name: 'T1 (Atarasquillo)',
            data: [{ name: "CL", y: null }, { name: "T1", y: parseFloat(parseFloat(data_util_sistemas["T1"].gasto_total_acumulado).toFixed(decimalsPlaces)), drilldown: true }, { name: "VENADO", y: null }, { name: "LERMA", y: null }, { name: "TUNEL", y: null }]
            // stack: 'male'
        }, {
            name: 'VENADO',

            data: [{ name: "CL", y: null }, { name: "T1", y: null }, { name: "VENADO", y: parseFloat(parseFloat(data_util_sistemas["VENADO"].gasto_total_acumulado).toFixed(decimalsPlaces)), drilldown: true }, { name: "LERMA", y: null }, { name: "TUNEL", y: null }]
            //stack: 'male'
        }, {
            name: 'LERMA (T1-CL)',

            data: [{ name: "CL", y: null }, { name: "T1", y: null }, { name: "VENADO", y: null }, { name: "LERMA", y: parseFloat(parseFloat(data_util_sistemas["LERMA"].gasto_total_acumulado).toFixed(decimalsPlaces)), drilldown: true }, { name: "TUNEL", y: null }]
            //stack: 'female'
        }, {
            name: 'TUNEL (VENADO-T1)',
            data: [{ name: "CL", y: null }, { name: "T1", y: null }, { name: "VENADO", y: null }, { name: "LERMA", y: null }, { name: "TUNEL", y: parseFloat(parseFloat(data_util_sistemas["TUNEL"].gasto_total_acumulado).toFixed(decimalsPlaces)), drilldown: true }]
            //stack: 'female'
        }]
    }
    else if (element == "grafica_promedios") {
        title_text = 'Gráfica de Promedios Sistemas'
        title_text_yAxis = 'Gasto Promedio (L/s)';
        series_data_util = [{
            name: 'CL (VenturyII + VenturyIII)',
            data: [{ name: "CL", y: parseFloat(parseFloat(data_util_sistemas["CL"].gasto_total_promedio).toFixed(decimalsPlaces)), drilldown: true }, { name: "T1", y: null }, { name: "VENADO", y: null }, { name: "LERMA", y: null }, { name: "TUNEL", y: null }]
            // stack: 'male'

        }, {
            name: 'T1 (Atarasquillo)',
            data: [{ name: "CL", y: null }, { name: "T1", y: parseFloat(parseFloat(data_util_sistemas["T1"].gasto_total_promedio).toFixed(decimalsPlaces)), drilldown: true }, { name: "VENADO", y: null }, { name: "LERMA", y: null }, { name: "TUNEL", y: null }]
            // stack: 'male'
        }, {
            name: 'VENADO',
            data: [{ name: "CL", y: null }, { name: "T1", y: null }, { name: "VENADO", y: parseFloat(parseFloat(data_util_sistemas["VENADO"].gasto_total_promedio).toFixed(decimalsPlaces)), drilldown: true }, { name: "LERMA", y: null }, { name: "TUNEL", y: null }]
            //stack: 'male'
        }, {
            name: 'LERMA (T1-CL)',
            data: [{ name: "CL", y: null }, { name: "T1", y: null }, { name: "VENADO", y: null }, { name: "LERMA", y: parseFloat(parseFloat(data_util_sistemas["LERMA"].gasto_total_promedio).toFixed(decimalsPlaces)), drilldown: true }, { name: "TUNEL", y: null }]
            //stack: 'female'
        }, {
            name: 'TUNEL (VENADO-T1)',
            data: [{ name: "CL", y: null }, { name: "T1", y: null }, { name: "VENADO", y: null }, { name: "LERMA", y: null }, { name: "TUNEL", y: parseFloat(parseFloat(data_util_sistemas["TUNEL"].gasto_total_promedio).toFixed(decimalsPlaces)), drilldown: true }]
            //stack: 'female'
        }]
    }
    //

    new Highcharts.chart(element, {

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
        chart: {
            type: 'column',
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 5,
                viewDistance: 10,
                depth: 30
            },
            resetZoomButton: {
                /* position: {
                     // align: 'right', // by default
                     // verticalAlign: 'top', // by default
                     x: -10,
                     y: 10
                 },
                 relativeTo: 'chart'*/
                theme: {
                    display: 'none'
                }
            },
            style: {
                fontFamily: 'Arial'
            }, "events": {
                drilldown: function (e) {

                    //

                    this.userOptions.plotOptions.column.dataLabels.rotation = 270
                    this.userOptions.plotOptions.series.dataLabels.rotation = 270


                    if (!e.seriesOptions) {
                        updateGraph(true, this, e, data_util_sistemas, element);
                    }
                },
                drillup: function (e) {



                    if (!e.seriesOptions.flag) {
                        realignLabels(this.series, 0);
                        this.userOptions.plotOptions.column.dataLabels.rotation = 0
                        this.userOptions.plotOptions.series.dataLabels.rotation = 0

                        console.log("Llamada")
                        drilldownLevel = e.seriesOptions._levelNumber;
                        //
                        //updateGraph(false);
                        console.log(e);
                        if (e.target.customReset) {
                            console.log(e.target.customReset)
                            e.target.customReset.destroy();
                            e.target.customReset = null;
                        }
                    }
                },

                selection(e) {
                    console.log(e)
                    const chart = this;
                    const x = chart.plotRight - 80;
                    const y = chart.top;
                    console.log(chart)
                    if (!chart.customReset && chart.drillUpButton) {
                        chart.customReset = chart.renderer.button('Reiniciar zoom', x, y)
                            .on('click', () => {
                                chart.xAxis[0].setExtremes();
                                chart.customReset.destroy();
                                chart.customReset = null;
                            })
                            .add()
                            .toFront();
                    }
                }

            }
        },


        // legend: {
        //     enabled: true,
        //     layout: "vertical",
        //     align: "bottom",
        //     x: 0,
        //     verticalAlign: "top",
        //     y: 140,
        //     floating: false
        // },
        yAxis: {
            stackLabels: {
                enabled: true,
                align: 'center',
                formatter: function () {
                    var sum = 0;
                    var series = this.axis.series;

                    for (var i in series) {
                        if (series[i].visible && series[i].options.stacking == 'normal' && this.x in series[i].yData)
                            sum += series[i].yData[this.x];
                    }
                    if (sum >= 0 && this.isNegative == false
                        || sum < 0 && this.isNegative == true) {
                        return Highcharts.numberFormat(sum, 1);
                    } else {
                        return '';
                    }
                },

            }
        },
        title: {
            text: title_text,
            fontWeight: "bold"
        },
        subtitle: {
            text: fecha_hora_inicial + ' / ' + fecha_hora_final
        },
        xAxis: {
            title: {},
            type: "category"
        },
        yAxis: [{
            title: {
                text: title_text_yAxis
            },
            //min: 0,
            allowDecimals: false
        }
            //     , {
            //     opposite: true,
            //     title: {
            //         text: "My Score"
            //     },
            //     min: 0
            // }
        ],




        plotOptions: {
            column: {
                stacking: 'normal',
                depth: 40,
                dataLabels: {
                    enabled: true,
                    format: ' {point.y:.1f} L/s',
                    verticalAlign: 'bottom',
                    rotation: 0,
                    y: -5,
                    align: 'left',
                    color: 'black'
                    /* formatter() {
                        return '<span style="color: ' + 'black' +';">' + this.y + '</span>';
                      }, */
                    /*  style: {
                         //textOutline: "1px solid",
                         fontFamily: "",
                         fontSize: '10px',
                         //textShadow: false,
                         fontWeight:"normal"
                     } */
                }
            },
            series: {
                dataLabels: {
                    enabled: true,
                    format: ' {point.y:.1f} L/s',
                    verticalAlign: 'bottom',
                    rotation: 0,
                    //y: -5,
                    align: 'left',
                    color: 'black'
                    /* formatter() {
                        return '<span style="color: ' + 'black' + ';">' + this.y + '</span>';
                      }, */
                    /* style: {
                        //textOutline: "1px solid",
                        fontFamily: "",
                        fontSize: '10px',
                        //textShadow: false,
                        fontWeight:"normal"
                    } */


                },
                tooltip: {
                    headerFormat: '<b>{point.key}</b><br>',
                    pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}:  {point.y:.2f} L/s',

                },
                events: {
                    show: function (e) {

                        if (e.target.options._levelNumber > 0) {

                            $.each(e.target.chart.series, function (key, value) {
                                if (value._i != e.target._i) {
                                    value.hide()
                                }

                            })

                        }

                        e.target.chart.reflow()

                    }
                }
            },

        },
        drilldown: {
            drillUpButton: {

                position: {
                    align: 'left',
                    //verticalAlign: 'top',
                    x: this.left,
                    y: this.top
                }
            },
            relativeTo: 'graph'

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

        series: series_data_util,
        exporting: {
            showTable: false,
            csv: {
                columnHeaderFormatter: function (item, key) {
                    if (!item || item instanceof Highcharts.Axis) {
                        return 'Categoria'
                    } else {
                        return item.name;
                    }
                }
            }
        }
    });
}


function updateGraph(isDrilldown, chart, e, data_util_sistemas, element) {
    if (isDrilldown) {

        // drilldownLevel++;
        drilldownChart = chart;
        drilldownEvent = e;

        var drilldowns = {
            'CL': {
                name: 'CL',
                type: 'column',
                color: 'rgb(102, 168, 255)',
                data: element == "grafica_totales" ? data_util_sistemas["CL"].data_util_puntos_acumulados : data_util_sistemas["CL"].data_util_puntos_promedios,

                visible: true,
                verticalAlign: "",
                drilldown: false
                //stack: 'male'
            },
            'T1': {
                name: 'T1',
                type: 'column',
                color: 'rgb(67,67,72)',
                data: element == "grafica_totales" ? data_util_sistemas["T1"].data_util_puntos_acumulados : data_util_sistemas["T1"].data_util_puntos_promedios,

                visible: true,
                verticalAlign: "",
                drilldown: false
                //stack: 'male'
            },
            'VENADO': {
                name: 'VENADO',
                type: 'column',
                color: 'rgb(144, 237, 125)',
                data: element == "grafica_totales" ? data_util_sistemas["VENADO"].data_util_puntos_acumulados : data_util_sistemas["VENADO"].data_util_puntos_promedios,

                visible: true,
                verticalAlign: "",
                drilldown: false
                //stack: 'male'
            },
            'LERMA': {
                name: 'LERMA',
                type: 'column',
                color: 'rgb(247, 163, 92)',
                data: element == "grafica_totales" ? data_util_sistemas["LERMA"].data_util_puntos_acumulados : data_util_sistemas["LERMA"].data_util_puntos_promedios,

                visible: true,
                verticalAlign: "",
                drilldown: false
                //stack: 'male'
            },
            'TUNEL': {
                name: 'TUNEL',
                type: 'column',
                color: 'rgb(128, 133, 233)',
                data: element == "grafica_totales" ? data_util_sistemas["TUNEL"].data_util_puntos_acumulados : data_util_sistemas["TUNEL"].data_util_puntos_promedios,

                visible: true,
                verticalAlign: "",
                drilldown: false
                //stack: 'male'
            }
        }
        var drilldowns2 = {
            'CL': {
                name: 'CL',
                type: 'line',
                color: 'rgb(102, 168, 255)',
                data: element == "grafica_totales" ? data_util_sistemas["CL"].data_util_puntos_acumulados : data_util_sistemas["CL"].data_util_puntos_promedios,
                tooltip: {
                    valueSuffix: ' L/s'
                },
                visible: false,
                drilldown: false
                //stack: 'male'
            },
            'T1': {
                name: 'T1',
                type: 'line',
                color: 'rgb(67,67,72)',
                data: element == "grafica_totales" ? data_util_sistemas["T1"].data_util_puntos_acumulados : data_util_sistemas["T1"].data_util_puntos_promedios,
                tooltip: {
                    valueSuffix: ' L/s'
                },
                visible: false,
                drilldown: false
                //stack: 'male'
            },
            'VENADO': {
                name: 'VENADO',
                type: 'line',
                color: 'rgb(144, 237, 125)',
                data: element == "grafica_totales" ? data_util_sistemas["VENADO"].data_util_puntos_acumulados : data_util_sistemas["VENADO"].data_util_puntos_promedios,
                tooltip: {
                    valueSuffix: ' L/s'
                },
                visible: false,
                drilldown: false
                //stack: 'male'
            },
            'LERMA': {
                name: 'LERMA',
                type: 'line',
                color: 'rgb(247, 163, 92)',
                data: element == "grafica_totales" ? data_util_sistemas["LERMA"].data_util_puntos_acumulados : data_util_sistemas["LERMA"].data_util_puntos_promedios,
                tooltip: {
                    valueSuffix: ' L/s'
                },
                visible: false,
                drilldown: false
                //stack: 'male'
            },
            'TUNEL': {
                name: 'TUNEL',
                type: 'line',
                color: 'rgb(128, 133, 233)',
                data: element == "grafica_totales" ? data_util_sistemas["TUNEL"].data_util_puntos_acumulados : data_util_sistemas["TUNEL"].data_util_puntos_promedios,
                tooltip: {

                    valueSuffix: ' L/s'
                },
                visible: false,
                drilldown: false
                //stack: 'male'
            }
        }

        series = drilldowns[e.point.name];
        series2 = drilldowns2[e.point.name];

        chart.addSingleSeriesAsDrilldown(e.point, series);

        chart.addSingleSeriesAsDrilldown(e.point, series2);

        //

        chart.applyDrilldown();

        chart.reflow();
    }
    //
}


function realignLabels(series, rotation) {
    console.log(series)
    $.each(series, function (i, serie) {
        console.log(i)
        $.each(serie.points, function (j, point) {
            console.log(point)
            //if (!point.dataLabel) return true;


            // console.log(point.dataLabel)

            // point.dataLabel.attr({

            //     rotation: rotation
            // });

        });
    })


};




function graficaCompartiva(data_util_sistemas, element) {

    var easeOutBounce = function (pos, chart) {
        console.log(pos);
        console.log(chart);
    };



    var index = 0;
    var data_series = [];
    var data_xAxis = [];
    if (element == "grafica_comparativa_totales") {
        title_text = 'Gráfica Comparativa de Acumulados Sistemas'
        title_text_yAxis = 'Gasto Total Acumulado (L/s)';
        $.each(data_util_sistemas, (key, value) => {

            subdata = data_util_sistemas[key]["data_util_puntos_acumulados"];
            data_series.push(new Object({ name: key, id: key, data: new Array(), custom: new Array() }));

            $.each(subdata, (key, value) => {
               // console.log(value.custom)
                data_xAxis[key] = value.name;
                data_series[index].data.push([parseFloat(value.y)])
                data_series[index].custom.push((value.custom))
            })
            index++;
        })
        /*  console.log(data_xAxis)
         console.log(data_series) */
    } else if (element == "grafica_comparativa_promedios") {
        title_text = 'Gráfica Comparativa de Promedios Sistemas'
        title_text_yAxis = 'Gasto Promedio (L/s)';
        $.each(data_util_sistemas, (key, value) => {

            subdata = data_util_sistemas[key]["data_util_puntos_promedios"];
            data_series.push(new Object({ name: key, id: key, data: new Array(), custom: new Array() }));

            $.each(subdata, (key, value) => {
                //console.log(value.custom)
                data_xAxis[key] = value.name;
                data_series[index].data.push([parseFloat(value.y)])
                data_series[index].custom.push((value.custom))
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
        chart:{events:{load: function () {
            //console.log(this.series) ;
            xAxis=this.xAxis
           $.each(this.series, function(key, serie)
           {
            //console.log(serie) ;
            seriename=key
            //console.log(serie)
            $.each(serie.points, function(key, point){
                //console.log(key) ;
                //console.log(point.series.userOptions.custom[key].tipos_afectacion)
                if(point.series.userOptions.custom[key].tipos_afectacion!="NA")
                {
                    //console.log("Entrando")
                    xAxis[0].addPlotLine({
                        color: 'red', // Color value
                        dashStyle: 'longdashdot', // Style of the plot line. Default to solid
                        //dashStyle: 'solid',
                        value: point.x, // Value of where the line will appear
                        width: 1, // Width of the line   
                        id: 'plot-line-'+point.x,
                        /*label: {
                            text: point.series.userOptions.custom[key].tipos_afectacion
                        }*/
                    });
                }
                
            })
           })
           
        }}},
        title: {
            text: title_text
        },

        subtitle: {
            text: fecha_hora_inicial + ' / ' + fecha_hora_final
        },


        xAxis: {
            type: 'category',
            categories: data_xAxis,
            labels:{formatter: function () {
               // console.log(this)

                return this.value;
            }}

        },
        yAxis: {
            title: {
                text: title_text_yAxis
            }

        }, legend: {
            enabled: false
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        series: data_series,
        tooltip: {
            shared: false
        },
        plotOptions: {
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function (e) {
                            registro_data = data_util_sistemas[this.series.name]["data_util_puntos_acumulados"][this.x];
                            hs.htmlExpand(null, {
                                pageOrigin: {
                                    x: e.pageX || e.clientX,
                                    y: e.pageY || e.clientY
                                },
                                headingText: this.series.name +'<a href="#" onclick="return hs.close(this)"> Cerrar</a>',
                                maincontentText:  this.category + ':<br/> ' +
                                    this.y + ' L/s <br>'+ (registro_data.reporte_id!="NA"?`<br> Folio Reporte: <a target="_blank" href='${serverurl+'detallesReporte/'+registro_data.reporte_id}'>${registro_data.reporte_folio} (Click para visualizar)</a>`:'No hay folio de reporte'),
                                width: 200
                            });

                        }
                    }
                },
                marker: {
                    lineWidth: 1
                }
            }
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
        }

    };



    //console.log(element)
    chart = new Highcharts.chart(element, options);

}
