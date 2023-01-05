const decimalsPlaces=2;
var gasto_contenedor = [];
var intervalo_muestra = [];
var f = new Date();
var muestra = 0;
var anio_actual = f.getFullYear();
var defs_select2 = {
  placeholder: 'Selecciona una opción',
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

var tabla = $("#tabla_historico_sistemas").DataTable(defs_datatable);

var chart;

$(document).ready(function () {

  (function (H) {
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
          "permisos": "('MONITOREOSISTEMACUTZAMALA'," +
            "'MONITOREOSISTEMAATARAZQUILLO'," +
            "'MONITOREOSISTEMALERMA')"
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

              if (value.permiso == "MONITOREOSISTEMACUTZAMALA") {
                $("#sistema_id [value='1']").attr("disabled", false);
              } else if (value.permiso == "MONITOREOSISTEMAATARAZQUILLO") {
                $("#sistema_id [value='2']").attr("disabled", false);
              } else if (value.permiso == "MONITOREOSISTEMALERMA") {
                $("#sistema_id [value='3']").attr("disabled", false);
              }

            });
            $("#sistema_id > option").each(function () {
              //console.log(this.value);
              if ($("#sistema_id [value='" + this.value + "']").attr("disabled") == 'disabled') {
                $("#sistema_id [value='" + this.value + "']").remove();
                $('#sistema_id').trigger('change.select2');

              }
            });
            swal.close();
          } else {
            swal({
              type: "error",
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
  //console.log(moment("2020-11-16").startOf('day').add(23, 'hour'))
  $('#daterange_diario_historico_sistemas').daterangepicker({
    autoUpdateInput: true,
    forceUpdate: true,

    opens: 'center',
    showDropdowns: true,

    startDate: moment().startOf('day'),
    endDate: moment().startOf('day').add(23, 'hour'),
    minYear: 1999,
    maxYear: moment().year(),
    maxDate: moment().startOf('day'),
    timePicker24Hour: true,
    locale: locale
  }, function (start, end, label) {
    console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
  });

  $('#daterange_meses_historico_sistemas').daterangepicker({
    monthDatePicker: true,
    autoUpdateInput: true,
    forceUpdate: true,
    opens: 'center',
    showDropdowns: true,
    startDate: moment('2020-11-16').subtract(1, 'month').startOf("month"),
    endDate: moment().startOf('month').add(23, 'hour'),
    maxDate: moment().startOf('hour'),
    timePicker24Hour: true,
    minYear: 1999,
    maxYear: moment().year(),
    locale: locale
  }, function (start, end, label) {
    console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
  });

  //console.log(moment().endOf("year"));
  $('#daterange_anios_historico_sistemas').daterangepicker({
    yearsDatePicker: true,
    autoUpdateInput: true,
    forceUpdate: true,
    opens: 'center',
    showDropdowns: true,
    startDate: moment().startOf("year"),
    endDate: moment().endOf("year"),
    maxDate: moment().endOf('year'),
    timePicker24Hour: true,
    minYear: 1999,
    maxYear: moment().year(),
    locale: locale
  }, function (start, end, label) {
    console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
  });




  $("#excel").click(function (e) {
    tiposubmit = 2;
  });

  $("#submit").click(function () {
    tiposubmit = 1;
  });

  $("#periodo_id").select2(defs_select2);
  $("#sistema_id").select2(defs_select2);

  $("#periodo_id").trigger("change");

  $(".dataTables_wrapper")
    .find("select")
    .formSelect();
});

$("#periodo_id").change(function (e) {
  $("#daterange_diario_historico_sistemas").hide();
  $("#daterange_diario_historico_sistemas").prop("disabled", true);
  $("#daterange_meses_historico_sistemas").hide();
  $("#daterange_meses_historico_sistemas").prop("disabled", true);
  $("#daterange_anios_historico_sistemas").hide();
  $("#daterange_anios_historico_sistemas").prop("disabled", true);

  switch (parseInt(e.target.value)) {
    case 1:

      $("#daterange_diario_historico_sistemas").show();
      $("#daterange_diario_historico_sistemas").prop("disabled", false);
      intervalo_muestra = 24 * 3600 * 1000;

      break;

    case 2:

      $("#daterange_meses_historico_sistemas").show();
      $("#daterange_meses_historico_sistemas").prop("disabled", false);
      intervalo_muestra = 1000 * 60 * 60 * 24 * 30.5;
      break;

    case 3:

      $("#daterange_anios_historico_sistemas").show();
      $("#daterange_anios_historico_sistemas").prop("disabled", false);

      intervalo_muestra = 1000 * 60 * 60 * 24 * 366;
      break;

    default:
      break;
  }
});


$("#min_scale_yAxis_input").keyup((e) => {
  //Esperamos a que terminen de capturar el valor para hacer las validaciones y aplicar el valor
  timeout = setTimeout(function () {
    let min_scale_yAxis = document.getElementById("min_scale_yAxis_input").value
    //console.log(min_scale_yAxis)
    if (chart && min_scale_yAxis >= 0 && min_scale_yAxis != null && min_scale_yAxis != undefined && min_scale_yAxis != "") {
      chart.yAxis[0].update({
        min: min_scale_yAxis
      });
    } else {
      //console.log(e.target)
      e.target.value = 0
    }
  }, 1000);

})

$("#ayuda").click(function () {

  introJs().start();
});

$("form").on("submit", function (e) {
  e.preventDefault();
  if (tiposubmit == 1) {
    var sistema_id = $("#sistema_id").val();
    var sistema;
    switch (parseInt(sistema_id)) {
      case 1:
        sistema = "Cutzamala";
        break;
      case 2:
        sistema = "Atarasquillo";
        break;
      case 3:
        sistema = "Lerma";
        break;

      default:
        break;
    }

    document.getElementById("min_scale_yAxis_container").hidden = false;

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
              tabla.clear().draw();
              gasto_contenedor = [];
              fecha_contenedor = [];
              $.each(res, function (key, value) {
                addRow(sistema, value.fecha_sis, value.sistema);

                gasto_contenedor.push(parseFloat(value.sistema));
                fecha_contenedor.push(value.fecha_sis);
                // excel(sistema,value.fecha_sis,value.sistema);
                //
                //
              });
              grafica();
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
    var sistema_id = $("#sistema_id").val();
    var sistema;
    switch (parseInt(sistema_id)) {
      case 1:
        sistema = "Cutzamala";
        break;
      case 2:
        sistema = "Atarasquillo";
        break;
      case 3:
        sistema = "Lerma";
        break;

      default:
        break;
    }

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
            //  tabla.clear().draw();
            if (res.length) {

              concentrado = [];
              $.each(res, function (key, value) { // Por cada elemento de la respuesta se vuelve a formar el listado de opciones de articulos
                concentrado.push(value);
                //promedio = value.promedio;
              });

              excel();
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
});

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
      zoomType: 'xy',
      "events": {
        render: function (e) {
        }
      }
    },
    legend: {
      enabled: false,
      useHTML: true,
      labelFormatter: function test() {
        console.log("in label fomatter");
        console.log("in test");
        console.log(this);
        if (this.userOptions.yAxis == 0) {
          return `<input type="text" value="${this.name}" style="width:100px"/>`;
        }

      }
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
      }, series: {
        events: {
          legendItemClick: function (e) {
            console.log("leyenda")
            e.preventDefault();
            return false;
          }
        }
      }

    },
    credits: {
      enabled: false
    }

  });
  chart = Highcharts.chart('container', {
    title: {
      text: 'Gasto en Litros (L/s) de Historico por Fechas'
    },
    subtitle: {
      text: ''
    },

    series: [{
      type: 'area',
      name: 'Historico',
      pointInterval: intervalo_muestra,
      pointStart: moment(fecha_contenedor[0]).valueOf(),
      pointEnd: moment(fecha_contenedor[fecha_contenedor.length - 1]).valueOf(),
      data: gasto_contenedor,
      yAxis: 0
    }],
    yAxis: [{
      title: {
        text: 'Gasto [L/s]'
      },
      opposite: false,
      min: 0
    }],
    tooltip: {
      shared: true,
      pointFormat: '{point.y:.2f} L/s',

    }
  });
}

//alert(new Intl.NumberFormat().format(number));

function addRow(sistema, fecha, gasto) {
 
  gasto=parseFloat(gasto).toFixed(decimalsPlaces);
  tabla.row
    .add([fecha, sistema, new Intl.NumberFormat("en").format(gasto), new Intl.NumberFormat("en").format(parseFloat(gasto * 86.4).toFixed(decimalsPlaces))])
    .draw();
}

function excel() {
  var sistema_id = $("#sistema_id").val();
  var sistema;
  switch (parseInt(sistema_id)) {
    case 1:
      sistema = "Cutzamala";
      break;
    case 2:
      sistema = "Atarasquillo";
      break;
    case 3:
      sistema = "Alzate";
      break;
    case 4:
      sistema = "Dolores";
      break;
    case 5:
      sistema = "Venado";
      break;
    case 6:
      sistema = "Borracho";
      break;
    case 7:
      sistema = "Cruz";
      break;
    default:
      break;
  }
  /* original data */
  var data = [];
  //
  $.each(concentrado, function (key, value) {
    //  
    data.push({ "Fecha": value.fecha_sis, "Sistema": sistema, "Gasto en Litros (L/s)": new Intl.NumberFormat("en").format(parseFloat(value.sistema).toFixed(decimalsPlaces)), "Gasto en Metros Cúbicos (m³)": new Intl.NumberFormat("en").format(parseFloat(value.sistema * 86.4).toFixed(decimalsPlaces)) });
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

  saveAsCustom(new Blob([s2ab(wbout)], { type: "application/octet-stream" }), "HISTORICO_SISTEMA_"+sistema.toUpperCase().replace(" ","_")+".xlsx");
}
