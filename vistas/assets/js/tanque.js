defs_datatable.order = [[2, "desc"]];

var tabla = $("#tabla_tanque").DataTable(defs_datatable);

var gasto = "0";
var defs_select2 = {
  placeholder: "Seleccione una opción",
  language: {
    noResults: function (params) {
      return "No se encontraron resultados";
    },
  },
};

var defs_select2 = {
  placeholder: "Selecciona una opción",
  language: {
    noResults: function (params) {
      return "No se encontraron resultados";
    },
  },
};
var columnDefs;
$(document).ready(() => {
  swal({
    title: "CARGANDO",
    allowEscapeKey: false,
    allowOutsideClick: false,
    onOpen: () => {
      swal.showLoading();
      $.ajax({
        url: serverurl + "ajax/permisosAjax.php",
        method: "post",
        data: {
          accion: "CONSULTAPERMISOS",
          permisos:
            "('CAPTURATANQUEAEROCLUB'," +
            "'CAPTURATANQUECARTERO'," +
            "'CAPTURATANQUEPALOALTO'," +
            "'CAPTURATANQUEZARAGOZA'," +
            "'CAPTURATANQUEDOLORES'," +
            "'CAPTURATANQUESTALUCIA1'," +
            "'CAPTURATANQUESTALUCIA2'," +
            "'CAPTURATANQUESTALUCIA3'," +
            "'CAPTURATANQUESTALUCIA4'," +
            "'CAPTURATANQUESTALUCIA5'," +
            "'CAPTURATANQUEVILLAVERDUN'," +
            "'CAPTURATANQUEAGUILAS2'," +
            "'CAPTURATANQUEAGUILAS3'," +
            "'CAPTURATANQUEAGUILAS4'," +
            "'CAPTURATANQUEAGUILAS5'," +
            "'CAPTURATANQUEAGUILAS6'," +
            "'CAPTURATANQUEMIMOSA'," +
            "'CAPTURATANQUELIENZO'," +
            "'CAPTURATANQUEJUDIO'," +
            "'CAPTURATANQUESANFRANCISCO'," +
            "'CAPTURATANQUEPADIERNA'," +
            "'CAPTURATANQUEMADEDEROSII'," +
            "'CAPTURATANQUEMADEDEROSIII'," +
            "'CAPTURATANQUEMAPLE'," +
            "'CAPTURATANQUEZAPOTE'," +
            "'CAPTURATANQUEZAPOTE'," +
            "'CAPTURATANQUEFABRIQUITA'," +
            "'CAPTURATANQUECURVA'," +
            "'CAPTURATANQUEROMPEDOR'," +
            "'CAPTURATANQUEMERCEDGOMEZ'," +
            "'CAPTURATANQUEYAQUI'," +
            "'CAPTURATANQUECALVARIO'," +
            "'CAPTURATANQUELIMBO'," +
            "'CAPTURATANQUELAERA'," +
            "'CAPTURATANQUEAO8')",
        },
        success: (res) => {
          res = JSON.parse(res);
          $.each(res, (key, value) => {
            if (value.permiso == "CAPTURATANQUEAEROCLUB") {
              $("#tanque_id [value='1']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUECARTERO") {
              $("#tanque_id [value='4']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEPALOALTO") {
              $("#tanque_id [value='5']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEZARAGOZA") {
              $("#tanque_id [value='6']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEDOLORES") {
              $("#tanque_id [value='7']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUESTALUCIA1") {
              $("#tanque_id [value='8']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUESTALUCIA2") {
              $("#tanque_id [value='9']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUESTALUCIA3") {
              $("#tanque_id [value='10']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUESTALUCIA4") {
              $("#tanque_id [value='11']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUESTALUCIA5") {
              $("#tanque_id [value='12']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEVILLAVERDUN") {
              $("#tanque_id [value='13']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEAGUILAS2") {
              $("#tanque_id [value='14']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEAGUILAS3") {
              $("#tanque_id [value='15']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEAGUILAS4") {
              $("#tanque_id [value='16']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEAGUILAS5") {
              $("#tanque_id [value='17']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEAGUILAS6") {
              $("#tanque_id [value='18']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEMIMOSA") {
              $("#tanque_id [value='19']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUELIENZO") {
              $("#tanque_id [value='20']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEJUDIO") {
              $("#tanque_id [value='21']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUESANFRANCISCO") {
              $("#tanque_id [value='22']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEPADIERNA") {
              $("#tanque_id [value='23']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEMADEDEROSII") {
              $("#tanque_id [value='25']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEMADEDEROSIII") {
              $("#tanque_id [value='26']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEMAPLE") {
              $("#tanque_id [value='27']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEZAPOTE") {
              $("#tanque_id [value='28']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEFABRIQUITA") {
              $("#tanque_id [value='29']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUECURVA") {
              $("#tanque_id [value='30']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEROMPEDOR") {
              $("#tanque_id [value='31']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEMERCEDGOMEZ") {
              $("#tanque_id [value='32']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEYAQUI") {
              $("#tanque_id [value='33']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUECALVARIO") {
              $("#tanque_id [value='34']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUELIMBO") {
              $("#tanque_id [value='37']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUELAERA") {
              $("#tanque_id [value='38']").attr("disabled", false);
            } else if (value.permiso == "CAPTURATANQUEAO8") {
              $("#tanque_id [value='39']").attr("disabled", false);
            }
          });
          $("#tanque_id > option").each(function () {
            if (
              $("#tanque_id [value='" + this.value + "']").attr("disabled") ==
              "disabled"
            )
              $("#tanque_id [value='" + this.value + "']").remove();
            $("#tanque_id").trigger("change.select2");
          });
          swal.close();
        },
      });
    },
  });

  $("#tanque_id").select2(defs_select2);
  $("#fecha_hora_programada").select2(defs_select2);
  $("#transmite").select2(defs_select2);

  $("#tanque_id").trigger("change");
  $("input#transmite, input#novedad").characterCounter();

  $(".dataTables_wrapper").find("select").formSelect();
});

$("#ayuda").click(() => {
  introJs().start();
});

$("#form-captura-tanque").submit((e) => {
  e.preventDefault();
  e.stopPropagation();

  swal({
    allowOutsideClick: false,
    title: "¿Deseas guardar el registro del tanque?",
    text: "El registro será guardado con la información proporcionada",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#03A9F4",
    cancelButtonColor: "#F44336",
    confirmButtonText: '<i class="zmdi zmdi-run"></i> Si',
    cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> No',
    reverseButtons: true,
  })
    .then(() => {
      var formulario = $(e.currentTarget).serializeArray();
      var transmite = document.getElementById("transmite");
      transmite = transmite.options[transmite.selectedIndex].text;

      //console.log(formulario);

      formulario.push({
        name: "transmite",
        value: transmite,
      });
      formulario.push({
        name: "accion",
        value: "GUARDAR",
      });
      $.ajax({
        url: serverurl + "ajax/tanqueAjax.php",
        method: "post",
        data: $.param(formulario),
        success: (res) => {
          if (res == -1) {
            swal({
              type: "error",
              title: "El registro no se ha podido guardar",
              showConfirmButton: true,
              allowOutsideClick: false,
            }).then(() => {});
          } else if (res == 0) {
            swal({
              type: "success",
              title: "El registro se ha guardado correctamente",
              showConfirmButton: true,
              allowOutsideClick: false,
            }).then(() => {
              var experimento = document.getElementById("tanque_id");
              lasHoras(experimento);
            });
          }
        },
      });
    })
    .catch(function (e) {
      console.trace(e);
    });
});

function lasHoras(e) {
    clearDataFields();
  if (e.value != "") {
    swal({
      title: "CARGANDO",
      allowEscapeKey: false,
      allowOutsideClick: false,
      onOpen: () => {
        swal.showLoading();
        $.ajax({
          url: serverurl + "ajax/tanqueAjax.php",
          method: "post",
          data: {
            tanque_id: e.value,
            accion: "CONSULTA",
          },
          success: (res) => {
            res = JSON.parse(res);
            $("#fecha_hora_programada").empty();
            $.each(res.fechas_restantes, (key, value) => {
              $("#fecha_hora_programada").append(
                '<option value="' + value + '">' + value + "</option>"
              );
            });

            // DOM Clases

            // Tirantes
            var t_1 = $(".uno");
            var t_2 = $(".dos");
            var t_3 = $(".tres");
            var t_4 = $(".cuatro");

            // Vertedor
            var v = $(".cinco");

            // Descargas
            var d_1 = $(".seis");
            var d_2 = $(".siete");
            var d_3 = $(".ocho");

            // Local
            var l = $(".nueve");

            // Presion
            var p = $(".diez");

            // Gasto
            var g = $(".once");

            // Equipos
            var eq1 = $(".doce");
            var eq2 = $(".trece");
            var eq3 = $(".catorce");
            var eq4 = $(".quince");
            var eq5 = $(".diecises");

            // Bypass
            var by = $(".diecisiete");

            // Equipo Texto
            var eq_text = $(".dieciocho");

            var clases = [
              t_1,
              t_2,
              t_3,
              t_4,
              v,
              d_1,
              d_2,
              d_3,
              l,
              p,
              g,
              eq1,
              eq2,
              eq3,
              eq4,
              eq5,
              by,
              eq_text,
            ];

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
              tabla.column(20),
            ];

            // DOM
            if (e.value == 1) {
              // 3 Tirantes

              // Recorre el arreglo Clases
              for (var i = 0; i < clases.length; i++) {
                var nombre = $(clases[i]).find("input");
                //console.log( nombre[0].id );

                // los inputs a mostrar
                if (
                  nombre[0].id == "tirante_uno" ||
                  nombre[0].id == "tirante_dos" ||
                  nombre[0].id == "tirante_tres"
                ) {
                  // para mostrar el div
                  $(clases[i]).show();

                  // para habilitar el input
                  $(clases[i]).find("input").prop("disabled", false);
                } else {
                  // para ocultar el div
                  $(clases[i]).hide();

                  // para deshabilitar el input
                  $(clases[i]).find("input").prop("disabled", true);
                }
              }

              // Recorre Columnas
              for (var i = 0; i < columnas.length; i++) {
                var pasa = columnas[i];

                // condicion para las columnas que se van a mostrar
                if (pasa[0] == 3 || pasa[0] == 4 || pasa[0] == 5) {
                  // muestran columnas
                  pasa.visible(true);
                } else {
                  // ocultan columnas
                  pasa.visible(false);
                }
              }

              tabla.clear().draw();

              $.each(res.fechas_registradas, (key, value) => {
                addRow(value);
              });
            } else if (e.value == 4) {
              // Tirante, Gasto, 5 Equipos

              for (var i = 0; i < clases.length; i++) {
                var nombre = $(clases[i]).find("input");

                if (
                  nombre[0].id == "tirante_uno" ||
                  nombre[0].id == "gasto" ||
                  nombre[0].id == "equipos"
                ) {
                  $(clases[i]).show();

                  $(clases[i]).find("input").prop("disabled", false);
                } else {
                  $(clases[i]).hide();

                  $(clases[i]).find("input").prop("disabled", true);
                }
              }

              for (var i = 0; i < columnas.length; i++) {
                var pasa = columnas[i];

                if (pasa[0] == 3 || pasa[0] == 13 || pasa[0] == 20) {
                  pasa.visible(true);
                } else {
                  pasa.visible(false);
                }
              }

              tabla.clear().draw();

              $.each(res.fechas_registradas, (key, value) => {
                addRow(value);
              });
            } else if (e.value == 7) {
              // 4 Tirantes, 2 Descarga

              for (var i = 0; i < clases.length; i++) {
                var nombre = $(clases[i]).find("input");

                if (
                  nombre[0].id == "tirante_uno" ||
                  nombre[0].id == "tirante_dos" ||
                  nombre[0].id == "tirante_tres" ||
                  nombre[0].id == "tirante_cuatro" ||
                  nombre[0].id == "descarga_uno" ||
                  nombre[0].id == "descarga_dos"
                ) {
                  $(clases[i]).show();

                  $(clases[i]).find("input").prop("disabled", false);
                } else {
                  $(clases[i]).hide();

                  $(clases[i]).find("input").prop("disabled", true);
                }
              }

              for (var i = 0; i < columnas.length; i++) {
                var pasa = columnas[i];

                if (
                  pasa[0] == 3 ||
                  pasa[0] == 4 ||
                  pasa[0] == 5 ||
                  pasa[0] == 6 ||
                  pasa[0] == 8 ||
                  pasa[0] == 9
                ) {
                  pasa.visible(true);
                } else {
                  pasa.visible(false);
                }
              }

              tabla.clear().draw();

              $.each(res.fechas_registradas, (key, value) => {
                addRow(value);
              });

              //
            } else if (e.value == 13) {
              // Tirante, Presion, Equipo

              for (var i = 0; i < clases.length; i++) {
                var nombre = $(clases[i]).find("input");

                if (
                  nombre[0].id == "tirante_uno" ||
                  nombre[0].id == "presion" ||
                  nombre[0].id == "eq1"
                ) {
                  $(clases[i]).show();

                  $(clases[i]).find("input").prop("disabled", false);
                } else {
                  $(clases[i]).hide();

                  $(clases[i]).find("input").prop("disabled", true);
                }
              }

              //villsetValueOnLabelField("presion", 3500);

              for (var i = 0; i < columnas.length; i++) {
                var pasa = columnas[i];

                if (pasa[0] == 3 || pasa[0] == 12 || pasa[0] == 14) {
                  pasa.visible(true);
                } else {
                  pasa.visible(false);
                }
              }

              tabla.clear().draw();

              $.each(res.fechas_registradas, (key, value) => {
                addRow(value);
              });
            } else if (e.value == 20) {
              // Tirante, Vertedor, Descarga, Local y Bypass

              for (var i = 0; i < clases.length; i++) {
                var nombre = $(clases[i]).find("input");

                if (
                  nombre[0].id == "tirante_uno" ||
                  nombre[0].id == "vertedor" ||
                  nombre[0].id == "descarga_uno" ||
                  nombre[0].id == "local" ||
                  nombre[0].id == "bypass"
                ) {
                  $(clases[i]).show();

                  $(clases[i]).find("input").prop("disabled", false);
                } else {
                  $(clases[i]).hide();

                  $(clases[i]).find("input").prop("disabled", true);
                }
              }

              setValueOnLabelField("descarga_uno", 41);
              setValueOnLabelField("local", 4.5);
              setValueOnLabelField("bypass", 0);

              for (var i = 0; i < columnas.length; i++) {
                var pasa = columnas[i];

                if (
                  pasa[0] == 3 ||
                  pasa[0] == 7 ||
                  pasa[0] == 8 ||
                  pasa[0] == 11 ||
                  pasa[0] == 19
                ) {
                  pasa.visible(true);
                } else {
                  pasa.visible(false);
                }
              }

              tabla.clear().draw();

              $.each(res.fechas_registradas, (key, value) => {
                addRow(value);
              });
            } else if (e.value == 30) {
              // Tirante, Local

              for (var i = 0; i < clases.length; i++) {
                var nombre = $(clases[i]).find("input");

                if (nombre[0].id == "tirante_uno" || nombre[0].id == "local") {
                  $(clases[i]).show();
                  $(clases[i]).find("input").prop("disabled", false);
                } else {
                  $(clases[i]).hide();
                  $(clases[i]).find("input").prop("disabled", true);
                }
              }

              for (var i = 0; i < columnas.length; i++) {
                var pasa = columnas[i];

                if (pasa[0] == 3 || pasa[0] == 11) {
                  pasa.visible(true);
                } else {
                  pasa.visible(false);
                }
              }

              tabla.clear().draw();

              $.each(res.fechas_registradas, (key, value) => {
                addRow(value);
              });
            } else if (e.value == 33) {
              // Tirante, 2 Equipo

              for (var i = 0; i < clases.length; i++) {
                var nombre = $(clases[i]).find("input");

                if (
                  nombre[0].id == "tirante_uno" ||
                  nombre[0].id == "eq1" ||
                  nombre[0].id == "eq2"
                ) {
                  $(clases[i]).show();

                  $(clases[i]).find("input").prop("disabled", false);
                } else {
                  $(clases[i]).hide();

                  $(clases[i]).find("input").prop("disabled", true);
                }
              }

              for (var i = 0; i < columnas.length; i++) {
                var pasa = columnas[i];

                if (pasa[0] == 3 || pasa[0] == 14 || pasa[0] == 15) {
                  pasa.visible(true);
                } else {
                  pasa.visible(false);
                }
              }

              tabla.clear().draw();

              $.each(res.fechas_registradas, (key, value) => {
                addRow(value);
              });
            } else if (e.value == 37) {
              // Tirante, Descarga, Equipo

              for (var i = 0; i < clases.length; i++) {
                var nombre = $(clases[i]).find("input");

                if (
                  nombre[0].id == "tirante_uno" ||
                  nombre[0].id == "descarga_uno" ||
                  nombre[0].id == "eq1"
                ) {
                  $(clases[i]).show();

                  $(clases[i]).find("input").prop("disabled", false);
                } else {
                  $(clases[i]).hide();

                  $(clases[i]).find("input").prop("disabled", true);
                }
              }

              for (var i = 0; i < columnas.length; i++) {
                var pasa = columnas[i];

                if (pasa[0] == 3 || pasa[0] == 8 || pasa[0] == 14) {
                  pasa.visible(true);
                } else {
                  pasa.visible(false);
                }
              }

              tabla.clear().draw();

              $.each(res.fechas_registradas, (key, value) => {
                addRow(value);
              });
            } else if (e.value == 38 || e.value == 39) {
              // Tirante, Equipo

              for (var i = 0; i < clases.length; i++) {
                var nombre = $(clases[i]).find("input");

                if (nombre[0].id == "tirante_uno" || nombre[0].id == "eq1") {
                  $(clases[i]).show();

                  $(clases[i]).find("input").prop("disabled", false);
                } else {
                  $(clases[i]).hide();

                  $(clases[i]).find("input").prop("disabled", true);
                }
              }

              for (var i = 0; i < columnas.length; i++) {
                var pasa = columnas[i];

                if (pasa[0] == 3 || pasa[0] == 14) {
                  pasa.visible(true);
                } else {
                  pasa.visible(false);
                }
              }

              tabla.clear().draw();

              $.each(res.fechas_registradas, (key, value) => {
                addRow(value);
              });
            } else if (
              e.value == 25 ||
              e.value == 26 ||
              e.value == 29 ||
              e.value == 32
            ) {
              // Tirante

              for (var i = 0; i < clases.length; i++) {
                var nombre = $(clases[i]).find("input");

                if (nombre[0].id == "tirante_uno") {
                  $(clases[i]).show();

                  $(clases[i]).find("input").prop("disabled", false);
                } else {
                  $(clases[i]).hide();

                  $(clases[i]).find("input").prop("disabled", true);
                }
              }

              for (var i = 0; i < columnas.length; i++) {
                var pasa = columnas[i];

                if (pasa[0] == 3) {
                  pasa.visible(true);
                } else {
                  pasa.visible(false);
                }
              }

              tabla.clear().draw();

              $.each(res.fechas_registradas, (key, value) => {
                addRow(value);
              });
            } else if (
              e.value == 9 ||
              e.value == 10 ||
              e.value == 11 ||
              e.value == 12 ||
              e.value == 16 ||
              e.value == 17 ||
              e.value == 18
            ) {
              // Tirante, Vertedor, Descarga, Local

              for (var i = 0; i < clases.length; i++) {
                var nombre = $(clases[i]).find("input");

                if (
                  nombre[0].id == "tirante_uno" ||
                  nombre[0].id == "vertedor" ||
                  nombre[0].id == "descarga_uno" ||
                  nombre[0].id == "local"
                ) {
                  $(clases[i]).show();
                  $(clases[i]).find("input").prop("disabled", false);
                } else {
                  $(clases[i]).hide();
                  $(clases[i]).find("input").prop("disabled", true);
                }
              }

              if (e.value == 9) {
                setValueOnLabelField("local", 4.5);
              } else if (e.value == 10) {
                setValueOnLabelField("local", 11);
              } else if (e.value == 11) {
                setValueOnLabelField("local", 15);
              } else if (e.value == 12) {
                setValueOnLabelField("local", 26);
              } else if (e.value == 16) {
                setValueOnLabelField("descarga_uno", 16);
                setValueOnLabelField("local", 5);
              } else if (e.value == 17) {
                setValueOnLabelField("descarga_uno", 20);
                setValueOnLabelField("local", 3);
              } else if (e.value == 18) {
                setValueOnLabelField("descarga_uno", 5);
                setValueOnLabelField("local", 5.5);
              }

              for (var i = 0; i < columnas.length; i++) {
                var pasa = columnas[i];

                if (
                  pasa[0] == 3 ||
                  pasa[0] == 7 ||
                  pasa[0] == 8 ||
                  pasa[0] == 11
                ) {
                  pasa.visible(true);
                } else {
                  pasa.visible(false);
                }
              }
              tabla.clear().draw();

              $.each(res.fechas_registradas, (key, value) => {
                addRow(value);
              });
            } else if (
              e.value == 5 ||
              e.value == 8 ||
              e.value == 21 ||
              e.value == 22 ||
              e.value == 23
            ) {
              // Tirante, Vertedor, Descarga

              for (var i = 0; i < clases.length; i++) {
                var nombre = $(clases[i]).find("input");

                if (
                  nombre[0].id == "tirante_uno" ||
                  nombre[0].id == "vertedor" ||
                  nombre[0].id == "descarga_uno"
                ) {
                  $(clases[i]).show();
                  $(clases[i]).find("input").prop("disabled", false);
                } else {
                  $(clases[i]).hide();
                  $(clases[i]).find("input").prop("disabled", true);
                }
              }

              for (var i = 0; i < columnas.length; i++) {
                var pasa = columnas[i];

                if (pasa[0] == 3 || pasa[0] == 7 || pasa[0] == 8) {
                  pasa.visible(true);
                } else {
                  pasa.visible(false);
                }
              }

              tabla.clear().draw();

              $.each(res.fechas_registradas, (key, value) => {
                addRow(value);
              });
            } else if (
              e.value == 6 ||
              e.value == 14 ||
              e.value == 15 ||
              e.value == 19 ||
              e.value == 27 ||
              e.value == 28 ||
              e.value == 31 ||
              e.value == 34
            ) {
              // Tirante, Descarga

              for (var i = 0; i < clases.length; i++) {
                var nombre = $(clases[i]).find("input");

                if (
                  nombre[0].id == "tirante_uno" ||
                  nombre[0].id == "descarga_uno"
                ) {
                  $(clases[i]).show();
                  $(clases[i]).find("input").prop("disabled", false);
                } else {
                  $(clases[i]).hide();
                  $(clases[i]).find("input").prop("disabled", true);
                }
              }

              if (e.value == 6) {
                setValueOnLabelField("descarga_uno", 180);
              } else if (e.value == 14) {
                setValueOnLabelField("descarga_uno", 0.5);
              } else if (e.value == 15) {
                setValueOnLabelField("descarga_uno", 16);
              } else if (e.value == 19) {
                setValueOnLabelField("descarga_uno", 207);
              } else if (e.value == 34) {
                setValueOnLabelField("descarga_uno", 2020);
              }

              for (var i = 0; i < columnas.length; i++) {
                var pasa = columnas[i];

                if (pasa[0] == 3 || pasa[0] == 8) {
                  pasa.visible(true);
                } else {
                  pasa.visible(false);
                }
              }

              tabla.clear().draw();

              $.each(res.fechas_registradas, (key, value) => {
                addRow(value);
              });
            }

            swal.close();
          },
        });
      },
    });
  }
}

function setValueOnLabelField(id, value) {
  $(`#${id}`).next("label").addClass("active");
  $(`#${id}`).val(value);
}

function revisarTirante(e) {
  var tanqSel = document.getElementById("tanque_id").value;

  if (e.value !== "") {
    if (tanqSel == 33 || tanqSel == 38 || tanqSel == 39) {
      // 1 - 5

      if (e.value < 1) {
        swal({
          type: "warning",
          title: "¿Es correcto?",
          text: "Tirante ingresado: " + e.value + "m, menor común: 1m",
          showCancelButton: true,
          allowOutsideClick: false,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "No",
          focusConfirm: true,
          cancelButtonText: "Si",
          focusCancel: true,
          reverseButtons: true,
        }).then((res) => {
          res ? (e.value = "") : e.value;
        });
      } else if (e.value > 5) {
        swal({
          type: "error",
          title: "El tirante máximo permitido es de 5m.",
          showConfirmButton: true,
          allowOutsideClick: false,
        }).then(() => {
          e.value = "";
        });
      }
    } else if (tanqSel == 4 || tanqSel == 25 || tanqSel == 26) {
      // 3 - 5

      if (e.value < 3) {
        swal({
          type: "warning",
          title: "¿Es correcto?",
          text: "Tirante ingresado: " + e.value + "m, menor común: 1m",
          showCancelButton: true,
          allowOutsideClick: false,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "No",
          focusConfirm: true,
          cancelButtonText: "Si",
          focusCancel: true,
          reverseButtons: true,
        }).then((res) => {
          res ? (e.value = "") : e.value;
        });
      } else if (e.value > 5) {
        swal({
          type: "error",
          title: "El tirante máximo permitido es de 5m.",
          showConfirmButton: true,
          allowOutsideClick: false,
        }).then(() => {
          e.value = "";
        });
      }
    } else if (tanqSel == 5) {
      // 2 - 5

      if (e.value < 2) {
        swal({
          type: "warning",
          title: "¿Es correcto?",
          text: "Tirante ingresado: " + e.value + "m, menor común: 1m",
          showCancelButton: true,
          allowOutsideClick: false,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "No",
          focusConfirm: true,
          cancelButtonText: "Si",
          focusCancel: true,
          reverseButtons: true,
        }).then((res) => {
          res ? (e.value = "") : e.value;
        });
      } else if (e.value > 5) {
        swal({
          type: "error",
          title: "El tirante máximo permitido es de 5m.",
          showConfirmButton: true,
          allowOutsideClick: false,
        }).then(() => {
          e.value = "";
        });
      }
    } else if (tanqSel == 6 || tanqSel == 13) {
      // 0.75 - 3

      if (e.value < 0.75) {
        swal({
          type: "warning",
          title: "¿Es correcto?",
          text: "Tirante ingresado: " + e.value + "m, menor común: 0.75m",
          showCancelButton: true,
          allowOutsideClick: false,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "No",
          focusConfirm: true,
          cancelButtonText: "Si",
          focusCancel: true,
          reverseButtons: true,
        }).then((res) => {
          res ? (e.value = "") : e.value;
        });
      } else if (e.value > 3) {
        swal({
          type: "error",
          title: "El tirante máximo permitido es de 3m.",
          showConfirmButton: true,
          allowOutsideClick: false,
        }).then(() => {
          e.value = "";
        });
      }
    } else if (tanqSel == 7) {
      // 4.5 - 7.5

      if (e.value < 4.5) {
        swal({
          type: "warning",
          title: "¿Es correcto?",
          text: "Tirante ingresado: " + e.value + "m, menor común: 4.5m",
          showCancelButton: true,
          allowOutsideClick: false,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "No",
          focusConfirm: true,
          cancelButtonText: "Si",
          focusCancel: true,
          reverseButtons: true,
        }).then((res) => {
          res ? (e.value = "") : e.value;
        });
      } else if (e.value > 7.5) {
        swal({
          type: "error",
          title: "El tirante máximo permitido es de 7.5m",
          showConfirmButton: true,
          allowOutsideClick: false,
        }).then(() => {
          e.value = "";
        });
      }
    } else if (tanqSel == 31) {
      // 2 - 3

      if (e.value < 2) {
        swal({
          type: "warning",
          title: "¿Es correcto?",
          text: "Tirante ingresado: " + e.value + "m, menor común: 2m",
          showCancelButton: true,
          allowOutsideClick: false,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "No",
          focusConfirm: true,
          cancelButtonText: "Si",
          focusCancel: true,
          reverseButtons: true,
        }).then((res) => {
          res ? (e.value = "") : e.value;
        });
      } else if (e.value > 7.5) {
        swal({
          type: "error",
          title: "El tirante máximo permitido es de 3m",
          showConfirmButton: true,
          allowOutsideClick: false,
        }).then(() => {
          e.value = "";
        });
      }
    } else if (tanqSel == 19) {
      // 1 - 3

      if (e.value < 1) {
        swal({
          type: "warning",
          title: "¿Es correcto?",
          text: "Tirante ingresado: " + e.value + "m, menor común: 1m",
          showCancelButton: true,
          allowOutsideClick: false,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "No",
          focusConfirm: true,
          cancelButtonText: "Si",
          focusCancel: true,
          reverseButtons: true,
        }).then((res) => {
          res ? (e.value = "") : e.value;
        });
      } else if (e.value > 3) {
        swal({
          type: "error",
          title: "El tirante máximo permitido es de 3m",
          showConfirmButton: true,
          allowOutsideClick: false,
        }).then(() => {
          e.value = "";
        });
      }
    } else if (
      tanqSel == 14 ||
      tanqSel == 15 ||
      tanqSel == 16 ||
      tanqSel == 17 ||
      tanqSel == 18
    ) {
      // 2 - 6

      if (e.value < 2) {
        swal({
          type: "warning",
          title: "¿Es correcto?",
          text: "Tirante ingresado: " + e.value + "m, menor común: 6m",
          showCancelButton: true,
          allowOutsideClick: false,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "No",
          focusConfirm: true,
          cancelButtonText: "Si",
          focusCancel: true,
          reverseButtons: true,
        }).then((res) => {
          res ? (e.value = "") : e.value;
        });
      } else if (e.value > 7.5) {
        swal({
          type: "error",
          title: "El tirante máximo permitido es de 7.5m",
          showConfirmButton: true,
          allowOutsideClick: false,
        }).then(() => {
          e.value = "";
        });
      }
    } else if (
      tanqSel == 1 ||
      tanqSel == 6 ||
      tanqSel == 27 ||
      tanqSel == 28 ||
      tanqSel == 29 ||
      tanqSel == 32
    ) {
      // 3 - 6

      if (e.value < 3) {
        swal({
          type: "warning",
          title: "¿Es correcto?",
          text: "Tirante ingresado: " + e.value + "m, menor común: 3m",
          showCancelButton: true,
          allowOutsideClick: false,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "No",
          focusConfirm: true,
          cancelButtonText: "Si",
          focusCancel: true,
          reverseButtons: true,
        }).then((res) => {
          res ? (e.value = "") : e.value;
        });
      } else if (e.value > 6) {
        swal({
          type: "error",
          title: "El tirante máximo permitido es de 6m.",
          showConfirmButton: true,
          allowOutsideClick: false,
        }).then(() => {
          e.value = "";
        });
      }
    } else {
      // 1 - 6

      if (e.value < 1) {
        swal({
          type: "warning",
          title: "¿Es correcto?",
          text: "Tirante ingresado: " + e.value + "m, menor común: 3m",
          showCancelButton: true,
          allowOutsideClick: false,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "No",
          focusConfirm: true,
          cancelButtonText: "Si",
          focusCancel: true,
          reverseButtons: true,
        }).then((res) => {
          res ? (e.value = "") : e.value;
        });
      } else if (e.value > 6) {
        swal({
          type: "error",
          title: "El tirante máximo permitido es de 6m.",
          showConfirmButton: true,
          allowOutsideClick: false,
        }).then(() => {
          e.value = "";
        });
      }
    }
  }
}

const clearDataFields = () => {
  $("#tirante_uno").val("");
  $("#tirante_dos").val("");
  $("#tirante_tres").val("");
  $("#tirante_cuatro").val("");
  $("#vertedor").val("");
  $("#descarga_uno").val("");
  $("#descarga_dos").val("");
  $("#descarga_tres").val("");
  $("#local").val("");
  $("#presion").val("");
  $("#gasto").val("");
  $("#eq1").val("");
  $("#eq2").val("");
  $("#eq3").val("");
  $("#eq4").val("");
  $("#eq5").val("");
  $("#bypass").val("");
  $("#equipos").val("");

  $("#novedad").val("");
  $("#sin_novedad").prop("checked", false);
  sinNovedad(document.getElementById("novedad"));
};

function sinNovedad(e) {
  var x = document.getElementById("novedad");

  if (e.checked == true) {
    x.classList.add("disabled");
    x.value = "SIN NOVEDAD";
  } else {
    x.classList.remove("disabled");
    x.value = "";
  }
}

function addRow(e) {
  tabla.row
    .add([
      "<input type='hidden' value =" +
        (tabla.page.info().recordsTotal + 1) +
        ">" +
        (tabla.page.info().recordsTotal + 1),
      '<input type="hidden" value ="' + e.tanque + '">' + e.tanque,
      '<input type="hidden" value ="' +
        e.fecha_hora_programada +
        '">' +
        e.fecha_hora_programada,
      '<input type="hidden" value ="' +
        e.tirante_uno +
        '">' +
        e.tirante_uno +
        " m",
      '<input type="hidden" value ="' +
        e.tirante_dos +
        '">' +
        e.tirante_dos +
        " m",
      '<input type="hidden" value ="' +
        e.tirante_tres +
        '">' +
        e.tirante_tres +
        " m",
      '<input type="hidden" value ="' +
        e.tirante_cuatro +
        '">' +
        e.tirante_cuatro +
        " m",
      '<input type="hidden" value ="' + e.vertedor + '">' + e.vertedor,
      '<input type="hidden" value ="' + e.descarga_uno + '">' + e.descarga_uno,
      '<input type="hidden" value ="' + e.descarga_dos + '">' + e.descarga_dos,
      '<input type="hidden" value ="' +
        e.descarga_tres +
        '">' +
        e.descarga_tres,
      '<input type="hidden" value ="' + e.local + '">' + e.local,
      '<input type="hidden" value ="' + e.presion + '">' + e.presion,
      '<input type="hidden" value ="' + e.gasto + '">' + e.gasto,
      '<input type="hidden" value ="' + e.eq1 + '">' + e.eq1,
      '<input type="hidden" value ="' + e.eq2 + '">' + e.eq2,
      '<input type="hidden" value ="' + e.eq3 + '">' + e.eq3,
      '<input type="hidden" value ="' + e.eq4 + '">' + e.eq4,
      '<input type="hidden" value ="' + e.eq5 + '">' + e.eq5,
      '<input type="hidden" value ="' + e.bypass + '">' + e.bypass,
      '<input type="hidden" value ="' + e.equipos + '">' + e.equipos,
      '<input type="hidden" value ="' + e.transmite + '">' + e.transmite,
      '<input type="hidden" value ="' + e.novedad + '">' + e.novedad,
    ])
    .draw();

}
