<?php
require_once "./controladores/graficaRiegoControlador.php";
$instanciatablero = new graficaRiegoControlador();
$url = $_SERVER["REQUEST_URI"];
$url_components = parse_url($url);
parse_str($url_components['query'], $params);
$contenedorresumenriego = $instanciatablero->obtener_resumen_riego_controlador($params['anio']);
$contenedorgastodiarioriego = $instanciatablero->obtener_gasto_diario_riego_controlador($params['anio']);
?>
<style>
    #contenedor {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }

    #principal {
        width: 75%;
    }

    #sidebar {
        width: 25%;
    }
</style>
<main>

    <link rel="stylesheet" type='text/css'
        href="<?php echo SERVERURL; ?>vistas/assets/css/tablero.css?v=<?php echo VERSION; ?>">
    <link rel="stylesheet" type='text/css'
        href="<?php echo SERVERURL; ?>vistas/assets/css/reporteSistemas.css?v=<?php echo VERSION; ?>">
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/data.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/drilldown.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/exporting.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/export-data-8.0.4.js">
    </script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/accessibility.js"></script>

    <div class="container">
        <div>

        </div>


        <div class="row comparativa-tablero" id="row_comparativa_tablero">
            <div id="tab_comparativa_tablero_totales" class="col s12 tab-contenedor">
                <figure class="highcharts-figure">
                    <div id="grafica_comparativa_tablero_totales"></div>
                </figure>
               

            </div>
        </div>
        
        <div id="contenedor">
            <div id="principal">
            <table border="1" class="bordered highlight striped" id="tabla_captura" style="width: 100%;" data-step="5"
            data-intro="En esta tabla encontrará los artículos del contrato">
            <thead>
                <tr>
                    <td style="text-align: center;" colspan="9">RIEGO <?php
                                                                        $url = $_SERVER["REQUEST_URI"];
                                                                        $url_components = parse_url($url);
                                                                        parse_str($url_components['query'], $params);
                                                                        echo "<span>" . $params['anio'] . "</span>"
                                                                        ?> SISTEMA LERMA</td>
                </tr>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Fuentes</th>
                    <th>Gasto (l.p.s.)</th>
                    <th>Volumen(m3)</th>
                    <th>Superficie(HAS)</th>
                    <th>Avance(%)</th>


                </tr>

            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <?php
                    echo "<td>" . $contenedorgastodiarioriego[0]['fecha'] . "</td>";
                    ?>
                    <td>OTRAS FUENTES</td>
                    <?php
                    echo "<td>" . $contenedorgastodiarioriego[0]['gasto_otras_fuentes_real'] . "</td>";
                    echo "<td>" . ROUND($contenedorresumenriego[0]['volumen_gasto_otras_fuentes'], 2) . "</td>";
                    echo "<td>" . ROUND($contenedorresumenriego[0]['superficie_otras_fuentes'], 2) . "</td>";
                    echo "<td>" . ROUND($contenedorresumenriego[0]['avance_gasto_otras_fuentes'], 2) . "</td>";

                    ?>
                </tr>
                <tr>
                    <td>2</td>
                    <?php
                    echo "<td>" . $contenedorgastodiarioriego[0]['fecha'] . "</td>";
                    ?>
                    <td>ACUEDUCTO</td>
                    <?php
                    echo "<td>" . $contenedorgastodiarioriego[0]['gasto_acueducto_real'] . "</td>";
                    echo "<td>" . ROUND($contenedorresumenriego[0]['volumen_gasto_acueducto'], 2) . "</td>";
                    echo "<td>" . ROUND($contenedorresumenriego[0]['superficie_acueducto'], 2) . "</td>";
                    echo "<td>" . ROUND($contenedorresumenriego[0]['avance_gasto_acueducto'], 2) . "</td>";

                    ?>
                </tr>


            </tbody>

        </table>
            </div>
            <div id="sidebar">
            <div align="center">
                    <table class="bordered highlight striped" id="tabla_captura" style="width:30%; align-items: center;">
                        <tr>
                            <td style="text-align: center;  font-size: 12px;" colspan="3">METAS <?php
                                                                        $url = $_SERVER["REQUEST_URI"];
                                                                        $url_components = parse_url($url);
                                                                        parse_str($url_components['query'], $params);
                                                                        echo "<span>" . $params['anio'] . "</span>"
                                                                        ?> SISTEMA LERMA</td>
                        </tr>
                        <tr style="text-align: center;  font-size: 12px;">
                            <td></td>
                            <th colspan="">Volumen</th>
                            <th colspan="">Superficie</th>
                        </tr>
                        <tr style="text-align: center;  font-size: 12px;">
                            <th style='background-color: #F6F6F6; height: 2%;'>Otras Fuentes</th>
                            <?php

                        echo "<td>" . $contenedorresumenriego[0]['meta_volumen_otras_fuentes'] . "</td>";
                        echo "<td style='background-color: #F6F6F6;'>" . $contenedorresumenriego[0]['meta_superficie_otras_fuentes'] . "</td>";
                        ?>
                        </tr>
                        <tr style="text-align: center;  font-size: 12px;">
                            <th style='background-color: #F6F6F6;'>Acueducto</th>
                            <?php
                        echo "<td>" . $contenedorresumenriego[0]['meta_volumen_acueducto'] . "</td>";
                        echo "<td style='background-color: #F6F6F6;'>" . $contenedorresumenriego[0]['meta_superficie_acueducto'] . "</td>";
                        ?>
                        </tr>
                        <tr style="text-align: center;  font-size: 12px;">
                            <th style='background-color: #F6F6F6;'>Totales</th>
                            <?php
                        echo "<td >" . $contenedorresumenriego[0]['total_meta_volumen'] . "</td>";
                        echo "<td style='background-color: #F6F6F6;'>" . $contenedorresumenriego[0]['total_meta_superficie'] . "</td>";
                        ?>

                        </tr>

                    </table>
                </div>
            </div>
        </div>

    </div>

    </div>


    <link rel="stylesheet" type="text/css" href="http://187.216.198.249:8020/cdn/css/libs/highslide.css" />
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/shim.min.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/xlsx.full.min.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/Blob.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/FileSaver.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/highcharts.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/data.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/exporting.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/export-data-8.0.4.js">
    </script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/accessibility.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/standalone.js"></script>
    <script type="text/javascript"
        src="<?php echo SERVERURL; ?>vistas/assets/js/datepicker.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript"
        src="<?php echo SERVERURL; ?>vistas/assets/js/datatables_vistas.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript"
        src="<?php echo SERVERURL; ?>vistas/assets/js/graficaRiego.js?v=<?php echo VERSION; ?>"></script>
   
</main>