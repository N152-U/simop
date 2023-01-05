<?php
session_start();
require_once "../controladores/permisosControlador.php";
$permisosInstancia = new permisosControlador();

    if (isset($_POST["accion"]) && $_POST["accion"] == "CONSULTAPERMISOS") {

        $res = $permisosInstancia->consulta_permisos_permisos_controlador($_POST["permisos"],$permisosInstancia::decryption($_SESSION[GUID]["rol_id"]));
        echo json_encode ($res);

    }


    