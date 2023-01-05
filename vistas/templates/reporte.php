<main>

    <div class="container">
        <div class="row">
            <h5 style="display: inline-block;">Datos del Reporte </h5>
        </div>
        <form id="formularioReporte" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col s12 m2">
                    <b>Fecha:</b>
                </div>
                <div class="col s12 m4">
                    <input type="text" id="fecha" name="fecha" class="datepicker" required>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m2">
                    <b>Reporte de la Planta de Berros 5:</b>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m10 offset-m2">

                    <div class="checkboxes_equipo_uno  col s12 m4">
                        <label>
                            <input id="check_equipo_uno" name="check_equipo[]" type="checkbox" class="filled-in" value="1">
                            <span>EQUIPO 1 (4745.4)</span>
                        </label>
                    </div>
                    <div class="checkboxes_equipo_dos col s12 m4">
                        <label>
                            <input id="check_equipo_dos" name="check_equipo[]" type="checkbox" class="filled-in" value="2">
                            <span>EQUIPO 2 (4745.4) </span>
                        </label>
                    </div>

                    <div class="checkboxes_equipo_tres col s12 m4">
                        <label>
                            <input id="check_equipo_tres" name="check_equipo[]" type="checkbox" class="filled-in" value="3">
                            <span>EQUIPO 3 (4745.4)</span>
                        </label>
                    </div>

                </div>
                <div class="row">
                    <div class="col s12 m10 offset-m2">

                        <div class="checkboxes_equipo_cuatro col s12 m4">
                            <label>
                                <input id="check_equipo_cuatro" name="check_equipo[]" type="checkbox" class="filled-in" value="4">
                                <span>EQUIPO 4 (4745.4)</span>
                            </label>
                        </div>
                        <div class="checkboxes_equipo_cinco col s12 m4">
                            <label>
                                <input id="check_equipo_cinco" name="check_equipo[]" type="checkbox" class="filled-in" value="5">
                                <span>EQUIPO 5 (4807.2)</span>
                            </label>
                        </div>

                        <div class="checkboxes_equipo_seis col s12 m4">
                            <label>
                                <input id="check_equipo_seis" name="check_equipo[]" type="checkbox" class="filled-in" value="6">
                                <span>EQUIPO 6 (4745.4)</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m10 offset-m2">

                            <div class="checkboxes_equipo_siete col s12 m4">
                                <label>
                                    <input id="check_equipo_siete" name="check_equipo[]" type="checkbox" class="filled-in" value="7">
                                    <span>EQUIPO 7 (1809.6)</span>
                                </label>
                            </div>
                            <div class="checkboxes_equipo_ocho col s12 m4">
                                <label>
                                    <input id="check_equipo_ocho" name="check_equipo[]" type="checkbox" class="filled-in" value="8">
                                    <span>EQUIPO 8 (1809.6) </span>
                                </label>
                            </div>

                            <div class="checkboxes_equipo_nueve col s12 m4">
                                <label>
                                    <input id="check_equipo_nueve" name="check_equipo[]" type="checkbox" class="filled-in" value="9">
                                    <span>EQUIPO 9 (1809.6)</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12 m2">
                            <b>Reporte de Lluvia:</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m2 offset-m2">
                            <b>Almoloya:</b>
                        </div>
                        <div class="col s12 m8">
                            <div class="col s12 m8">

                                <input type="text" id="lluvia_almoloya" name="lluvia_almoloya" onkeyup="withSelectionRange(this)" data-length="100" value="" required>
                            </div>

                            <div class="checkboxes_lluvia_almoloya col s12 m4">
                                <label>
                                    <input id="check_lluvia_almoloya" type="checkbox" class="filled-in">
                                    <span>SIN LLUVIA EN ALMOLOYA</span>
                                </label>
                            </div>

                        </div>

                        <div class="col s12 m2 offset-m2">
                            <b>Villa Carmela:</b>
                        </div>
                        <div class="col s12 m8">
                            <div class="col s12 m8">

                                <input type="text" id="lluvia_villa_carmela" name="lluvia_villa_carmela" onkeyup="withSelectionRange(this)" data-length="100" value="" required>
                            </div>
                            <div class="checkboxes_lluvia_villa_carmela col s12 m4">
                                <label>
                                    <input id="check_lluvia_villa_carmela" type="checkbox" class="filled-in">
                                    <span>SIN LLUVIA EN VILLA CARMELA</span>
                                </label>
                            </div>

                        </div>

                        <div class="col s12 m2 offset-m2">
                            <b>Alzate:</b>
                        </div>
                        <div class="col s12 m8">
                            <div class="col s12 m8">

                                <input type="text" id="lluvia_alzate" name="lluvia_alzate" onkeyup="withSelectionRange(this)" data-length="100" value="" required>
                            </div>
                            <div class="checkboxes_lluvia_alzate col s12 m4">
                                <label>
                                    <input id="check_lluvia_alzate" type="checkbox" class="filled-in">
                                    <span>SIN LLUVIA EN ALZATE</span>
                                </label>
                            </div>

                        </div>



                        <div class="col s12 m2 offset-m2">
                            <b>Ixtlahuaca:</b>
                        </div>
                        <div class="col s12 m8">
                            <div class="col s12 m8">

                                <input type="text" id="lluvia_ixtlahuaca" name="lluvia_ixtlahuaca" onkeyup="withSelectionRange(this)" data-length="100" value="" required>
                            </div>
                            <div class="checkboxes_lluvia_ixtlahuaca col s12 m4">
                                <label>
                                    <input id="check_lluvia_ixtlahuaca" type="checkbox" class="filled-in">
                                    <span>SIN LLUVIA EN IXTLAHUACA</span>
                                </label>
                            </div>



                        </div>

                    </div>

                    <div class="row">
                        <div class="col s12 m2">
                            <b>Reporte a Información:</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m2 offset-m2">
                            <b>Hora Recibio:</b>
                        </div>
                        <div class="col s12 m8">
                            <input type="text" id="hora_recibio" name="hora_recibio" class="timepicker" required>
                        </div>
                        <div class="col s12 m2 offset-m2">
                            <b>Recibio:</b>
                        </div>
                        <div class="col s12 m8">
                            <input type="text" id="recibio" name="recibio" onkeyup="withSelectionRange(this)" data-length="100" value="" required>
                        </div>
                        <div class="col s12 m2 offset-m2">
                            <b>Transmitio:</b>
                        </div>
                        <div class="col s12 m8">
                            <input type="text" id="transmitio" name="transmitio" onkeyup="withSelectionRange(this)" data-length="100" value="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m2">
                            <b>Gasto Promedio Venado [L/s]:</b>
                        </div>
                        <div class="col s12 m10">
                            <input type="number" id="gasto_venado" name="gasto_venado" onkeyup="withSelectionRange(this)" data-length="100" value="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m2">
                            <b>1er Operador:</b>
                        </div>
                        <div class="col s12 m10">
                            <input type="text" id="operador_uno" name="operador_uno" onkeyup="withSelectionRange(this)" data-length="100" value="" required>
                        </div>
                        <div class="col s12 m2">
                            <b>2do Operador:</b>
                        </div>
                        <div class="col s12 m10">
                            <input type="text" id="operador_dos" name="operador_dos" onkeyup="withSelectionRange(this)" data-length="100" value="" required>
                        </div>
                        <div class="col s12 m2">
                            <b>Jefe Responsable de Turno:</b>
                        </div>
                        <div class="col s12 m10">
                            <input type="text" id="jefe_reponsable_turno" name="jefe_reponsable_turno" onkeyup="withSelectionRange(this)" data-length="100" value="" required>
                        </div>

                    </div>

                    <div class="row" data-step="4" data-intro="Al llenar los campos anteriores, presione el botón (podra repetir estos pasos para agregar más)">
                        <div class="col s12 center-align">
                            <input id="crear_reporte" class="btn buttons-creacion" name="submit" type="submit" value="REGISTRAR">
                        </div>
                    </div>

        </form>
    </div>

    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/reporte.js?v=<?php echo VERSION; ?>"></script>
    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/datepicker.js?v=<?php echo VERSION; ?>"></script>
</main>