<?php
$peticionAjax = TRUE;
session_start();
require_once "../controladores/reporteControlador.php";

$reporteInstance = new reporteControlador();
if (isset($_POST['accion']) && ($_POST['accion'] == "GUARDAR")&&$reporteInstance::consulta_permisos_rol("('CREARREPORTE')",$reporteInstance::decryption($_SESSION[GUID]["rol_id"]))->rowCount()>=1) {
    $res = $reporteInstance->crear_registros_reporte_controlador($_POST);
    echo $res;
}
