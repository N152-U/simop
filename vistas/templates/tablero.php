<?php
require_once "./controladores/tableroControlador.php";
$instanciatablero = new tableroControlador();

?>


<main>

    <link rel="stylesheet" type='text/css' href="<?php echo SERVERURL; ?>vistas/assets/css/tablero.css?v=<?php echo VERSION; ?>">
    <script  type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/highcharts.js"></script>
   
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/shim.min.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/xlsx.full.min.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/Blob.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/FileSaver.js"></script>

    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/highcharts.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/data.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/exporting.js"></script>
    <script  type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/drilldown.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/export-data-8.0.4.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/accessibility.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/standalone.js"></script>



    <div class="container">
        <form id="formularioTablero" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col s1 m1 l1 xl2">
                </div>
                <div class="input-field col s4 m3 l3 center-align" data-step="2" data-intro="Elija el periodo de monitoreo">
                    <select id="intervalo_id" name="intervalo_id" style="display: block" required>
                        <option value="" disabled>Seleccione el Periodo para el Reporte</option>
                        <option value="1" selected>Hora</option>
                        <option value="2">Diario</option>
                        <option value="3">Mensual</option>
                        <option value="4">Anual</option>
                    </select>
                    <label for="intervalo_id">Intervalo de Reporte</span>
                </div>



                <div class="input-field col s7 m4 l4 center-align">
                    <!-- PARA HORAS DEL DIA -->
                    <input type="text" id="daterange_horas_reporte_sistemas" placeholder="Y-m-d" autocomplete="false" name="datetimes" required />
                    <!-- PARA FECHA COMPLETA -->
                    <input type="text" id="daterange_diario_reporte_sistemas" placeholder="Y-m-d" autocomplete="false" name="datetimes" required />
                    <!-- PARA MESES -->
                    <input type="text" id="daterange_meses_reporte_sistemas" placeholder="Y-m-d" autocomplete="false" name="datetimes" required />
                    <!-- PARA AÑOS -->
                    <input type="text" id="daterange_anios_reporte_sistemas" placeholder="Y-m-d" autocomplete="false" name="datetimes" required />
                    <label for="daterange">Rango de Fechas</span>
                </div>


                <div class="col s6 m3 l3 input-field">
                    <button id="submit" class="btn buttons-creacion" name="submit" type="submit">
                        CONSULTAR <i class="material-icons left white-text">search</i>
                    </button>
                </div>
            </div>
        </form>

        <div class="row comparativa-tablero" id="row_comparativa_tablero">
            <div id="tab_comparativa_tablero_totales" class="col s12 tab-contenedor">
                <figure class="highcharts-figure">
                    <div id="grafica_comparativa_tablero_totales"></div>

                </figure>
            </div>
            <div id="tab_comparativa_tablero_promedios" class="col s12 tab-contenedor">
                <figure class="highcharts-figure">
                    <div id="grafica_comparativa_tablero_promedios"></div>

                </figure>
            </div>
            <div class="col s12">
                <ul id="tabs_graficas_comparativas" class="tabs ">
                    <li class="tab col s6">
                        <a href="#tab_comparativa_tablero_totales">Gráfica comparativa de acumulados para puntos</a>
                    </li>

                    <li class="tab col s6">
                        <a class="active" href="#tab_comparativa_tablero_promedios">Gráfica comparativa de promedios para puntos</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

   
    <script src="<?php echo SERVERURL . 'vistas/assets/js/tablero.js' ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datepicker.js?v=<?php echo VERSION; ?>"></script>
 
</main>