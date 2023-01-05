<?php
require_once "./controladores/tanqueControlador.php";

    $instancia = new tanqueControlador();
    $contenedor_tanques = $instancia -> obtener_tanques_controlador();

    // print_r($contenedor_tanques);

?>

<main>

<style>

    .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    }

    .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
    }

    .tab button:hover {
    background-color: #ddd;
    }

    .tab button.active {
    background-color: #ccc;
    }

</style>

    <link rel="stylesheet" type='text/css' href="<?php echo SERVERURL; ?>vistas/assets/css/historico.css">

    <form id="form_historico_tanque" class="container" method="post" enctype="multipart/form-data">


        <div class="row" data-step="1" data-intro="Introduzca los datos del punto de monitoreo">

            <div class="input-field col s6">
                <select id="tanque_id" name="tanque_id" style="display: block" required>
                    <option selected disabled></option>

                    <?php

                        foreach ($contenedor_tanques as $key => $tanque) {

                            echo "<option value=" . $tanque["id"] . " disabled>" . $tanque["tanque"]  . "</option>";

                        }

                    ?>

                </select>
                <label for="tanque_id">Tanque</label>
            </div>

            <div class="input-field col s6" data-step="2s" data-intro="Introduzca los datos del punto de monitoreo">
                <input placeholder="Y-M-D" type="text" id="daterange_historico" autocomplete="false" name="datetimes" />
                <label >Seleccione un rango de fechas y horas</label>
            </div>

        </div>

        <div class="row">

            <div class="col s6 center-align">
                <button id="submit" class="btn buttons-creacion" name="submit" type="submit">
                    CONSULTAR <i class="material-icons left white-text">search</i>
                </button>
            </div>

            <div class="col s6 center-align">
                <button class="btn buttons-creacion" id="excel" name="excel" type="submit">
                    DESCARGAR EXCEL <i class="material-icons left white-text">insert_drive_file</i>
                </button>
            </div>

        </div>

        <div id="div-tabs" name="div-tabs" class="tab" hidden></div>

        <div style="border: 1px solid #d9d9d9">

            <div id="div-grafica-uno" name="div-grafica-uno" class="tabcontent" hidden>
                <figure class="highcharts-figure">
                    <div class="container-fluid" id="grafica_uno"> </div>
                </figure>
            </div>

            <div id="div-grafica-dos" name="div-grafica-dos" class="tabcontent" hidden>
                <figure class="highcharts-figure">
                    <div class="container-fluid" id="grafica_dos"> </div>
                </figure>
            </div>

            <div id="div-grafica-tres" name="div-grafica-tres" class="tabcontent" hidden>
                <figure class="highcharts-figure">
                    <div class="container-fluid" id="grafica_tres"> </div>
                </figure>
            </div>

            <div id="div-grafica-cuatro" name="div-grafica-cuatro" class="tabcontent" hidden>
                <figure class="highcharts-figure">
                    <div class="container-fluid" id="grafica_cuatro"> </div>
                </figure>
            </div>

            <div id="div-grafica-cinco" name="div-grafica-cinco" class="tabcontent" hidden>
                <figure class="highcharts-figure">
                    <div class="container-fluid" id="grafica_cinco"> </div>
                </figure>
            </div>

            <div id="div-grafica-seis" name="div-grafica-seis" class="tabcontent" hidden>
                <figure class="highcharts-figure">
                    <div class="container-fluid" id="grafica_seis"> </div>
                </figure>
            </div>
        
        </div>

        <div class="col s12">
            <table class="bordered highlight striped" id="tabla_historico_tanque" style="width: 100%;" data-step="5" data-intro="En esta tabla encontrará los artículos del contrato">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanque</th>
                        <th>Fecha</th>

                        <!-- 3 -->
                        <th>Tirante Tanque #1 (m)</th>
                        <!-- 4 -->
                        <th>Tirante Tanque #2 (m)</th>
                        <!-- 5 -->
                        <th>Tirante Tanque #3 (m)</th>
                        <!-- 6 -->
                        <th>Tirante Tanque #4 (m)</th>
                        <!-- 7 -->
                        <th>Vertedor</th>
                        <!-- 8 -->
                        <th>Descarga</th>
                        <!-- 9 -->
                        <th>2da Descarga</th>
                        <!-- 10 -->
                        <th>3er Descarga</th>
                        <!-- 11 -->
                        <th>Local</th>
                        <!-- 12 -->
                        <th>Presion</th>
                        <!-- 13 -->
                        <th>Gasto</th>
                        <!-- 14 -->
                        <th>Equipo Operativo</th>
                        <!-- 15 -->
                        <th>2do Equipo Operativo</th>
                        <!-- 16 -->
                        <th>3er Equipo Operativo</th>
                        <!-- 17 -->
                        <th>4to Equipo Operativo</th>
                        <!-- 18 -->
                        <th>5to Equipo Operativo</th>
                        <!-- 19 -->
                        <th>Bypass</th>
                        <!-- 20 -->
                        <th>Equipos</th>

                        <th>Transmite</th>
                        <th>Novedad</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <?php echo SERVERURL; ?>
        </div>

    </form>

    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datatables_vistas.js"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/histTanque.js"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datepicker.js"></script>

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