<?php
require_once "./controladores/subestacionesControlador.php";
require_once "./controladores/histSubControlador.php";
$data_url = explode("/", $_GET["vistas"]);

    $instancia_subestaciones = new subestacionesControlador();
    $contenedor_subestaciones = $instancia_subestaciones -> obtener_subestaciones_controlador();

?>
<main>
<link rel="stylesheet" type='text/css' href="<?php echo SERVERURL; ?>vistas/assets/css/historico.css">

    <form id="form_historico_subestacion" class="container" method="post" enctype="multipart/form-data">

        <div class="row" data-step="1" data-intro="Introduzca los datos del punto de monitoreo">

            <div class="input-field col s6">
                <select id="subestacion_id" name="subestacion_id" style="display: block" required>
                    <option selected disabled></option>

                    <?php

                        foreach ($contenedor_subestaciones as $key => $subestacion) {

                            echo "<option value=" . $subestacion["id"] . " disabled>" . $subestacion["subestacion"]  . "</option>";

                        }

                    ?>

                </select>
                <label for="subestacion_id">Subestaci&oacute;n El&eacute;ctrica</label>
            </div>

            <div class="input-field col s6">
                <input placeholder="Y-M-D" type="text" id="daterange_historico" autocomplete="false" name="datetimes" />
                <label >Seleccione un rango de fechas y horas</label>
            </div>

        </div>

        <div class="row">

            <div class="col s6 center-align">
                <button id="submit" class="btn buttons-creacion" name="submit" type="submit" value="CONSULTAR">
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
            <div class="container-fluid" id="grafica_subestaciones"> </div>
        </figure>

        <div class="col s12">


            <table class="bordered highlight striped" id="tabla_historico_sub" style="width: 100%;" data-step="5" data-intro="En esta tabla encontrará los artículos del contrato">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subestaci&oacute;n El&eacute;ctrica</th>
                        <th>Fecha</th>
                        <th>Amperaje</th>
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
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/histSub.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datepicker.js?v=<?php echo VERSION; ?>"></script>

</main>