<?php
require_once "./controladores/usuarioControlador.php";
?>


<main>

    <!-- FORMULARIO -->
    <?php if ($vista) : ?>
        
        <form id="formularioUsuario" class="container" action="" method="POST" enctype="multipart/form-data">
            <div class="col s6 m6 l6 center-align" hidden>
                <input id="usuario_id" name="usuario_id" value="<?php echo isset($usuario_id) ? $usuario_id : '' ?>">
            </div>
            <div class="row">
                <div class="col s2">
                    Usuario:
                </div>
                <div class="col s10 ">
                    <input id="usuario" name="usuario" type="text" class="validate" onkeyup="sanitize(this)"  pattern="^[a-z]+([a-z0-9_]+)*" title="Este campo solo puede tener caracteres alfanumericos en minuscula y guion bajo como separador" value="<?php echo isset($usuarioDatos["usuario"]) ? $usuarioDatos["usuario"] : ""; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col s2">
                    <?php echo isset($usuarioDatos["id"]) ? "Nueva Contraseña:" : "Contraseña:"; ?>
                </div>
                <div class="col s10" style="position: relative;">
                    <input type="password" id="pwd"  class="validate" title="La contraseña debe cumplir con el formato (Una mayuscula, una minuscula, un numero, un caracter especial (#?!@%^&*-.), longitud de 8)" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@%^&*-.])(?!.*[$]).{8,}$">
                    <a href="#!" onclick="togglePassword(this)" class="tooltipped" data-position="top" data-tooltip="Mostrar / ocultar contraseña" style="position: absolute;right: 15px;"><i class="material-icons waves-effect right black-text">visibility
                        </i></a>
                </div>
            </div>
            <div class="row">
                <div class="col s2">
                    Confirmación de Contraseña:
                </div>
                <div class="col s10" style="position: relative;">
                    <input type="password" id="confirmacion_pwd" name="pwd" class="validate" title="La contraseña debe coincidir con el campo anterior" pattern="" value="" <?php echo isset($usuarioDatos["id"]) ? "" : "required"; ?>>
                    <a href="#!" onclick="togglePassword(this)" class="tooltipped" data-position="top" data-tooltip="Mostrar / ocultar contraseña" style="position: absolute;right: 15px;"><i class="material-icons waves-effect right black-text">visibility
                        </i></a>
                </div>
            </div>
            <div class="row">
                <div class="col s2">
                    Nombre(s):
                </div>
                <div class="col s10 ">
                    <input id="nombre" name="nombre" pattern="^[a-zA-Z]+( [a-zA-Z0-9_]+)*" title="Este campo debe iniciar y terminar con un caracter alfanumerico" type="text" class="validate" onkeyup="withSelectionRange(this)" value="<?php echo isset($usuarioDatos["nombre"]) ? $usuarioDatos["nombre"] : ""; ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col s2">
                    Paterno:
                </div>
                <div class="col s10 ">
                    <input id="ap" name="ap" pattern="^[a-zA-Z]+( [a-zA-Z0-9_]+)*" title="Este campo debe iniciar y terminar con un caracter alfanumerico" type="text" class="validate" onkeyup="withSelectionRange(this)" value="<?php echo isset($usuarioDatos["ap"]) ? $usuarioDatos["ap"] : ""; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col s2">
                    Materno:
                </div>
                <div class="col s10 ">
                    <input id="am" name="am" pattern="^[a-zA-Z]+( [a-zA-Z0-9_]+)*" title="Este campo debe iniciar y terminar con un caracter alfanumerico" type="text" class="validate" onkeyup="withSelectionRange(this)" value="<?php echo isset($usuarioDatos["am"]) ? $usuarioDatos["am"] : ""; ?>" required>
                </div>
            </div>
            <!--<div class="row">
            <div class="col s2">
                Correo*:
            </div>
            <div class="col s10">
            <input type="email" id="email" pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$" name="email" class="validate" required="" aria-required="true">
            </div>
        </div>-->



            <div class="row">
                <div class="col s2">
                    Rol del Usuario:
                </div>
                <div class="col s10 ">

                    <select id="rol_id" name="rol_id" style="display: block" required>

                        <?php if (!isset($usuarioDatos["rol_id"])) echo '<option></option>'; ?>
                        <?php foreach ($rolesContenedor as $rol) { ?>
                            <option <?php echo (isset($usuarioDatos["rol_id"]) && $usuarioDatos["rol_id"] == $rol["id"]) ? "value='" . $usuarioDatos["rol_id"] . "' selected" : "value='" . $rol['id'] . "'" ?>><?php echo $rol['rol']; ?></option>
                        <?php } ?>
                    </select>

                </div>

            </div>




            <div class="row">
                <div class="col s12 center-align">
                    <input id="crear_editar_usuario" class="btn buttons-creacion" name="submit" type="submit" value="<?php echo isset($usuarioDatos["id"]) ? "EDITAR" : "CREAR"; ?>">
                </div>

            </div>

        </form>
        <?php if(isset($advertencia_autoeditado)&&$advertencia_autoeditado):?>
            <script>swal({
                title:"ADVERTENCIA",
                text:"Esta editando su misma cuenta, los cambios se veran reflejados en el proximo inicio de sesión",
                type:"warning"
            });
            </script>
        <?php endif;?>
        <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/usuario.js?v=<?php echo VERSION; ?>"></script>
    <?php else :
        /*Si no se cumple la validacion, desplegamos el modulo de error*/
        $show_footer = false;
        $mensaje = "La página solicitada no existe o no se encuentra disponible";
        require_once "./vistas/modulos/error.php"; ?>



    <?php endif; ?>

</main>