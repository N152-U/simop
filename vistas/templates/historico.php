<?php
require_once "./controladores/historicoControlador.php";

$instancia = new historicoControlador();
$contenedorpozo = $instancia->obtener_puntos_historico_controlador();

//print_r($contenedorpozo);

?>

<main>
    <link rel="stylesheet" type='text/css' href="<?php echo SERVERURL; ?>vistas/assets/css/historico.css?v=<?php echo VERSION; ?>">
    <form id="formularioContrato" class="container" method="post" enctype="multipart/form-data">


        <div class="row" data-step="1" data-intro="Introduzca los datos del punto de monitoreo">

            <div class="input-field col s6">
               
                <select id="punto_id" name="punto_id" style="display: block" required>

                    <?php

                    foreach ($contenedorpozo as $key => $pozo) {

                        echo "<option value=" . $pozo["id"] . " disabled>" . $pozo["nombre_punto"]  . "</option>";
                    }

                    ?>

                </select>
                <label for="punto_id">Punto de Monitoreo</label>
            </div>

            <div class="input-field col s6" data-step="2s" data-intro="Introduzca los datos del punto de monitoreo">         
                <input placeholder="Y-M-D" type="text" id="daterange_historico" autocomplete="false" name="datetimes" required />
                <label for="daterange_historico" class="active">Seleccione un rango de fechas y horas</label>
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


        <div class="col s12">


            <table class="bordered highlight striped" id="tabla_historico" style="width: 100%;" data-step="5" data-intro="En esta tabla encontrará los artículos del contrato">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Punto de Monitoreo</th>
                        <th>Hora</th>
                        <th>Bomba</th>
                        <th>Presión</th>
                        <th>Tirante</th>
                        <th>Gasto (L/s)</th>
                        <th>Transmite</th>
                        <th>Observaciones</th>

                        </tr>
                    </thead>

                    <tbody>
                    </tbody>

            </table>
        </div>

    </form>
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
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datatables_vistas.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/historico.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datepicker.js?v=<?php echo VERSION; ?>"></script>
    
</main>