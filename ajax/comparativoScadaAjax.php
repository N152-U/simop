<?php
$peticionAjax = TRUE;
session_start();
require_once "../controladores/comparativoScadaControlador.php";

$instanciaComparativoScada = new comparativoScadaControlador();
if (isset($_POST['accion']) && ($_POST['accion'] == "CONSULTAR")&&$instanciaComparativoScada::consulta_permisos_rol("('COMPARATIVOSCADA')",$instanciaComparativoScada::decryption($_SESSION[GUID]["rol_id"]))->rowCount()>=1) {
    $res = $instanciaComparativoScada->consultar_comparativo_scada_controlador();
    echo json_encode($res);
}else if (isset($_POST['accion']) && ($_POST['accion'] == "OBTENER_REGISTROS")&&isset($_POST["tabla"])&&$instanciaComparativoScada::consulta_permisos_rol("('COMPARATIVOSCADA')",$instanciaComparativoScada::decryption($_SESSION[GUID]["rol_id"]))->rowCount()>=1) {
    $res = $instanciaComparativoScada->obtener_registros_comparativo_scada_controlador($_POST);
    echo json_encode($res);
}else if (isset($_POST['accion']) && ($_POST['accion'] == "OBTENER_PROPIEDADES")&&isset($_POST["tabla"])&&isset($_POST["registro_id"])&&$instanciaComparativoScada::consulta_permisos_rol("('COMPARATIVOSCADA')",$instanciaComparativoScada::decryption($_SESSION[GUID]["rol_id"]))->rowCount()>=1) {
    $res = $instanciaComparativoScada->obtener_propiedades_comparativo_scada_controlador($_POST);
    echo json_encode($res);
}else if (isset($_POST['accion']) && ($_POST['accion'] == "CONSULTAR_COMPARATIVO")&&isset($_POST["fecha_hora_inicial"])&&isset($_POST["fecha_hora_final"])&&isset($_POST["propiedad"])&&isset($_POST["tabla_comparativa"])&&isset($_POST["gateId"])&&isset($_POST["registro_id"])&&$instanciaComparativoScada::consulta_permisos_rol("('COMPARATIVOSCADA')",$instanciaComparativoScada::decryption($_SESSION[GUID]["rol_id"]))->rowCount()>=1) {
    $res = $instanciaComparativoScada->consultar_comparativo_comparativo_scada_controlador($_POST);
    echo json_encode($res);
}
