<?php
$peticionAjax = TRUE;
session_start();
require_once "../controladores/tableroControlador.php";
$tableroInstance = new tableroControlador();

if (isset($_POST['accion']) && ($_POST['accion'] == "CONSULTA") && isset($_POST["intervalo_id"]) && isset($_POST["puntos"]) && isset($_POST["fecha_hora_inicial"]) && isset($_POST["fecha_hora_final"]) && isset($_SESSION[GUID]["id"])) {
  
    $res = $tableroInstance->obtener_puntos_tablero_controlador($_POST["intervalo_id"], $_POST["puntos"], $_POST["fecha_hora_inicial"], $_POST["fecha_hora_final"]);
    echo json_encode($res);
    header("HTTP/1.1 200");
}else{
    header("HTTP/1.1 500 Internal Error");
    echo "No se encontro resultado para los parametros proporcionados";
}