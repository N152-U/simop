<?php
require_once "./controladores/capturaControlador.php";
?>
<main>
    <link rel="stylesheet" type='text/css' href="<?php echo SERVERURL; ?>vistas/assets/css/captura.css?v=<?php echo VERSION; ?>">
    <div id="editar_punto" class="acciones-privilegiadas" hidden>
        <a href="#!"><i class="fal fa-edit" aria-hidden="true"></i> <span>Edición</span></a>
    </div>
    <div class="container">

        <form id="formularioCaptura" method="post" enctype="multipart/form-data">

            <div data-step="1" data-intro="Introduzca los datos del punto de monitoreo">
                <div class="row" data-step="2" data-intro="Elija el punto de monitoreo">
                    <div class="col s2">
                        <b>Punto de Monitoreo:</b>
                    </div>
                    <div class="col s10">
                        <select id="punto_id" name="punto_id" style="display: block" required>
                            <option selected disabled></option>

                            <?php

                            foreach ($contenedorpuntos as $key => $punto) {

                                echo "<option value=" . $punto["id"] . " disabled>" . $punto["nombre_punto"]  . "</option>";
                            }

                            ?>

                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s2">
                    <b>Fecha Programada:</b>
                </div>
                <div class="col s10">
                    <select id="hora_programada" name="hora_programada" style="display: block" required>

                    </select>
                </div>


            </div>

            <div id="bombas_contenedor" class="row" data-step="2" data-intro="Elija el pozo">
                <div class="col s2">
                    <b>Bomba:</b>
                </div>
                <div class="col s8">

                    <select id="bomba_id" name="bomba_id[]" multiple="multiple" style="display: block" required>

                        <?php

                        foreach ($contenedorbombas as $key => $bomba) {

                            echo "<option value=" . $bomba["id"] . ">" . $bomba["bomba"]  . "</option>";
                        }

                        ?>
                    </select>

                </div>

                <div class="input-field checkboxes_bombas col s2">
                    <label>
                        <input id="check_bombas" type="checkbox" class="filled-in" />
                        <span>NO APLICA</span>
                    </label>
                </div>

            </div>

            <div id="presion_contenedor" class="row">
                <div class="col s2">
                    <b> Presion:</b>
                </div>
                <div class="col s10">
                    <input id="presion" type="number" name="presion" step="0.01" class="disabled" value="<?php echo isset($datospozo["presion"]) ? $datospozo["presion"] : ""; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col s2">
                    <b>Tirante:</b>
                </div>
                <div class="col s10">
                    <input type="number" oninput="calculaGasto(this)" id="tirante" name="tirante" step="0.01" class="" value="<?php echo isset($datospozo["tirante"]) ? $datospozo["tirante"] : ""; ?>" required>
                </div>
            </div>

            <div class="row" id="gasto_contenedor">
                <div class="col s2">
                    <b> Gasto [L/s]</b>:
                </div>
                <div class="col s10">
                    <input type="number" id="gasto" name="gasto" step="0.00001" class="" value="<?php echo isset($datospozo["gasto"]) ? $datoscontrato["gasto"] : ""; ?>" readonly>
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

            <div class="row">
                <div class="col s2">
                    <b>Novedades:</b>
                </div>


                <div class="col s8 m8 l8">

                    <textarea onkeyup="withSelectionRange(this)" id="desc_novedades" name="novedades" type="text" class="materialize-textarea" data-length="300" cols="15" rows="15" placeholder="" required></textarea>

                </div>
                <div class="col s2">
                    <label>
                        <input id="check_desc_novedades" type="checkbox" class="filled-in">
                        <span>SIN NOVEDAD</span>
                    </label>
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
                            <th>Punto de Monitoreo</th>
                            <th>Hora</th>
                            <th>Bomba</th>
                            <th>Presión</th>
                            <th>Tirante</th>
                            <th>Gasto</th>
                            <th>Transmite</th>
                            <th>Observaciones</th>

                        </tr>
                    </thead>
                    <tbody>



                    </tbody>

                </table>
            </div>





        </form>


        <form id="formularioConsultaEdicion" method="post" enctype="multipart/form-data" hidden>
            <div class="row">
                <div>
                    <h5 style="display: inline-block;">Busqueda de registros</h4>
                </div>
                <div class="col s3 m5 ">
                    <label>
                        <span>Punto de Monitoreo:</span>
                        <select id="punto_id_busqueda_edicion" style="display: block">
                            <option selected disabled></option>

                            <?php

                            foreach ($contenedorpuntos as $key => $punto) {

                                echo "<option value=" . $punto["id"] . ">" . $punto["nombre_punto"]  . "</option>";
                            }

                            ?>

                        </select>

                    </label>
                </div>

                <div id="horas_contenedor_edicion" class="col s5">
                    <label>
                        <span>Rango Búsqueda Fechas:</span>

                        <input id="daterange_diario_edicion" style="display: block" disabled />
                    </label>
                </div>

                <div class="col s2 m1 center-align">
                    <input id="consulta" class="btn buttons-creacion" type="submit" value="CONSULTA">
                </div>
            </div>
        </form>



        <form id="formularioEdicion" method="post" enctype="multipart/form-data" hidden>

            <div data-step="1" data-intro="Introduzca los datos del punto de monitoreo">


                <div class="row" data-step="2" data-intro="Elija el punto de monitoreo">
                    <div id="tabla_contenedor_edicion" class="col s12 m12 l12 xl12">

                        <table class="bordered highlight striped" id="tabla_captura_edicion" style="width: 100%;" data-step="5" data-intro="En esta tabla encontrará los artículos del contrato">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Hora</th>
                                    <th>Tirante</th>
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                <!-- Se llena mediante AJAX -->
                            </tbody>

                        </table>

                    </div>

                    <div id="campos_contenedor_edicion" class="col s12 m6 l12 xl6" hidden>
                        <div>
                            <h5 style="display: inline-block;">Campos del registro seleccionado</h4>
                                <input id="registro_id_edicion" name="registro_id" type="number" class="" value="" hidden>
                        </div>

                        <div id="nombre_punto_contenedor_edicion" class="col s12">
                            <label>
                                <span>Punto de monitoreo:</span>
                                <input id="nombre_punto_edicion" type="text" step="0.01" class="" value="" disabled>
                                <input id="punto_id_edicion" name="punto_id" type="number" class="" value="" hidden>
                            </label>
                        </div>
                        <div id="hora_contenedor_edicion" class="col s12">
                            <label>
                                <span>Hora programada:</span>
                                <input id="hora_programada_edicion" name="hora_programada" type="text" step="0.01" class="disabled" value="" readonly>
                            </label>
                        </div>
                        <div id="bombas_contenedor_edicion">
                            <div class="col s8">
                                <label>
                                    <span>Bombas:</span>


                                    <select id="bomba_id_edicion" name="bomba_id[]" multiple="multiple" style="display: block">
                                        <?php

                                        foreach ($contenedorbombas as $key => $bomba) {

                                            echo "<option value=" . $bomba["id"] . ">" . $bomba["bomba"]  . "</option>";
                                        }

                                        ?>
                                    </select>


                                </label>
                            </div>

                            <div class="input-field checkboxes_bombas col s4">
                                <label>
                                    <input id="check_bombas_edicion" type="checkbox" class="filled-in" />
                                    <span>NO APLICA</span>
                                </label>
                            </div>

                        </div>


                        <div id="presion_contenedor_edicion" class="col s12">
                            <label>
                                <span>Presion:</span>
                                <input id="presion_edicion" type="number" name="presion" step="0.01" class="disabled" value="" readonly>
                            </label>
                        </div>
                        <div id="tirante_contenedor_edicion" class="col s12">
                            <label>
                                <span>Tirante:</span>
                                <input type="number" oninput="calculaGastoEdicion(this)" id="tirante_edicion" name="tirante" step="0.01" class="" value="" required>
                            </label>
                        </div>
                        <div id="gasto_contenedor_edicion" class="col s12">
                            <label>
                                <span>Gasto [L/s]:</span>
                                <input type="number" id="gasto_edicion" name="gasto" step="0.00001" class="" value="" readonly>
                            </label>
                        </div>
                        <div id="transmite_contenedor_edicion" class="col s12">
                            <label>
                                <span>Transmite:</span>
                                <select id="transmitio_edicion" name="usuario_id" style="display: block">
                                    <option selected disabled></option>

                                    <?php

                                    foreach ($contenedorUsuarios as $key => $usuario) {

                                        echo "<option value='" . $usuario["id"] . "'>" . $usuario["nombre_completo"]  . "</option>";
                                    }

                                    ?>
                                </select>

                            </label>
                        </div>

                        <div id="novedades_contenedor_edicion" class="col s8">
                            <label>
                                <span>Novedades:</span>
                                <textarea onkeyup="withSelectionRange(this)" id="desc_novedades_edicion" name="novedades" type="text" class="materialize-textarea" data-length="300" cols="15" rows="15" placeholder="" required></textarea>
                            </label>
                        </div>
                        <div class="input-field col s4">
                            <label>
                                <input id="check_desc_novedades_edicion" type="checkbox" class="filled-in">
                                <span>SIN NOVEDAD</span>
                            </label>
                        </div>

                        <div class="row" data-step="4" data-intro="Al llenar los campos anteriores, presione el botón (podra repetir estos pasos para agregar más)">
                            <div class="col s12 center-align">
                                <input id="submit_edicion" class="btn buttons-creacion" name="submit" type="submit" value="REGISTRAR">
                            </div>
                        </div>
                    </div>

                </div>


            </div>

        </form>
    </div>


    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datepicker.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datatables_vistas.js?v=<?php echo VERSION; ?>"></script>

    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/captura.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/captura_edicion.js?v=<?php echo VERSION; ?>"></script>



</main>