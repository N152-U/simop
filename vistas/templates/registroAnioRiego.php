<?php
require_once "./controladores/registroAnioRiegoControlador.php";
?>
<main>
<?php if ($vista) : ?>
    <link rel="stylesheet" type='text/css' href="<?php echo SERVERURL; ?>vistas/assets/css/captura.css?v=<?php echo VERSION; ?>">

    <div class="container">

        <form id="formularioCaptura" method="post" enctype="multipart/form-data">



            <div class="row">

                <div class="col s2">
                    <b>Año:</b>
                </div>
                <div class="col s10">
                    <?php
                    
                    /* $anio = intval($anio);

                        $fechaInicio = $anio - 10;
                        $fechaFin = $anio;
                        for ($i = $fechaFin; $i >= $fechaInicio; $i--) {

                            echo "<option value=" . $i . ">" .  $i  . "</option>";
                        } */
                    ?>
                    <input type="number" value="<?php echo $anio;?>"  id="anio" name="anio" required class="disabled">
                    <!--  <select  oninput="anioRiego(this)" id="anio" name="anio" style="display: block">
                        <option selected disabled></option>

                    </select> -->
                </div>
            </div>
            <div class="row">
                <div class="col s2">
                    <b>Meta Volumen Acueducto:</b>
                </div>
                <div class="col s10">
                    <input type="number" step="0.01" id="meta_volumen_acueducto" name="meta_volumen_acueducto" required>
                </div>
            </div>
            <div class="row">
                <div class="col s2">
                    <b>Meta Superficie Acueducto:</b>
                </div>
                <div class="col s10">
                    <input type="number" step="0.01" id="meta_superficie_acueducto" name="meta_superficie_acueducto" required>
                </div>
            </div>
            <div class="row">
                <div class="col s2">
                    <b>Meta Volumen Otras Fuentes:</b>
                </div>
                <div class="col s10">
                    <input type="number" step="0.01" id="meta_volumen_otras_fuentes" name="meta_volumen_otras_fuentes" required>
                </div>
            </div>
            <div class="row">
                <div class="col s2">
                    <b>Meta Superficie Otras Fuentes:</b>
                </div>
                <div class="col s10">
                    <input type="number" step="0.01" id="meta_superficie_otras_fuentes" name="meta_superficie_otras_fuentes" required>
                </div>
            </div>



            <div class="col s12" id="avance_proramado_contenedor">
                <br>

                <br>

                <table class="bordered highlight striped" id="tabla_captura" style="width: 100%;" data-step="5" data-intro="En esta tabla encontrará los artículos del contrato">

                    <thead>
                        <tr>
                            <td colspan="3">
                                <div style="text-align: center;">
                                    <h4>Avance programado</h4>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Año</th>
                            <th>Gasto Acueducto</th>
                            <th>Gasto Otras Fuentes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $anio = date("Y");

                        $fechaInicio = strtotime("01-02-" . $anio);
                        $fechaFin = strtotime("01-05-" . "$anio");

                        for ($i = $fechaInicio; $i <= $fechaFin; $i += 86400) {
                        ?>
                            <tr>
                                <td style="text-align: center; width: 95px; "> <input name="fecha[]" multiple="multiple" id="fecha" style="height: 17px;" readonly  value="<?php echo date("Y-m-d", $i); ?>" /></td>
                                <td style="text-align: center; "><input style="height: 17px;" type="number" name="gasto_acueducto_programado[]" multiple="multiple" id="gasto_acueducto_programado" min="0" pattern="^[0-9]+" max="99999"  required/></td>
                                <td><input style="height: 17px;" type="number" name="gasto_otras_fuentes_programado[]" multiple="multiple" id="gasto_otras_fuentes_programado" min="0" pattern="^[0-9]+" max="99999"   required/></td>
                            </tr>
                        <?php  }
                        ?>
                    </tbody>
                </table>
            </div>
            <br>
            <div class="row" data-step="4" data-intro="Al llenar los campos anteriores, presione el botón (podra repetir estos pasos para agregar más)">
                <div class="col s12 center-align">
                    <input id="submit" class="btn buttons-creacion" name="submit" type="submit" value="REGISTRAR">
                </div>
            </div>
        </form>

    </div>


    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datepicker.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datatables_vistas.js?v=<?php echo VERSION; ?>"></script>

    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/registroAnioRiego.js?v=<?php echo VERSION; ?>"></script>

    <?php else :
        /*Si no se cumple la validacion, desplegamos el modulo de error*/
        $show_footer = false;
        $mensaje = "La página solicitada no existe o no se encuentra disponible";
        require_once "./vistas/modulos/error.php"; ?>



    <?php endif; ?>


</main>