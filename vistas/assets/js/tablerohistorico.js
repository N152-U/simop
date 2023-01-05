var f = new Date();
var anio_actual = f.getFullYear();
var defs_select2 = {
  language: {
    noResults: function(params) {
      return "No se encontraron resultados";
    }
  }
};
var meses = [
  "ENERO",
  "FEBRERO",
  "MARZO",
  "ABRIL",
  "MAYO",
  "JUNIO",
  "JULIO",
  "AGOSTO",
  "SEPTIEMBRE",
  "OCTUBRE",
  "NOVIEMBRE",
  "DICIEMBRE"
];
var tabla = $("#tabla_historico").DataTable({
  columnDefs: [
    {
      className: "center-align",
      targets: "_all"
    }
  ],
  language: {
    sProcessing: "Procesando...",
    sLengthMenu: "Mostrar _MENU_ registros",
    sZeroRecords: "No se encontraron resultados",
    sEmptyTable: "Ningún dato disponible en esta tabla",
    sInfo:
      "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
    sInfoPostFix: "",
    sSearch: "Buscar:",
    sUrl: "",
    sInfoThousands: ",",
    sLoadingRecords: "Cargando...",
    oPaginate: {
      sFirst: "Primero",
      sLast: "último",
      sNext: "Siguiente",
      sPrevious: "Anterior"
    },
    oAria: {
      sSortAscending: ": Activar para ordenar la columna de manera ascendente",
      sSortDescending: ": Activar para ordenar la columna de manera descendente"
    },
    buttons: {
      copy: "Copiar",
      colvis: "Visibilidad"
    }
  }
});

$(document).ready(function() {
  $("#periodo_id").select2(defs_select2);
  $("#sistema_id").select2(defs_select2);

  $("#fecha_i").hide();
  $("#fecha_f").hide();

  $("#mes_anio_i").hide();
  $("#mes_mes_i").hide();
  $("#mes_anio_f").hide();
  $("#mes_mes_f").hide();  

  $("#anio_i").hide();
  $("#anio_f").hide();

  $(".dataTables_wrapper")
    .find("select")
    .formSelect();
});

$("#periodo_id").change(function(e) {

  $("#div_i > *").remove();
  $("#div_f > *").remove();

  $("#div_mes_anio_i > *").remove();
  $("#div_mes_mes_i > *").remove();
  $("#div_mes_anio_f > *").remove();
  $("#div_mes_mes_f > *").remove();  

  $("#div_anio_i > *").remove();
  $("#div_anio_f > *").remove();

  switch (parseInt(e.target.value)) {
    case 1:

      $("#anio_i").hide();
      $("#anio_f").hide();

      $("#mes_anio_i").hide();
      $("#mes_mes_i").hide();
      $("#mes_anio_f").hide();
      $("#mes_mes_f").hide();  

      $("#fecha_i").show();
      $("#fecha_f").show();
      
      $("#div_i").append(
        '<input type="text" class="datepicker" autocomplete="off" id="fecha_inicial" name="fecha_inicial" required>'
      );
      $("#div_f").append(
        '<input type="text" class="datepicker" autocomplete="off" id="fecha_final" name="fecha_final" required>'
      );
      $(".datepicker").datepicker(defs_picker);
      $("#fecha_inicial").change(function(e) {});
      break;

    case 2:

      $("#fecha_i").hide();
      $("#fecha_f").hide();

      $("#anio_i").hide();
      $("#anio_f").hide();

      $("#mes_anio_i").show();
      $("#mes_mes_i").show();
      $("#mes_anio_f").show();
      $("#mes_mes_f").show();  

      $("#div_mes_anio_i").append(
        '<select id="anio_inicial" name="anio_inicial" required></select>'
      );
      $("#div_mes_anio_f").append(
        '<select id="anio_final" name="anio_final" required></select>'
      );
      $("#anio_inicial").append(
        '<option value="" disabled selected>Selecciona un Año Inicial</option>'
      );
      $("#anio_final").append(
        '<option value="" disabled selected>Selecciona un Año Final</option>'
      );

      for (let anio = 1999; anio <= anio_actual; anio++) {
        $("#anio_inicial").append(
          '<option value="' + anio + '">' + anio + "</option>"
        );
        $("#anio_final").append(
          '<option value="' + anio + '">' + anio + "</option>"
        );
      }

      $("#anio_inicial").select2(defs_select2);
      $("#anio_final").select2(defs_select2);

      $("#div_mes_mes_i").append(
        '<select id="mes_inicial" name="mes_inicial" required></select>'
      );
      $("#div_mes_mes_f").append(
        '<select id="mes_final" name="mes_final" required></select>'
      );
      $("#mes_inicial").append(
        '<option value="" disabled selected>Selecciona un Mes Inicial</option>'
      );
      $("#mes_final").append(
        '<option value="" disabled selected>Selecciona un Mes Final</option>'
      );

      for (let i = 0; i < meses.length; i++) {
        $("#mes_inicial").append(
          '<option value="' + (i+1) + '">' + meses[i] + "</option>"
        );
        $("#mes_final").append(
          '<option value="' + (i+1) + '">' + meses[i] + "</option>"
        );
      }

      $("#mes_inicial").select2(defs_select2);
      $("#mes_final").select2(defs_select2);
      break;

    case 3:

      $("#fecha_i").hide();
      $("#fecha_f").hide();

      $("#mes_anio_i").hide();
      $("#mes_mes_i").hide();
      $("#mes_anio_f").hide();
      $("#mes_mes_f").hide();  

      $("#anio_i").show();
      $("#anio_f").show();

      $("#div_anio_i").append(
        '<select id="anio_inicial" name="anio_inicial" required></select>'
      );
      $("#div_anio_f").append(
        '<select id="anio_final" name="anio_final" required></select>'
      );
      $("#anio_inicial").append(
        '<option value="" disabled selected>Selecciona un Año Inicial</option>'
      );
      $("#anio_final").append(
        '<option value="" disabled selected>Selecciona un Año Final</option>'
      );

      for (let anio = 1999; anio <= anio_actual; anio++) {
        $("#anio_inicial").append(
          '<option value="' + anio + '">' + anio + "</option>"
        );
        $("#anio_final").append(
          '<option value="' + anio + '">' + anio + "</option>"
        );
      }

      $("#anio_inicial").select2(defs_select2);
      $("#anio_final").select2(defs_select2);
      break;

    default:
      break;
  }
});

$("#ayuda").click(function() {
  introJs().start();
});

$("form").on("submit", function(e) {
  e.preventDefault();
  var sistema_id = $("#sistema_id").val();
  var sistema;
  switch (parseInt(sistema_id)) {
    case 1:
      sistema = "Lerma";
      break;
    case 2:
      sistema = "Cutzamala";
      break;
    case 3:
      sistema = "Atarasquillo";
      break;

    default:
      break;
  }

  var formulario = $(e.currentTarget).serializeArray(); //Convierte a los campos que forman parte del formulario en un arreglo indexado
  formulario.push({
    name: "accion",
    value: "CONSULTAR"
  }); //Añadimos el parametro para la accion que tomara del modelo
  //Añadimos el parametro para la accion que tomara del modelo
  $.ajax({
    url: serverurl + "ajax/historicoSistemasAjax.php",
    method: "post",
    data: $.param(formulario),
    success: function(res) {
      res = JSON.parse(res);
      tabla.clear().draw();
      $.each(res, function(key, value) {
        addRow(sistema, value.fecha_sis, value.sistema);
      });
    }
  });
});

function addRow(sistema, fecha, gasto) {
  tabla.row
    .add([fecha, sistema, gasto, parseFloat(gasto * 86.4).toFixed(2)])
    .draw();
}
