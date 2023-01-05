<?php
$peticionAjax = TRUE;
session_start();
require_once "../controladores/graficaRiegoControlador.php";
$tableroInstance = new graficaRiegoControlador();

if (isset($_POST['accion']) && ($_POST['accion'] == "CONSULTA") && isset($_SESSION[GUID]["id"])) {
  
    $res = $tableroInstance->obtener_puntos_tablero_controlador( $_POST["anio"]);
    
    echo json_encode($res);
  
    header("HTTP/1.1 200");
}else{
    header("HTTP/1.1 500 Internal Error");
    echo "No se encontro resultado para los parametros proporcionados";
}