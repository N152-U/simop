<?php
require_once "./controladores/novedadesControlador.php";
?>
<link rel="stylesheet" type='text/css' href="<?php echo SERVERURL; ?>vistas/assets/css/novedades.css?v=<?php echo VERSION; ?>">

<main>

    <div class="container">

        <form id="formularioNovedades" method="post" enctype="multipart/form-data">

            <div class="row">
                <div class="col s2">
                    <b>Tipo:</b>
                </div>
                <div class="col s10">
                    <select id="novedades_tipo" name="novedades_tipo" style="display: block" required>
                        <option value="" disabled selected>Elija el tipo de afectación</option>
                        <option value="I.E.E.I.G">INTERRUPCIÓN DE ENERGÍA ELÉCTRICA INSTANTÁNEA GENERAL </option>
                        <option value="I.E.E.I">INTERRUPCIÓN DE ENERGÍA ELÉCTRICA INSTANTÁNEA</option>
                        <option value="I.E.E">INTERRUPCIÓN DE ENERGÍA ELÉCTRICA DE TIEMPO</option>                        
                        <option value="LICENCIA PROGRAMADA">LICENCIA PROGRAMADA</option>
                        <option value="LICENCIA DE EMERGENCIA">LICENCIA DE EMERGENCIA</option>
                    
                    </select>
                </div>
            </div>


            <div class="row">
                <div class="col s2">
                    <b>Hora de Afectación de:</b>
                </div>
                <div class="col s4">
                    <!-- <input type="text" id="dateranage_inicio" name="datetimes" required /> -->
                    <input type="text" id="dateranage_inicio" name="dateranage_inicio" class="timepicker" required />

                </div>
                <div class="col s2 center">
                    <b>a:</b>
                </div>
                <div class="col s4">
                    <!-- <input type="text" id="dateranage_fin" name="datetimes" required /> -->
                    <input type="text" id="dateranage_fin" name="dateranage_fin" class="timepicker" required />
                </div>

            </div>
            <div class="row">
                <div class="col s2">
                    <b>Lugar de la Afectación:</b>
                </div>
                <div class="col s10">
                    <input type="text" id="lugar" name="lugar" onkeyup="withSelectionRange(this);" data-length="100" value="" required>
                </div>
            </div>
            <div class="row">
                <div class="col s2">
                    <b>Gasto [L/s]:</b>
                </div>
                <div class="col s10">
                    <input type="number" id="gasto" name="gasto" onkeyup="withSelectionRange(this)" data-length="100" value="" required>
                </div>
            </div>
            <div class="row">
                <div class="col s2">
                    <b>Razón:</b>
                </div>
                <div class="col s10">
                    
                    <textarea  id="razon" name="razon" onkeyup="withSelectionRange(this);" type="text" class="materialize-textarea" data-length="300" cols="15" rows="15" placeholder="" required></textarea>

                </div>
            </div>
            <div class="row">
                <div class="col s2">
                    <b>Reportó:</b>
                </div>
                <div class="col s10">
                    <input type="text" id="reporto" name="reporto" onkeyup="withSelectionRange(this)" data-length="100" value="" required>
                </div>
            </div>
            <div class="row">


                <div class="col s2">
                    <b>Centro de Información:</b>
                </div>
                <div class="col s4">
                    <input type="text" id="centro_informacion" name="centro_informacion" onkeyup="withSelectionRange(this);" data-length="100" value="" required>
                </div>

                <div class="col s2 center">
                    <b>Hora:</b>
                </div>
                <div class="col s4">
                    <input type="text" id="dateranage_ci_hora" name="dateranage_ci_hora" class="timepicker" required />
                </div>
            </div>
            <div class="row">

                <div class="col s2">
                    <b>San Joaquín:</b>
                </div>
                <div class="col s4">
                    <input type="text" id="san_joaquin" name="san_joaquin" onkeyup="withSelectionRange(this)" data-length="100" value="" required>
                </div>

                <div class="col s2 center">
                    <b>Hora:</b>
                </div>
                <div class="col s4">
                    <input type="text" id="dateranage_sj_hora" name="dateranage_sj_hora" class="timepicker" required />
                </div>
            </div>

            <div class="row" hidden>
                 
                <div class="col s2">
                    <b>Alertar a:</b>
                </div>
                <div class="col s8">
                    <select id="send_to" style="display: block" multiple>
                        <option value="all" selected>TODOS</option>
                        <?php

                        foreach ($contenedorUsuarios as $key => $usuario) {

                         /*   print_r($key); */
                           echo "<option value=" . $usuario["id"] . ">(" . $usuario["usuario"] . ") ". $usuario["nombre_completo"] . "</option>";
                        }

                        ?>
                    </select>
                </div>
                <div class="input-field checkboxes_send_to col s2">
                    <label>
                        <input id="check_send" type="checkbox" class="filled-in" />
                        <span>TODOS</span>
                    </label>
                </div>
            </div>

            <div class="row" data-step="4" data-intro="Al llenar los campos anteriores, presione el botón (podra repetir estos pasos para agregar más)">
                <div class="col s12 center-align">
                    <input id="crear_novedad" class="btn buttons-creacion" name="submit" type="submit" value="REGISTRAR">
                </div>
            </div>





            <div class="col s12 m12 l12">
                <table class="bordered highlight striped" id="tabla_novedades" style="width: 100%;" data-step="6" data-intro="En esta tabla encontrar&aacute; los puntos de medicion">
                    <thead>
                        <tr>
                            <th> No</th>
                            <th> Tipo</th>
                            <th>Hora de Afectación Inicio</th>
                            <th>Hora de Afectación Final</th>
                            <th>Lugar de la Afectación</th>
                            <th>Gasto</th>
                            <th>Razón</th>
                            <th>Reportó</th>
                            <th>Centro de Infomación</th>
                            <th>Hora</th>
                            <th>San Joaquin</th>
                            <th>Hora</th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>





        </form>
    </div>


    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datatables_vistas.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/novedades.js?v=<?php echo VERSION; ?>"></script>
    <!-- <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/jquery.timepicker.min.js"></script> -->




</main>
