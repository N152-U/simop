<?php
require_once "./controladores/rolControlador.php";
?>
<main>
    <?php if ($vista) : ?>
        <form id="formularioUsuario" class="container" action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col s2">
                    <span>Rol:</span>
                </div>
                <div class="col s10 ">
                    <input id="rol_id" name="rol_id" value="<?php echo isset($rol_id) ? $rol_id : '' ?>" hidden>
                    <input id="rol" name="rol"  class="validate" onkeyup="withSelectionRange(this)"  pattern="^[a-zA-Z_]+( [a-zA-Z0-9_]+)*" title="Este campo debe iniciar y terminar con un caracter alfanumerico" value="<?php echo isset($rolDatos["rol"]) ? $rolDatos["rol"] : ''; ?>" type="text">

                </div>

            </div>

            <div class="row">Seleccione las opciones sobre las que tiene permisos <b>(al menos una)</b></div>
            <div class="row permisos">

                <?php foreach ($permisosContenedor as $index => $permiso) {
                    $esActivo = false;
                    $keys = array_keys($permiso);

                    //$tipo_bien = utf8_encode($tipo_bien);
                    foreach ($permisosDatos as $rol_permiso) {
                        if ($permiso['id'] == $rol_permiso['permiso_id']) {
                            $esActivo = true;
                        }
                    }
                    if ($esActivo) {
                        // if ($tipoAdministrador) {
                        //     echo '<div class="col s6"><label>
                        //                         <input id="checkbox_1' . $permiso["id"] . '" type="checkbox" name="permiso_id[' . $permiso["id"] . ']" class="filled-in"  checked="true" disabled/>
                        //                         <span>' . $permiso["leyenda"] . '</span>
                        //                         </label></div>';
                        // } else {
                        echo '<div class="col s6"><label>
                                        <input id="checkbox_1' . $permiso["id"] . '" type="checkbox" name="permiso_id[' . $permiso["id"] . ']" class="filled-in"  checked="true"/>
                                        <span>' . $permiso["leyenda"] . '</span>
                                        </label></div>';
                        // }
                    } else {
                        echo '<div class="col s6"><label>
                                        <input id="checkbox_1' . $permiso["id"] . '" type="checkbox" name="permiso_id[' . $permiso["id"] . ']" class="filled-in"  />
                                        <span>' . $permiso["leyenda"] . '</span>
                                        </label></div>';
                    }
                } ?>
            </div>
            <div class="row">
                <div class="col s12 center-align">
                    <input id="crear_editar_rol" class="btn buttons-creacion" name="submit" type="submit" value="<?php echo isset($rolDatos["id"]) ? "EDITAR" : "CREAR"; ?>">
                </div>

            </div>
        </form>
        <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/rol.js?v=<?php echo VERSION; ?>"></script>
    <?php else :
        /*Si no se cumple la validacion, desplegamos el modulo de error*/
        $show_footer = false;
        $mensaje = "La página solicitada no existe o no se encuentra disponible";
        require_once "./vistas/modulos/error.php"; ?>



    <?php endif; ?>


</main>