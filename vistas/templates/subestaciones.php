<?php
require_once "./controladores/subestacionesControlador.php";

?>

<main>

    <div class="container">
        <form id="form-captura-subestacion" method="post" enctype="multipart/form-data">

            <div class="row" data-step="1" data-intro="Introduzca los datos del punto de monitoreo">

                <div class="input-field col s6">
                    <select id="subestacion_id" name="subestacion_id" style="display: block" onchange="lasHoras(this)" required>
                        <option selected disabled></option>

                        <?php
                        foreach ($contenedorsubestaciones as $key => $subestacion) {

                            echo "<option value=" . $subestacion["id"] . " disabled>" . $subestacion["subestacion"]  . "</option>";
                        }
                        ?>

                    </select>
                    <label for="subestacion_id">Subestaci&oacute;n El&eacute;ctrica</label>
                </div>

                <div class="input-field col s6">
                    <select id="fecha_hora_programada" name="fecha_hora_programada" style="display: block"></select>
                    <label for="fecha_hora_programada">Fecha Programada</label>
                </div>

            </div>

            <div class="row">

                <div class="input-field col s6">
                    <input id="amperaje" name="amperaje" type="number" min="0" step="0.01" oninput="revisarAmperaje(this)" value="" required>
                    <label for="amperaje">Amperaje</label>
                </div>

                <div class="input-field col s6">


                    <select id="transmite" name="usuario_id" style="display: block">
                        <option selected disabled></option>

                        <?php

                        foreach ($contenedorUsuarios as $key => $usuario) {

                            echo "<option value='" . $usuario["id"] . "'>" . $usuario["nombre_completo"]  . "</option>";
                        }

                        ?>
                    </select>
                    <label for="transmite">Transmite</label>


                </div>

            </div>
            <!-- value="<?php echo $_SESSION[GUID]["nombre"] ?>" -->
            <div class="row">

                <div class="input-field col s10">
                    <input onkeyup="withSelectionRange(this);" id="sub_novedades" name="sub_novedades" type="text" class="materialize-textarea dom" data-length="300" cols="15" rows="15" placeholder="" required>
                    <label for="sub_novedades">Novedades</label>
                </div>

                <div class=" col s2">
                    <label>
                        <input id="sin_novedad" onclick="sinNovedad(this)" type="checkbox" required>
                        <span>SIN NOVEDAD</span>
                    </label>
                </div>
            </div>

            <div class="row" data-step="4" data-intro="Al llenar los campos anteriores, presione el botón (podra repetir estos pasos para agregar más)">
                <div class="col s12 center-align">
                    <input id="submit" class="btn buttons-creacion" name="submit" type="submit" value="GUARDAR">
                </div>
            </div>

            <div class="col s12">
                <table class="bordered highlight striped" id="tabla_subestaciones" style="width: 100%;" data-step="5" data-intro="En esta tabla encontrará los artículos del contrato">
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
    </div>

    <script type="text/javascript">
        var usuario_id = '<?php echo $usuario_id ?>';
    </script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datepicker.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datatables_vistas.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/subestaciones.js?v=<?php echo VERSION; ?>"></script>

</main>