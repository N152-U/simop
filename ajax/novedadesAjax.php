<?php
$peticionAjax = TRUE;
session_start();
require_once "../controladores/novedadesControlador.php";

$novedadesInstance = new novedadesControlador();
if (isset($_POST['accion']) && ($_POST['accion'] == "GUARDAR")&&$novedadesInstance::consulta_permisos_rol("('LEERNOVEDAD','CREARNOVEDAD')",$novedadesInstance::decryption($_SESSION[GUID]["rol_id"]))->rowCount()>=1) {
    $res = $novedadesInstance->crear_registros_novedades_controlador($_POST);
    echo $res;
}
else if(isset($_POST['accion'])&&($_POST['accion'] == "CONSULTA")&&$novedadesInstance::consulta_permisos_rol("('LEERNOVEDAD')",$novedadesInstance::decryption($_SESSION[GUID]["rol_id"]))->rowCount()>=1){
    $res=$novedadesInstance-> obtener_novedades_controlador();
  
    echo json_encode($res);
  
}else if (isset($_POST['accion'])&&($_POST['accion'] == "CONSULTATOTALNOVEDADES")&&$novedadesInstance::consulta_permisos_rol("('LEERNOVEDAD')",$novedadesInstance::decryption($_SESSION[GUID]["rol_id"]))->rowCount()>=1){
    $res=$novedadesInstance-> getCount_NovedadesController();
  
    echo json_encode($res);
  
}