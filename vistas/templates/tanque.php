<?php
require_once "./controladores/tanqueControlador.php";

?>
<main>

    <div class="container">
        <form id="form-captura-tanque" method="post" enctype="multipart/form-data">

            <div class="row">

                <div class="input-field col s6" data-step="1" data-intro="Seleccione el tanque (la opcion que seleccione filtrara los siguientes campos).">
                    <select id="tanque_id" name="tanque_id" onchange="lasHoras(this)" required>
                        <option selected disabled></option>

                        <?php

                        foreach ($contenedor_tanques as $key => $tanque) {

                            echo "<option value=" . $tanque["id"] . " disabled>" . $tanque["tanque"]  . "</option>";
                        }

                        ?>

                    </select>
                    <label for="tanque_id">Tanque</label>
                </div>

                <div class="input-field col s6">
                    <select id="fecha_hora_programada" name="fecha_hora_programada"></select>
                    <label for="fecha_hora_programada">Fecha Programada</label>
                </div>

            </div>

            <div class="row col 12">

                <div class="input-field col s6 uno" hidden>
                    <input id="tirante_uno" name="tirante_uno" type="number" min="0" step="0.01" onblur="revisarTirante(this)" required disabled>
                    <label for="tirante_uno">Tirante Tanque #1 (m)</label>
                </div>

                <div class="input-field col s6 dos" hidden>
                    <input id="tirante_dos" name="tirante_dos" type="number" min="0" step="0.01" onblur="revisarTirante(this)" required disabled>
                    <label for="tirante_dos">Tirante Tanque #2 (m)</label>
                </div>

                <div class="input-field col s6 tres" hidden>
                    <input id="tirante_tres" name="tirante_tres" type="number" min="0" step="0.01" onblur="revisarTirante(this)" required disabled>
                    <label for="tirante_tres">Tirante Tanque #3 (m)</label>
                </div>

                <div class="input-field col s6 cuatro" hidden>
                    <input id="tirante_cuatro" name="tirante_cuatro" type="number" min="0" step="0.01" onblur="revisarTirante(this)" required disabled>
                    <label for="tirante_cuatro">Tirante Tanque #4 (m)</label>
                </div>

                <div class="input-field col s6 cinco" hidden>
                    <input id="vertedor" name="vertedor" type="number" min="0" step="0.01" required disabled>
                    <label for="vertedor">Vertedor</label>
                </div>

                <div class="input-field col s6 seis" hidden>
                    <input id="descarga_uno" name="descarga_uno" type="number" min="0" step="0.01" required disabled>
                    <label for="descarga_uno">Descarga</label>
                </div>

                <div class="input-field col s6 siete" hidden>
                    <input id="descarga_dos" name="descarga_dos" type="number" min="0" step="0.01" required disabled>
                    <label for="descarga_dos">Segunda Descarga</label>
                </div>

                <div class="input-field col s6 ocho" hidden>
                    <input id="descarga_tres" name="descarga_tres" type="number" min="0" step="0.01" required disabled>
                    <label for="descarga_tres">Tercer Descarga</label>
                </div>

                <div class="input-field col s6 nueve" hidden>
                    <input id="local" name="local" type="number" min="0" step="0.01" required disabled>
                    <label for="local">Local</label>
                </div>

                <div class="input-field col s6 diez" hidden>
                    <input id="presion" name="presion" type="number" min="0" required disabled>
                    <label for="presion">Presion</label>
                </div>

                <div class="input-field col s6 once" hidden>
                    <input id="gasto" name="gasto" type="number" min="0" required disabled>
                    <label for="gasto">Gasto</label>
                </div>

                <div class="input-field col s6 doce" hidden>
                    <input id="eq1" name="eq1" type="number" min="0" required disabled>
                    <label for="eq1">Eq. Op. 1</label>
                </div>

                <div class="input-field col s6 trece" hidden>
                    <input id="eq2" name="eq2" type="number" min="0" required disabled>
                    <label for="eq2">Eq. Op. 2</label>
                </div>

                <div class="input-field col s6 catorce" hidden>
                    <input id="eq3" name="eq3" type="number" min="0" required disabled>
                    <label for="eq3">Eq. Op. 3</label>
                </div>

                <div class="input-field col s6 quince" hidden>
                    <input id="eq4" name="eq4" type="number" min="0" required disabled>
                    <label for="eq4">Eq. Op. 4</label>
                </div>

                <div class="input-field col s6 diecises" hidden>
                    <input id="eq5" name="eq5" type="number" min="0" required disabled>
                    <label for="eq5">Eq. Op. 5</label>
                </div>

                <div class="input-field col s6 diecisiete" hidden>
                    <input id="bypass" name="bypass" type="number" min="0" required disabled>
                    <label for="bypass">Bypass</label>
                </div>

                <div class="input-field col s6 dieciocho" hidden>
                    <input id="equipos" name="equipos" type="text" maxlength="50" onkeyup="withSelectionRange(this)" required disabled>
                    <label for="equipos">Equipos</label>
                </div>

            </div>

            <div class="row">

                <div class="input-field col s4">

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

                <div class="input-field col s6">
                    <input id="novedad" name="novedad" placeholder="" type="text" data-length="300" onkeyup="withSelectionRange(this)" required>
                    <label for="novedad">Novedades</label>
                </div>

                <div class="col s2">
                    <label>
                        <input id="sin_novedad" onclick="sinNovedad(this)" type="checkbox">
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
                <table class="bordered highlight striped" id="tabla_tanque" style="width: 100%;" data-step="5" data-intro="En esta tabla encontrará los artículos del contrato">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanque</th>
                            <th>Fecha</th>

                            <!-- 3 -->
                            <th>Tirante Tanque #1 (m)</th>
                            <!-- 4 -->
                            <th>Tirante Tanque #2 (m)</th>
                            <!-- 5 -->
                            <th>Tirante Tanque #3 (m)</th>
                            <!-- 6 -->
                            <th>Tirante Tanque #4 (m)</th>
                            <!-- 7 -->
                            <th>Vertedor</th>
                            <!-- 8 -->
                            <th>Descarga</th>
                            <!-- 9 -->
                            <th>2da Descarga</th>
                            <!-- 10 -->
                            <th>3er Descarga</th>
                            <!-- 11 -->
                            <th>Local</th>
                            <!-- 12 -->
                            <th>Presion</th>
                            <!-- 13 -->
                            <th>Gasto</th>
                            <!-- 14 -->
                            <th>Equipo Operativo</th>
                            <!-- 15 -->
                            <th>Eq. Op. 2</th>
                            <!-- 16 -->
                            <th>Eq. Op. 3</th>
                            <!-- 17 -->
                            <th>Eq. Op. 4</th>
                            <!-- 18 -->
                            <th>Eq. Op. 5</th>
                            <!-- 19 -->
                            <th>Bypass</th>
                            <!-- 20 -->
                            <th>Equipo</th>

                            <th>Transmite</th>
                            <th>Novedad</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </form>
    </div>

    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datepicker.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datatables_vistas.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/tanque.js?v=<?php echo VERSION; ?>"></script>

</main>