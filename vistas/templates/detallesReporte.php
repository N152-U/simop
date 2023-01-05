<?php
require_once "./controladores/reportesControlador.php";
$data_url = explode("/", $_GET["vistas"]);
$reporte_id = $data_url[1];

if (sizeof($data_url) == 2 && ctype_digit(strval($reporte_id))) {
    $instanciaReporte = new reportesControlador();
    $reporte_id = $data_url[1];
    //  print_r($reporte_id);

    //$datosVale = $instanciaValesAlmacen->obtener_datos_vale_vales_almacen_controlador($vale_id);
    $contenedorDetallesReporte = $instanciaReporte->obtener_detalle_reportes_controlador($reporte_id);
    $contenedorNovedades = $instanciaReporte->obtener_novedades_reportes_controlador($reporte_id);
    $contenedorNotas = $instanciaReporte->obtener_notas_reportes_controlador($reporte_id);

    $vista = true;
}

?>


<main>
    <?php
    /*Si alguna de las dos condiciones no se cumple, mostramos el error indicado mas abajo*/
    if ($vista) : ?>
        <div class="container col s12">

            <h5 class="center">
                Bitacora de Radio
            </h5>

            <div class="row section">
                <div class="col s12 m8">
                    <h6><b>Fecha del Reporte:</b> <?php echo $contenedorDetallesReporte['fecha']; ?></h6>
                </div>
                <div class="col s12 m4">
                    <h6><b>Folio del Reporte:</b> <?php echo $contenedorDetallesReporte['folio']; ?> </h6>
                </div>
            </div>
            <div class="row section">
                <div class="col s12 m2">
                    <h6>
                        <b>Novedades:</b>
                    </h6>
                </div>

                <?php foreach ($contenedorNovedades as $key => $value) {
                    $keys = array_keys($value);
                    $tipo = $value['tipo_afectacion'];
                    $inicio = $value['hora_inicio'];
                    $final = $value['hora_final'];
                    $lugar = $value['lugar_afectacion'];
                    $gasto = $value['gasto'];
                    $razon = $value['razon'];
                    $reporto = $value['reporto'];
                    $recibio_ci = $value['recibio_centro_informacion'];
                    $hora_ci = $value['hora_centro_informacion'];
                    $recibio_sj = $value['recibio_san_joaquin'];
                    $hora_sj = $value['hora_san_joaquin'];
                    echo "<div class='col 12'>";
                    echo "<div class='col s12 m9 offset-m2'>";
                    echo "<p style='text-align: justify'>" . $tipo . " DE " . $inicio . " A " . $final . " HRS, EN " . $lugar . " DEJANDO DE APORTAR UN GASTO DE " . $gasto . " L.P.S. " . $razon . ". REPORTE DE " . $reporto . ". CENTRO DE INFORMACIÓN " . $recibio_ci . " A LAS " . $hora_ci . ", SAN JOAQUIN " . $recibio_sj . " A LAS " . $hora_sj;
                    echo "</p></div><div class='col s12 m9 offset-m2'></div></div>";
                } ?>

            </div>
            <div class="row section">
                <div class="col s12 m2">

                    <h6><b>Reporte de la Planta Berros:</b></h6>

                </div>

                <div class="col s12 m8">
                    <p><?php echo $contenedorDetallesReporte['reporte_berros']; ?></p>
                </div>

            </div>

            <div class="row section">
                <div class="col s12 m2">
                    <h6><b>Reporte a Información:</b></h6>
                </div>

            </div>

            <div class="row section">
                <div class="col s12 m10 offset-m2">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <b>Hora Recibio:</b>
                        </div>
                        <div class="col s12 m6 l6">
                            <?php echo $contenedorDetallesReporte['hora_recibio']; ?>
                        </div>
                        <div class="col s12 m6 l6">
                            <b>Recibio:</b>
                        </div>
                        <div class="col s12 m6 l6">
                            <?php echo $contenedorDetallesReporte['recibio']; ?>
                        </div>
                        <div class="col s12 m6 l6">
                            <b>Transmitio:</b>
                        </div>
                        <div class="col s12 m6 l6">
                            <?php echo $contenedorDetallesReporte['transmitio']; ?>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row section">
                <div class="col s12 m2">

                    <h6><b>Reporte de Lluvia:</b></h6>
                </div>
            </div>
            <div class="row section">
                <div class="col s12 m10 offset-m2">
                    <div class="row">
                        <div class="col s12 m6">
                            <b>Almoloya:</b>
                        </div>
                        <div class="col s12 m6">

                            <?php echo $contenedorDetallesReporte['lluvia_almoloya']; ?>
                        </div>
                        <div class="col s12 m6">
                            <b> Villa Carmela:</b>
                        </div>
                        <div class="col s12 m6">
                            <?php echo $contenedorDetallesReporte['lluvia_villa_carmela']; ?>
                        </div>
                        <div class="col s12 m6">
                            <b> Alzate:</b>
                        </div>
                        <div class="col s12 m6">
                            <?php echo $contenedorDetallesReporte['lluvia_alzate']; ?>
                        </div>
                        <div class="col s12 m6">
                            <b> Ixtlahuaca:</b>
                        </div>
                        <div class="col s12 m6">
                            <?php echo $contenedorDetallesReporte['lluvia_ixtlahuaca']; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row section">
                <div class="col s12 m2">

                    <h6><b>Gasto Promedio Venado [L/s]:</b></h6>
                </div>

                <div class="col s12 m10">

                    <?php echo $contenedorDetallesReporte['gasto_venado']; ?>
                </div>

            </div>
            <div class="row section">
                <div class="col s12 m2">

                    <h6><b>Notas:</b></h6>
                </div>
            </div>

            <div class="row section">
                <div class="col s12 m10 offset-m2">
                    <table>

                        <tbody>


                            <?php foreach ($contenedorNotas as $key => $value) {
                                $keys = array_keys($value);
                                $desc = $value['descripcion'];

                                echo "<tr>";
                                echo "<td>" . ($key+1) . "</td>";
                                echo "<td>" . $desc . "</td>";

                                echo "</tr>";
                            } ?>

                        </tbody>

                    </table>
                </div>

            </div>

            <div class="row section">
                <div class="col s12 m2">

                    <h6><b>Operadores:</b></h6>
                </div>
            </div>
            <div class="row section">
                <div class="col s12 m10 offset-m2">

                    <div class="col s12 m6">
                        <b> 1er Operador :</b>
                    </div>
                    <div class="col s12 m6">
                        <?php echo $contenedorDetallesReporte['operador_uno']; ?>
                    </div>
                    <div class="col s12 m6">
                        <b> 2do Operador:</b>
                    </div>
                    <div class="col s12 m6">
                        <?php echo $contenedorDetallesReporte['operador_dos']; ?>
                    </div>
                    
                </div>

            </div>
            
            <div class="row section">
                <div class="col s12 m2">

                    <h6><b>Jefe Responsable de Turno:</b></h6>
                </div>

                <div class="col s12 m10">

                    <?php echo $contenedorDetallesReporte['jefe_reponsable_turno']; ?>

                </div>

            </div>
        </div>

        </table>

        <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datatables_vistas.js?v=<?php echo VERSION; ?>"></script>
        <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/reportes.js?v=<?php echo VERSION; ?>"></script>
    <?php else :
        /*Si no se cumple la validacion, desplegamos el modulo de error*/
        $pagina = "valesAlmacen";
        $show_footer = false;
        $mensaje = "El vale de almacen no existe";
        require_once "./vistas/modulos/error.php";
    ?>
    <?php endif; ?>
</main>