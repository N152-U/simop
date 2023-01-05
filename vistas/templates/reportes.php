<?php
require_once "./controladores/reportesControlador.php";
$instanciareportes = new reportesControlador();
$contenedorreportes = $instanciareportes->obtener_reportes_controlador();
?>
<main>

    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <h3 style="display: inline-block;">Reportes</h3>
                    <a class="right tooltipped crear-reporte" href="<?php echo SERVERURL; ?>reporte" data-position="bottom" data-tooltip="Crear Reporte" style="display: inline-block; margin: 2.3733333333rem 0 1.424rem 0;"><i class="medium material-icons indigo-text left">add</i></a>
                    <!-- <a class="right tooltipped" href="#!" data-position="bottom" data-tooltip="Ver Borradores" style="display: inline-block; margin: 2.3733333333rem 0 1.424rem 0;" id="mostarTabla"><i class="medium material-icons left" style="color: #ffc107;">view_list</i></a> -->
                </div>


                <table class="bordered highlight striped" id="tabla_reportes" style="width: 100%;" data-step="6" data-intro="En esta tabla encontrar&aacute; los puntos de medicion">


                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Folio </th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contenedorreportes as $key => $reporte) {
                            $keys = array_keys($reporte);
                            $id_reporte = $reporte['id'];
                            $folio = $reporte['folio'];
                            $fecha = $reporte['fecha'];


                            echo "<tr>";
                            echo "<td>" . ($key + 1) . "</td>";
                            echo "<td>" . $folio . "</td>";
                            echo "<td>" . $fecha . "</td>";
                            echo "<td>
                                    <a data-position='bottom' data-tooltip='Ver' href='" . SERVERURL . 'detallesReporte/' . $id_reporte . "' class='waves-effect waves-light btn tooltipped green buttons-accion leer-reportes'><i class='small white-text fas fa-eye'></i></a>
                                    <a data-position='bottom' data-tooltip='Generar PDF' href='#!' class='waves-effect waves-light btn tooltipped blue buttons-accion leer-valeinterno' onclick='genPDF(" . $id_reporte . ")'><i class='small white-text fas fa-file-pdf'></i></a>
                                                              
                                    </td>";
                            echo "</tr>";
                        } ?>

                    </tbody>

                </table>






            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datatables_vistas.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/reportes.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/generarPDF.js?v=<?php echo VERSION; ?>"></script>

    

</main>