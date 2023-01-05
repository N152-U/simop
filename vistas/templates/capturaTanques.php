<?php
require_once "./controladores/subestacionesControlador.php";
$data_url = explode("/", $_GET["vistas"]);
/*
    if (sizeof($data_url) == 1) {

        $instancia = new capturaControlador();
        $contenedorpuntos = $instancia->obtener_puntos_captura_controlador();
        $contenedorbombas = $instancia->obtener_bombas_captura_controlador();
        $data_url = explode("/", $_GET["vistas"]);
    }*/

    $instancia = new subestacionesControlador();
    $contenedorsubestaciones = $instancia->obtener_subestaciones_controlador();
    $usuario_id = $instancia::decryption($_SESSION[GUID]["rol_id"]);

//print_r($contenedorsubestaciones);

?>
<main>

    <div class="container">
        <form id="form-captura-subestacion" method="post" enctype="multipart/form-data">

            <div class="row" data-step="1" data-intro="Introduzca los datos del punto de monitoreo">

                <div class="input-field col s6">
                    <select id="subestacion_id" name="subestacion_id" style="display: block" required>
                        <option selected disabled></option>

                        <?php

                            foreach ($contenedorsubestaciones as $key => $subestacion) {

                                echo "<option value=" . $subestacion["id"] . " disabled>" . $subestacion["subestacion"]  . "</option>";

                            }

                        ?>

                    </select>
                    <label for="subestacion_id">Tanque</label>
                </div>

                <div class="input-field col s6">
                    <select id="fecha_hora_programada" name="fecha_hora_programada" style="display: block" ></select>
                    <label for="fecha_hora_programada">Fecha Programada</label>
                </div>

            </div>

            <div class="row">
                
                <div class="input-field col s6">
                    <input id="tirante" name="tirante" type="number" min="0" step="0.01" value="<?php echo isset($datospozo["presion"]) ? $datospozo["presion"] : ""; ?>" required>
                    <label for="tirante">Tirante</label>
                </div>

                <div class="input-field col s6">
                    <input id="vertedor" name="vertedor" type="number" min="0" step="0.01" value="<?php echo isset($datospozo["presion"]) ? $datospozo["presion"] : ""; ?>" required>
                    <label for="vertedor">Vertedor</label>
                </div>

            </div>

            <div class="row">
                
                <div class="input-field col s6">
                    <input id="descarga" name="descarga" type="number" min="0" step="0.01" value="<?php echo isset($datospozo["presion"]) ? $datospozo["presion"] : ""; ?>" required>
                    <label for="descarga">Descarga</label>
                </div>

                <div class="input-field col s6">
                    <input id="local" name="local" type="number" min="0" step="0.01" value="<?php echo isset($datospozo["presion"]) ? $datospozo["presion"] : ""; ?>" required>
                    <label for="local">Local</label>
                </div>

            </div>

            <div class="row">

                <div class="input-field col s6">
                    <textarea onkeyup="withSelectionRange(this)" id="novedades" name="novedades" type="text" class="materialize-textarea" data-length="300" cols="15" rows="15" placeholder="" required></textarea>
                    <label for="novedades">Novedades</label>
                </div>
                
                <div class="col s2">
                    <label>
                        <input type="checkbox">
                        <span>Sin Novedades</span>
                    </label>
                </div>

                <div class="input-field col s4">
                    <input type="text" id="transmite" name="transmite" onkeyup="withSelectionRange(this)" data-length="100" value="<?php echo $_SESSION[GUID]["nombre"]?>" required>
                    <label for="transmite">Transmite</label>
                </div>

            </div>
         
            <div class="row" data-step="4" data-intro="Al llenar los campos anteriores, presione el botón (podra repetir estos pasos para agregar más)">
                <div class="col s12 center-align">
                    <input id="submit" class="btn buttons-creacion" name="submit" type="submit" value="GUARDAR">
                </div>
            </div>

        </form>
    </div>

    <script type="text/javascript">
        var usuario_id = '<?php echo $usuario_id ?>';
    </script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datepicker.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datatables_vistas.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/subestaciones.js?v=<?php echo VERSION; ?>"></script>

</main>