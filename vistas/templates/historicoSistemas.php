<?php

require_once "./controladores/historicoSistemasControlador.php";

$instancia = new historicoSistemasControlador();
$contenedorsistemas = $instancia->obtener_sistemas_controlador();

//print_r($contenedorsistemas);

?>

<main>

    <form id="formularioContrato" class="container" method="post" enctype="multipart/form-data">
        <div class="row">

            <div class="col s12 m12 l12">

                <div class="input-field col s6 m6 l6" data-step="1" data-intro="Introduzca el sistema a monitorear">
                   

                    <select id="sistema_id" name="sistema_id" style="display: block" required>

                        <?php

                        foreach ($contenedorsistemas as $key => $sistema) {

                            echo "<option value=" . $sistema["id"] . " disabled>" . $sistema["nombre_sistema"]  . "</option>";
                        }

                        ?>

                    </select>

                    <label for="sistema_id">Sistema de Monitoreo</span>
                </div>

                <div class="input-field col s6 m6 l6" data-step="2" data-intro="Elija el periodo de monitoreo">
                  
                    <select id="periodo_id" name="periodo_id" style="display: block" required>
                        <option value="1">Diario</option>
                        <option value="2">Mensual</option>
                        <option value="3">Anual</option>
                    </select>
                    <label for="periodo_id">Periodo de Monitoreo</span>
                </div>

            </div>

            <div class="col s12 m12 l12">
                <div class="input-field col s12 m12 l12" data-step="2" data-intro="Elija el periodo de monitoreo">                
                    <!-- PARA FECHA COMPLETA -->
                    <input placeholder="Y-m-d" type="text" id="daterange_diario_historico_sistemas" autocomplete="false" name="datetimes" required />
                    <!-- PARA MESES -->
                    <input placeholder="Y-m-d" type="text" id="daterange_meses_historico_sistemas" autocomplete="false" name="datetimes" required />
                    <!-- PARA AÑOS -->
                    <input placeholder="Y-m-d" type="text" id="daterange_anios_historico_sistemas" autocomplete="false" name="datetimes" required />
                    <label for="daterange"><b>Seleccione un rango de fechas y horas</b></span>
                </div>

            </div>
        </div>
        <div class="row" data-step="7" data-intro="Una vez ingresada la información, podra decidir entre guardar o dejar como borrador el contrato">

            <div class="col s6 center-align">
                <button id="submit" class="btn buttons-creacion" name="submit" type="submit">
                    CONSULTAR <i class="material-icons left white-text">search</i>
                </button>
            </div>
            <div class="col s6 center-align">
                <button id="excel" class="btn buttons-creacion" name="excel" type="submit">
                    DESCARGAR EXCEL <i class="material-icons left white-text">insert_drive_file</i>
                </button>
            </div>

        </div>
        <figure class="highcharts-figure">
            <div class="container-fluid" id="container"> </div>
        </figure>
        <div id="min_scale_yAxis_container" class="row" data-step="8" data-intro="Una vez ingresada la información, podra decidir entre guardar o dejar como borrador el contrato" hidden>

            <div class="col s4 center-align offset-s2">
                <span><b>Valor mínimo para el eje de las ordenadas:</b></span>

            </div>
            <div class="col s2 center-align">

                <input id="min_scale_yAxis_input" min="0" class="" type="number" value="0" />
            </div>


        </div>



        <div class="col s12 m12 l12">
            <table class="bordered highlight striped" id="tabla_historico_sistemas" style="width: 100%;" data-step="6" data-intro="En esta tabla encontrar&aacute; los puntos de medicion">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Punto de Monitoreo</th>
                        <th>Gasto en Litros (L/s)</th>
                        <th>Gasto en Metros C&uacute;bicos (m<sup>3</sup>)</th>

                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </form>

    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datatables_vistas.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/historicoSistemas.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datepicker.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/shim.min.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/xlsx.full.min.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/Blob.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/FileSaver.js"></script>

    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/highcharts.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/data.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/exporting.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/export-data-8.0.4.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/accessibility.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/standalone.js"></script>
</main>