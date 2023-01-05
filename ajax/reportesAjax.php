<?php
$peticionAjax = TRUE;
session_start();
require_once "../nucleo/configGeneral.php";
require_once "../controladores/reportesControlador.php";

$reportesInstance = new reportesControlador();
    // REVISADO POR ALAN
if (isset($_POST['reporte_id']) && isset($_POST['accion']) && ($_POST['accion'] == "TRAERDATOSREPORTES")) {
    $res = $reportesInstance->obtener_datos_personal_pdf_reporte_controlador($_POST['reporte_id']);
    echo json_encode($res);
}

if (isset($_POST['reporte_id']) && isset($_POST['accion']) && ($_POST['accion'] == "TRAERNOTAS")) {
    $res = $reportesInstance->obtener_datos_personal_pdf_notas_controlador($_POST['reporte_id']);
    echo json_encode($res);
}
if (isset($_POST['reporte_id']) && isset($_POST['accion']) && ($_POST['accion'] == "TRAERNOVEDADES")) {
    $res = $reportesInstance->obtener_datos_personal_pdf_novedades_controlador($_POST['reporte_id']);
    echo json_encode($res);
    //print_r('llego');
}