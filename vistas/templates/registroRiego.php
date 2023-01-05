<?php
require_once "./controladores/registroRiegoControlador.php";
$instanciacontrolriego = new registroRiegoControlador();
$url = $_SERVER["REQUEST_URI"];
$url_components = parse_url($url);
parse_str($url_components['query'], $params);

$contenedorhistoricoregistroriego = $instanciacontrolriego->obtener_historico_riego_controlador($params['anio']);
$contenedorfechas = $instanciacontrolriego->obtener_fechas($params['anio']);
?>
<main>
    <link rel="stylesheet" type='text/css' href="<?php echo SERVERURL; ?>vistas/assets/css/captura.css?v=<?php echo VERSION; ?>">

    <div class="container">
       <!-- div id="editar_anio" class="acciones-privilegiadas" hidden>
            <a href="#!"><i class="fal fa-edit" aria-hidden="true"></i> <span>Edición</span></a>
        </div --> 
        <form id="formularioCaptura" method="post" enctype="multipart/form-data">

            <div data-step="1">
                <div class="row" data-step="2" data-intro="Elija una fecha">
                    <div class="col s2">
                        <b>Fecha:</b>
                    </div>
                    <div class="col s10">
                        <select id="fecha" name="fecha" style="display: block" required>
                            <option selected disabled></option>

                            <?php

                            foreach ($contenedorfechas as $key => $fecha) {
                                echo "<option>" . $fecha["fecha"]  . "</option>";

                            }

                            ?>

                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s2">
                    <b>Gasto Acueducto:</b>
                </div>
                <div class="col s10">
                    <input type="number" id="gasto_acueducto_real" name="gasto_acueducto_real" step="0.01" class=""  min="0" pattern="^[0-9]+" max="99999"  required>
                </div>
            </div>
            <div class="row">
                <div class="col s2">
                    <b>Gasto Otras Fuentes:</b>
                </div>
                <div class="col s10">
                    <input type="number" id="gasto_otras_fuentes_real" name="gasto_otras_fuentes_real" step="0.01"   min="0" pattern="^[0-9]+" max="99999"  class="" required>
                </div>
            </div>


            <div class="row" id="transmitio_contenedor">

                <div class="col s2">
                    <b>Transmite:</b>
                </div>
                <div class="col s10">
                    <select id="transmitio" name="usuario_id" style="display: block" required>
                        <option selected disabled></option>
                        <?php

                        foreach ($contenedorUsuarios as $key => $usuario) {

                            echo "<option value=" . $usuario["id"] . ">" . $usuario["nombre_completo"]  . "</option>";
                        }

                        ?>
                    </select>

                </div>
            </div>


            <div class="row" data-step="4" data-intro="Al llenar los campos anteriores, presione el botón (podra repetir estos pasos para agregar más)">
                <div class="col s12 center-align">
                    <input id="submit" class="btn buttons-creacion" name="submit" type="submit" value="REGISTRAR">
                </div>
            </div>





            <div class="col s12">
                <table class="bordered highlight striped" id="tabla_captura" style="width: 100%;" data-step="5" data-intro="En esta tabla encontrará los artículos del contrato">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Gasto Acueducto</th>
                            <th>Gasto Otras Fuentes</th>
                            <th>Transmitio</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contenedorhistoricoregistroriego as $key => $historicoriego) {
                            $keys = array_keys($historicoriego);
                            $fecha = $historicoriego['fecha'];
                            $gasto_acueducto_real = $historicoriego['gasto_acueducto_real'];
                            $gasto_otras_fuentes_real = $historicoriego['gasto_otras_fuentes_real'];
                            $transmitio = $historicoriego['transmitio'];


                            echo "<tr>";
                            echo "<td>" . ($key + 1) . "</td>";
                            echo "<td>" . $fecha . "</td>";
                            echo "<td> " . $gasto_acueducto_real . " </td>";
                            echo "<td> " . $gasto_otras_fuentes_real . " </td>";
                            echo "<td> " . $transmitio . " </td>";
                            echo "</tr>";
                        } ?>


                    </tbody>

                </table>
            </div>





        </form>



        <form id="formularioEdicion" method="post" enctype="multipart/form-data" hidden>

            <div data-step="1" data-intro="Introduzca los datos del punto de monitoreo">


                <div class="row" data-step="2" data-intro="Elija el punto de monitoreo">
                    <div id="tabla_contenedor_edicion" class="col s12 m12 l12 xl12">

                        <table class="bordered highlight striped" id="tabla_captura_edicion" style="width: 100%;" data-step="5" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Gasto Acueducto</th>
                                    <th>Gasto Otras Fuentes</th>
                                    <th>Transmitio</th>
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($contenedorhistoricoregistroriego as $key => $historicoriego) {
                                    $keys = array_keys($historicoriego);
                                    $fecha = $historicoriego['fecha'];
                                    $gasto_acueducto_real = $historicoriego['gasto_acueducto_real'];
                                    $gasto_otras_fuentes_real = $historicoriego['gasto_otras_fuentes_real'];
                                    $transmitio = $historicoriego['transmitio'];


                                    echo "<tr>";
                                    echo "<td>" . ($key + 1) . "</td>";
                                    echo "<td>" . $fecha . "</td>";
                                    echo "<td> " . $gasto_acueducto_real . " </td>";
                                    echo "<td> " . $gasto_otras_fuentes_real . " </td>";
                                    echo "<td> " . $transmitio . " </td>";
                                    echo "<td> "."<a href='#' class='btn buttons-accion editar-registro blue' role='button'><i class='fas fa-edit fa-sm'></i></a>"."</td>";
                                    echo "</tr>";
                                } ?>


                            </tbody>


                        </table>

                    </div>

                    <div id="campos_contenedor_edicion" class="col s12 m6 l12 xl6" hidden>
                        <div>
                            <h5 style="display: inline-block;">Campos del registro seleccionado</h4>
                                <input id="registro_id_edicion" name="registro_id" type="number" class="" value="" hidden>
                        </div>
                        <div class="row">
                            <div class="col s12 m2">
                                <b>Fecha:</b>
                            </div>
                            <div class="col s12 m4">
                                <input type="text" id="fecha" name="fecha" class="datepicker" min="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s2">
                                <b>Gasto Acueducto:</b>
                            </div>
                            <div class="col s10">
                                <input type="number" id="gasto_acueducto_real" name="gasto_acueducto_real" step="0.01" class="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s2">
                                <b>Gasto Otras Fuentes:</b>
                            </div>
                            <div class="col s10">
                                <input type="number" id="gasto_otras_fuentes_real" name="gasto_otras_fuentes_real" step="0.01" class="" required>
                            </div>
                        </div>


                        <div class="row" id="transmitio_contenedor">

                            <div class="col s2">
                                <b>Transmite:</b>
                            </div>
                            <div class="col s10">
                                <select id="transmitio" name="usuario_id" style="display: block">
                                    <option selected disabled></option>
                                    <?php

                                    foreach ($contenedorUsuarios as $key => $usuario) {

                                        echo "<option value=" . $usuario["id"] . ">" . $usuario["nombre_completo"]  . "</option>";
                                    }

                                    ?>
                                </select>

                            </div>
                        </div>

                        <div class="row" data-step="4" data-intro="Al llenar los campos anteriores, presione el botón (podra repetir estos pasos para agregar más)">
                            <div class="col s12 center-align">
                                <input id="submit_edicion" class="btn buttons-creacion" name="submit" type="submit" value="REGISTRAR">
                            </div>
                        </div>
                    </div>


                </div>

            </div>


    </div>

    </form>


    </div>


    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datepicker.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datatables_vistas.js?v=<?php echo VERSION; ?>"></script>

    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/registroRiego.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/registroRiego_edicion.js?v=<?php echo VERSION; ?>"></script>


</main>