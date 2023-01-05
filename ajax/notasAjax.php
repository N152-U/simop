<?php
$peticionAjax = TRUE;
session_start();
require_once "../controladores/notasControlador.php";

$notasInstance = new notasControlador();
if (isset($_POST['accion']) && ($_POST['accion'] == "GUARDAR")&&$notasInstance::consulta_permisos_rol("('CREARNOTA')",$notasInstance::decryption($_SESSION[GUID]["rol_id"]))->rowCount()>=1) {
    $res = $notasInstance->crear_registros_notas_controlador($_POST);
    echo $res;
}
else if(isset($_POST['accion'])&&($_POST['accion'] == "CONSULTA") && $notasInstance::consulta_permisos_rol("('LEERNOTA')",$notasInstance::decryption($_SESSION[GUID]["rol_id"]))->rowCount()>=1){
    
    $res=$notasInstance-> obtener_notas_controlador();
    echo json_encode($res);
  
}
