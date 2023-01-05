<?php
session_start();
$peticionAjax = TRUE;

require_once "../nucleo/configGeneral.php";
if (isset($_GET['token'])) {
    require_once "../controladores/loginControlador.php";
    $logout = new loginControlador();
    echo $logout->cerrar_sesion_login_controlador();
} else {
    unset($_SESSION[GUID]);
    //session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'login" </script>';
}
