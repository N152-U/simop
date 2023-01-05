<?php


    $show_login = false;
    if (isset($_GET['vistas'])) {
        $datos_url = explode("/", $_GET['vistas']);

        if (sizeof($datos_url) == 1) {
            $show_login = true;
        }
    } else {
        $show_login = true;
    }
    ?>
<?php if ($show_login) : ?>
<link rel="stylesheet" type='text/css' href="<?php echo SERVERURL; ?>vistas/assets/css/login.css?v=<?php echo VERSION; ?>">
<script src="http://www.google.com/recaptcha/api.js" async defer></script>
<div class="login-table">
    <div class="login-cell">
        <div id="login-page" class="row">
            <div class="col s12 z-depth-6 card-panel">
                <form class="login-form" id="login" method="post">
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>

                            <input class="validate" id="usuario" name="usuario" type="text">
                            <label for="usuario" data-error="wrong" data-success="right">Usuario</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">

                            <i class="material-icons prefix">lock_outline</i>
                            <input id="pwd" name="pwd" type="password">
                            <a href="#!" onclick="togglePassword(this)" class="tooltipped" data-position="top" data-tooltip="Mostrar / ocultar contraseña" style="position: absolute;right: 15px;"><i class="material-icons waves-effect right black-text">visibility
                                </i></a>
                            <label for="pwd">Contraseña</label>
                        </div>
                    </div>
                    <div id="recaptcha" class="row" hidden>
                        <div class="input-field col s4 offset-s2 ">
                            <div class="g-recaptcha" data-sitekey="6LcWP-kUAAAAAD2Twzxo_cRY0C8dMMWNPG4CcflF"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light col s12" type="submit">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<?php

    if (isset($_POST['usuario']) and isset($_POST['pwd'])) {

        require_once "./controladores/loginControlador.php";
        $login = new loginControlador();
        echo $login->iniciar_sesion_login_controlador();
       
    }
?>
<?php else :
    /*Si no se cumple la validacion, desplegamos la vista 404*/
    require_once "./vistas/templates/404.php";
    require_once "./vistas/modulos/footer.php";
    ?>


<?php endif; ?>