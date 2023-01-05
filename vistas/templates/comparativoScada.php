<?php
require_once "./controladores/comparativoScadaControlador.php";
$instanciaComparativoScada = new comparativoScadaControlador();
?>

<main>
    <div class="container">

        <div class="section">
            <h3>Ultimos Datos</h3>
            <div class="col s12">
                <table class="bordered highlight striped" id="tabla_comparacion_scada" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Punto o Tanque</th>
                            <th>Propiedad</th>
                            <th>Bitacora Fecha</th>
                            <th>Bitacora Valor</th>
                            <th>SCADA Fecha</th>
                            <th>SCADA Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="section">
            <h3>Grafica</h3>
            <form id="formularioTablero" method="post" enctype="multipart/form-data">
                <div class="row" data-step="1" data-intro="Introduzca los datos del punto de monitoreo">
                    <input id="propiedad" name="propiedad" type="hidden" value="" required>
                    <div class="input-field col s12 m6">
                        <select id="tabla_comparativo" name="tabla_comparativo" style="display: block" required>
                            <option selected disabled></option>
                            <option value="1">Puntos</option>
                            <option value="2">Tanques</option>
                            <option value="3">Subestaciones</option>

                        </select>
                        <label for="tabla_comparativo">Eliga la tabla</label>
                    </div>

                    <div class="input-field col s12 m6">
                        <select id="registro_id" name="registro_id" style="display: block" required>
                        </select>
                        <label for="registro_id">Eliga el registro</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <select id="propiedad_id" name="propiedad_id" style="display: block" required>
                        </select>
                        <label for="propiedad_id">Eliga la propiedad</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input placeholder="Y-M-D" autocomplete="false" type="text" id="daterange_scada" name="datetimes" required />
                        <label>Fecha Programada</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 center-align">
                        <button id="submit" class="btn buttons-creacion" name="submit" type="submit" value="CONSULTAR">
                            CONSULTAR <i class="material-icons left white-text">search</i>
                        </button>
                    </div>
                </div>
            </form>
            <figure class="highcharts-figure">
                <div id="grafica_comparativa_scada"></div>
            </figure>
        </div>

    </div>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datatables_vistas.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datepicker.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/highcharts.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/data.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/drilldown.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/exporting.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/export-data-8.0.4.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/standalone.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/accessibility.js"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/comparativoScada.js?v=<?php echo VERSION; ?>"></script>
</main>