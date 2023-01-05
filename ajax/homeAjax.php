<?php
$peticionAjax = TRUE;
session_start();
require_once "../nucleo/configGeneral.php";
require_once "../controladores/homeControlador.php";
$homeInstance = new homeControlador();
if (isset($_POST['tipo_puntos']) && ($_POST['accion'] == "CONSULTA") && isset($_SESSION[GUID]["id"])) {
   
    $res=homeControlador::consulta_informacion_puntos_home_controlador($_POST['tipo_puntos']);
    
    header("HTTP/1.1 200 OK");
    echo json_encode($res);
    
}else{
    header("HTTP/1.1 500 ERROR");
    echo "ERROR. No se puede procesar su peticion";
}
