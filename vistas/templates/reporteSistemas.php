<main>
    <link rel="stylesheet" type='text/css' href="<?php echo SERVERURL; ?>vistas/assets/css/reporteSistemas.css?v=<?php echo VERSION; ?>">

    <div class="container">
        <form id="formularioReporteSistemas" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col s1 m1 l1 xl2">
                </div>
                <div class="col s4 m3 l3 center-align" data-step="2" data-intro="Elija el periodo de monitoreo">
                    <span><b>Intervalo de Reporte</b></span>
                    <select id="intervalo_id" name="intervalo_id" style="display: block" required>
                        <option value="" disabled>Seleccione el Periodo para el Reporte</option>
                        <option value="1" selected>Hora</option>
                        <option value="2">Diario</option>
                        <option value="3">Mensual</option>
                        <option value="4">Anual</option>
                    </select>
                </div>



                <div class="col s7 m4 l4 center-align">
                    <span><b>Rango de Fechas</b></span>
                    <!-- PARA HORAS DEL DIA -->
                    <input type="text" autocomplete="false" id="daterange_horas_reporte_sistemas" name="datetimes" required />
                    <!-- PARA FECHA COMPLETA -->
                    <input type="text" autocomplete="false" id="daterange_diario_reporte_sistemas" name="datetimes" required />
                    <!-- PARA MESES -->
                    <input type="text" autocomplete="false" id="daterange_meses_reporte_sistemas" name="datetimes" required />
                    <!-- PARA AÑOS -->
                    <input type="text" autocomplete="false" id="daterange_anios_reporte_sistemas" name="datetimes" required />
                </div>


                <div class="col s6 m3 l3 input-field">
                    <button id="submit" class="btn buttons-creacion" name="submit" type="submit">
                        CONSULTAR <i class="material-icons left white-text">search</i>
                    </button>
                </div>
            </div>

        </form>
        <div class="row reporte-sistemas" id="row_reporte_sistemas" data-step="3" data-intro="Aquí se mostraran los tablero capturados">
            <div id="tab_totales" class="col s12 tab-contenedor">

                <figure class="highcharts-figure">
                    <div id="grafica_totales"></div>
                    <!-- <p class="highcharts-description">
                        Chart showing grouped and stacked 3D columns. These features are
                        available both for 2D and 3D column charts.
                     </p> -->
                </figure>
            </div>

            <div id="tab_promedios" class="col s12 tab-contenedor">
                <figure class="highcharts-figure">
                    <div id="grafica_promedios"></div>
                    <!-- <p class="highcharts-description">
                        Chart showing grouped and stacked 3D columns. These features are
                        available both for 2D and 3D column charts.
                     </p> -->
                </figure>
            </div>
            <div class="col s12">
                <ul id="tabs_graficas" class="tabs ">
                    <li class="tab col s6">
                        <a class="active" href="#tab_totales">Gráfica de acumulados</a>
                    </li>
                    <!-- <li class="tab col s4">
                            <a href="#tab_pastel">Gráfica de pastel</a>
                        </li> -->
                    <li class="tab col s6">
                        <a href="#tab_promedios">Gráfica de promedios</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row comparativa-reporte-sistemas" id="row_comparativa_reporte_sistemas">
            <div id="tab_comparativa_totales" class="col s12 tab-contenedor">
                <figure class="highcharts-figure">
                    <div id="grafica_comparativa_totales"></div>
                    <!-- <p class="highcharts-description">
                        Chart showing grouped and stacked 3D columns. These features are
                        available both for 2D and 3D column charts.
                     </p> -->
                </figure>
            </div>
            <div id="tab_comparativa_promedios" class="col s12 tab-contenedor">
                <figure class="highcharts-figure">
                    <div id="grafica_comparativa_promedios"></div>
                    <!-- <p class="highcharts-description">
                        Chart showing grouped and stacked 3D columns. These features are
                        available both for 2D and 3D column charts.
                     </p> -->
                </figure>
            </div>
            <div class="col s12">
                <ul id="tabs_graficas_comparativas" class="tabs ">
                    <li class="tab col s6">
                        <a href="#tab_comparativa_totales">Gráfica comparativa de acumulados</a>
                    </li>
                    <!-- <li class="tab col s4">
                            <a href="#tab_pastel">Gráfica de pastel</a>
                        </li> -->
                    <li class="tab col s6">
                        <a class="active" href="#tab_comparativa_promedios">Gráfica comparativa de promedios</a>
                    </li>
                </ul>
            </div>


        </div>

    </div>
    <!-- <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/highcharts-3d.js"></script> -->

    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/highcharts.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/drilldown.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/data.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/exporting.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/export-data-8.0.4.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/accessibility.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/standalone.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/highslide-full.min.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/highslide.config.js" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="http://187.216.198.249:8020/cdn/css/libs/highslide.css" />
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/reporteSistemas.js?v=<?php echo VERSION; ?>"></script>
</main>