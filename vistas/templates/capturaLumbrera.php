<?php
require_once "./controladores/CapturaLumbreraControlador.php";
$data_url = explode("/", $_GET["vistas"]);

?>
<main>

<link rel="stylesheet" type='text/css' href="<?php echo SERVERURL; ?>vistas/assets/css/captura.css?v=<?php echo VERSION; ?>">


    <div class="container">
        <form id="formularioCapturaLumbrera" method="post" enctype="multipart/form-data">

            <div class="row" data-step="1" data-step="2" data-intro="Introduzca los datos del lumbrera de monitoreo">

                <div   data-intro="Elija la lumbrera de monitoreo">
                    <div class="col s2">
                        <b>Lumbrera de Monitoreo:</b>
                    </div>
                    <div class="col s10">
                        <select id="lumbrera_id" name="lumbrera_id" style="display: block" required>
                            <option selected disabled></option>

                            <?php

                            foreach ($contenedorlumbreras as $key => $lumbrera) {

                                echo "<option value=" . $lumbrera["id"] . " disabled>" . $lumbrera["nombre_lumbrera"]." (ultimas ".$lumbrera["cuenta"]." horas sin registrar) </option>";
                            }

                            ?>

                        </select>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col s2">
                    <b>Fecha Programada:</b>
                </div>
                <div class="col s10">
                    <select id="hora_programada" name="fecha_hora_programada" style="display: block" required>

                    </select>
                </div>


            </div>


            <div class="row">
                <div class="col s2">
                    <b>Tirante (m):</b>
                </div>
                <div class="col s4">
                    <input type="number" oninput="calculaGasto(this)" id="tirante" name="tirante" step="0.01" class=""  value="<?php echo isset($datospozo["tirante"]) ? $datospozo["tirante"] : ""; ?>" required>
                </div>
                <div class="col s6">
                    <label>
                        <input id="check_desc_compuertas" name="compuertas" type="checkbox" class="filled-in">
                        <span>COMPUERTAS CERRADAS</span>
                    </label>
                </div>
            </div>
           
            <div class="row" id="gasto_contenedor">
                <div class="col s2">
                    <b> Gasto [L/s]</b>:
                </div>
                <div class="col s10">
                    <input type="number" id="gasto" name="gasto" step="0.00001" class="" value="<?php echo isset($datospozo["gasto"]) ? $datoscontrato["gasto"] : ""; ?>" readonly>
                </div>
            </div>
            
            <div class="row" id="transmitio_contenedor">
                <div class="col s2">
                    <b>Transmite:</b>
                </div>
                <div class="col s10">
                    <select id="transmitio" name="usuario_id" style="display: block">
                        <option selected disabled></option>
                        <?php

                        foreach ($contenedorUsuarios as $key => $usuario) {

                            echo "<option value=" . $usuario["id"] . ">" . $usuario["nombre_completo"]  . "</option>";
                        }

                        ?>
                    </select>

                </div>
            </div>

            <div class="row">
                <div class="col s2">
                    <b>Novedades:</b>
                </div>


                <div class="col s8 m8 l8">

                    <textarea onkeyup="withSelectionRange(this)" id="desc_novedades" name="novedades" type="text" class="materialize-textarea" data-length="300" cols="15" rows="15" placeholder="" required></textarea>

                </div>
                <div class="col s2">
                    <label>
                        <input id="check_desc_novedades" type="checkbox" class="filled-in">
                        <span>SIN NOVEDAD</span>
                    </label>
                </div>

            </div>
         
            <div class="row" data-step="4" data-intro="Al llenar los campos anteriores, presione la botón (podra repetir estos pasos para agregar más)">
                <div class="col s12 center-align">
                    <input id="submit" class="btn buttons-creacion" name="submit" type="submit" value="REGISTRAR">
                </div>
            </div>

            <div class="col s12">
                <table class="bordered highlight striped" id="tabla_captura" style="width: 100%;" data-step="5" data-intro="En esta tabla encontrará los artículos del contrato">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Lumbrera de Monitoreo</th>
                            <th>Hora</th>
                            <th>Tirante (m)</th>
                            <th>Compuertas</th>
                            <th>Transmite</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </form>
    </div>

    <!-- <div id="example"></div> -->
<script src="https://cdn.jsdelivr.net/npm/handsontable@latest/dist/handsontable.full.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable@latest/dist/handsontable.full.min.css">
<script>
/**
 * The cell type adds supports for displaing the label value except the key in the key-value
 * dropdown editor type.
 */
class KeyValueListEditor extends Handsontable.editors.HandsontableEditor {
  prepare(row, col, prop, td, value, cellProperties) {
    super.prepare(row, col, prop, td, value, cellProperties);

    Object.assign(this.htOptions, {
      data: this.cellProperties.source,
      columns: [
        {
          data: '_id',
        },
        {
          data: 'label',
        },
      ],
      hiddenColumns: {
        columns: [1],
      },
      colWidths: cellProperties.width - 1,
      beforeValueRender(value, { row, instance }) {
        return instance.getDataAtRowProp(row, 'label');
      },
    });

    if (cellProperties.keyValueListCells) {
      this.htOptions.cells = cellProperties.keyValueListCells;
    }
    if (this.htEditor) {
      this.htEditor.destroy();
    }

    this.htEditor = new Handsontable(this.htContainer, this.htOptions);
  }
  
  setValue(value) {
    if (this.htEditor) {
      const index = this.htEditor.getDataAtProp('_id').findIndex(id => id === value);

      if (index !== -1) {
        value = this.htEditor.getDataAtRowProp(index, 'label');
      }
    }
    super.setValue(value);
  }
  
  getValue() {
    const value = super.getValue();

    if (this.htEditor) {
      const labels = this.htEditor.getDataAtProp('label');
      const row = labels.indexOf(value);

      if (row !== -1) {
        return this.htEditor.getDataAtRowProp(row, '_id');
      }
    }

    return value;
  }
}

const keyValueListValidator = function(value, callback) {
  let valueToValidate = value;

  if (valueToValidate === null || valueToValidate === void 0) {
    valueToValidate = '';
  }

  if (this.allowEmpty && valueToValidate === '') {
    callback(true);
  } else {
    callback(this.source.find(({ _id }) => _id === value) ? true : false);
  }
};
const keyValueListRenderer = function(table, TD, row, col, prop, value, cellProperties) {
  const item = cellProperties.source.find(({ _id }) => _id === value);
  
  if (item) {
    value = item.label;
  }
  
  Handsontable.renderers.getRenderer('autocomplete').call(table, table, TD, row, col, prop, value, cellProperties);
};

Handsontable.cellTypes.registerCellType('key-value-list', {
  editor: KeyValueListEditor,
  validator: keyValueListValidator,
  renderer: keyValueListRenderer,
});

const horas=["07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00", "00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00"];
const indice=[
    {group: "EMISOR_CENTRAL",header_title:"LUMBRERA 0", key: "LUMBRERA0",variable: "", },
    {group: "EMISOR_CENTRAL",header_title:"PORTAL DE SALIDA", key: "LUMBRERA0",variable: "", },
    {group: "EMISOR_CENTRAL",header_title:"COMPUERTAS", key: "LUMBRERA0",variable: "", },
    {group: "INTERCEPTOR CENTRAL",header_title:"RIO REMEDIOS", key: "RIOREMEDIOS",variable: "", },
    {group: "INTERCEPTOR CENTRAL",header_title:"COMPUERTAS", key: "RIOREMEDIOS",variable: "", },
    {group: "INTERCEPTOR CENTRAL",header_title:"RIO TLALNEPANTLA", key: "RIOTLALNEPANTLA",variable: "", },
    {group: "INTERCEPTOR CENTRAL",header_title:"COMPUERTAS", key: "RIOTLALNEPANTLA",variable: "", },
    {group: "INTERCEPTOR CENTRAL",header_title:"LUMBRERA 9", key: "LUMBRERA9",variable: "", },
    {group: "INTERCEPTOR CENTRO PONIENTE", header_title:"LUMBRERA 9C", key: "LUMBRERA9C",variable: "", },
    {group: "INTERCEPTOR CENTRO PONIENTE", header_title:"", key: "",variable: "", },
    {group: "INTERCEPTOR CENTRO PONIENTE", header_title:"", key: "",variable: "", },
    {group: "INTERCEPTOR CENTRO PONIENTE", header_title:"", key: "",variable: "", },
    {group: "INTERCEPTOR CENTRO PONIENTE", header_title:"", key: "",variable: "", },
    {group: "INTERCEPTOR CENTRO PONIENTE", header_title:"", key: "",variable: "", },
    {group: "INTERCEPTOR ORIENTE", header_title:"", key: "",variable: "", },
    {group: "INTERCEPTOR ORIENTE", header_title:"", key: "",variable: "", },
    {group: "INTERCEPTOR ORIENTE", header_title:"", key: "",variable: "", },
    {group: "INTERCEPTOR ORIENTE", header_title:"", key: "",variable: "", },
    {group: "INTERCEPTOR ORIENTE SUR", header_title:"", key: "",variable: "", },
    {group: "INTERCEPTOR ORIENTE SUR", header_title:"", key: "",variable: "", },
    {group: "INTERCEPTOR ORIENTE SUR", header_title:"", key: "",variable: "", },
    {group: "PRESAS DEL PONIENTE", header_title:"", key: "",variable: "", },
    {group: "PRESAS DEL PONIENTE", header_title:"", key: "",variable: "", },
    {group: "PRESAS DEL PONIENTE", header_title:"", key: "",variable: "", },
    {group: "PRESAS DEL PONIENTE", header_title:"", key: "",variable: "", },
    {group: "PRESAS DEL PONIENTE", header_title:"", key: "",variable: "", },
    {group: "PRESAS DEL PONIENTE", header_title:"", key: "",variable: "", },
    {group: "PRESAS DEL PONIENTE", header_title:"", key: "",variable: "", },
    {group: "PRESAS DEL PONIENTE", header_title:"", key: "",variable: "", },
    {group: "PRESAS DEL PONIENTE", header_title:"", key: "",variable: "", },
    {group: "PRESAS DEL PONIENTE", header_title:"", key: "",variable: "", },
    {group: "PRESAS DEL PONIENTE", header_title:"", key: "",variable: "", },
    {group: "PRESAS DEL PONIENTE", header_title:"", key: "",variable: "", },
    {group: "PLANTA DE BOMBEO", header_title:"P.B. ZARAGOZA", key: "",variable: "", },
    {group: "PLANTA DE BOMBEO", header_title:"", key: "",variable: "", },
    {group: "PLANTA DE BOMBEO", header_title:"", key: "",variable: "", },
    {group: "PLANTA DE BOMBEO", header_title:"", key: "",variable: "", },
    {group: "PLANTA DE BOMBEO", header_title:"", key: "",variable: "", },
    {group: "PLANTA DE BOMBEO", header_title:"", key: "",variable: "", },
    {group: "PLANTA DE BOMBEO", header_title:"", key: "",variable: "", },
    {group: "PLANTA DE BOMBEO", header_title:"", key: "",variable: "", },
    {group: "PLANTA DE BOMBEO", header_title:"", key: "",variable: "", },
    {group: "PLANTA DE BOMBEO", header_title:"", key: "",variable: "", },
    {group: "PLANTA DE BOMBEO", header_title:"", key: "",variable: "", },
    {group: "PLANTA DE BOMBEO", header_title:"", key: "",variable: "", },
    {group: "PLANTA DE BOMBEO", header_title:"", key: "",variable: "", },
    {group: "PLANTA DE BOMBEO", header_title:"", key: "",variable: "", },
    {group: "PLANTA DE BOMBEO", header_title:"", key: "",variable: "", },
    {group: "PLANTA DE BOMBEO", header_title:"", key: "",variable: "", },
    {group: "PLANTA DE BOMBEO", header_title:"", key: "",variable: "", },
];


const example = document.getElementById('example');
var options = {
  'mit' : 'Misubishi',
  'che' : 'Chevrolet',
  'lam' : 'Lamborgini'
};
const table = new Handsontable(example, {
    columns: [
    {},
    { type: 'numeric' },
    {
      type: 'dropdown',
      source: ['yellow', 'red', 'orange', 'green', 'blue', 'gray', 'black', 'white']
    },
    {
      type: 'dropdown',
      source: ['yellow', 'red', 'orange', 'green', 'blue', 'gray', 'black', 'white']
    }
  ],
  data: [
    ['Tesla', 2017, 'black', 'black'],
    ['Nissan', 2018, 'blue', 'blue'],
    ['Chrysler', 2019, 'yellow', 'black'],
    ['Volvo', 2020, 'white', 'gray']
  ],
  licenseKey: 'non-commercial-and-evaluation',
  colWidths: 100,
  width: '100%',
  height: 320,
  rowHeights: 23,
  rowHeaders: true,
  colHeaders: true,
  afterChange(changes) {
      console.log('cambios detectados',changes)
    if (!changes) {
    	return;
    }

		console.log(this.getDataAtCell(changes[0][0],changes[0][1]));
        console.log('renglon',changes[0][0],'columna', changes[0][1], 'valor anterior',changes[0][2],'valor actual', changes[0][3] )
  },
  type: 'key-value-list',
  source: [
  	{_id: 1, label: 'A'},
    {_id: 2, label: 'C'},
  ]
});

</script>

<script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datepicker.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datatables_vistas.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/capturaLumbrera.js?v=<?php echo VERSION; ?>"></script>

</main>