<?php
require_once "./controladores/controlRiegoControlador.php";
$instanciaanioriego = new controlRiegoControlador();
$contenedoranioriego = $instanciaanioriego->obtener_anios_riego_controlador();
?>
<main>
    <link rel="stylesheet" type='text/css' href="<?php echo SERVERURL; ?>vistas/assets/css/captura.css?v=<?php echo VERSION; ?>">

    <div class="container">
        <div style="height: 20px;">
            <?php

            $control = 0;

            foreach ($contenedoranioriego as $key => $anioriego) {

                $keys = array_keys($anioriego);
                $id_anioriego = $anioriego['id'];
                $anio = $anioriego['anio'];
                $anioActual = date("Y");
             
                if ($anio == $anioActual) {
                    $control = 1;
                }
            }
            if ($control == 0 || $contenedoranioriego == '') {
                echo "<td>
        <a class='right tooltipped crear-anio-riego' data-position='bottom' data-tooltip='Registro Año Riego' href='" . SERVERURL . 'registroAnioRiego' . "'  style='display: inline-block; margin: 2.3733333333rem 0 1.424rem 0;'><i class='medium material-icons indigo-text left'>add</i></a>


        </td>";
            }

            ?>

        </div>
        <form id="formularioCaptura" method="post" enctype="multipart/form-data">

            <div class="row" data-step="4" data-intro="Al llenar los campos anteriores, presione el botón (podra repetir estos pasos para agregar más)">

            </div>

            <div class="col s12">
                <table class="bordered highlight striped" id="tabla_captura" style="width: 100%;" data-step="5" data-intro="En esta tabla encontrará los artículos del contrato">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Año</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <!-- class="fas fa-chart-bar" -->
                    <tbody>
                        <?php foreach ($contenedoranioriego as $key => $anioriego) {
                            $keys = array_keys($anioriego);
                            $id_anioriego = $anioriego['id'];
                            $anio = $anioriego['anio'];


                            echo "<tr>";
                            echo "<td>" . ($key + 1) . "</td>";
                            echo "<td>" . $anio . "</td>";
                            echo "<td>
                                         <a data-position='bottom' data-tooltip='Agregar Nuevo Registro' href='" . SERVERURL . 'registroRiego' . '/?anio=' . $anio . "' class='waves-effect waves-light btn tooltipped green buttons-accion leer-reportes'><i class='small white-text fas fa-bars'></i></a>
                                      
                                         <a data-position='bottom' id='grafica' data-tooltip='Mostrar Gráfica'  href='" . SERVERURL . 'graficaRiego' . '/?anio=' . $anio . "' class='waves-effect waves-light btn tooltipped blue buttons-accion leer-grafica'><i class='small white-text fas fa-chart-bar'></i></a>
                                                                   
                                         </td>";
                            echo "</tr>";
                        } ?>

                    </tbody>

                </table>
            </div>

        </form>


    </div>


    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datepicker.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datatables_vistas.js?v=<?php echo VERSION; ?>"></script>

    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/controlRiego.js?v=<?php echo VERSION; ?>"></script>


</main>