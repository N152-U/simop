<?php
session_start();
$peticionAjax = TRUE;

require_once "../controladores/rolControlador.php";

$rolInstancia = new rolControlador();

if(isset($_POST["accion"]) && $_POST["accion"] == "RESTABLECER" && $rolInstancia::consulta_permisos_rol("('RESTABLECERROL')",$rolInstancia::decryption($_SESSION[GUID]["rol_id"]))->rowCount()>=1)
{
    $res = $rolInstancia->actualiza_estatus_rol_rol_controlador(true,$_POST["rol_id"]);
    echo $res;
}else
if(isset($_POST["accion"]) && $_POST["accion"] == "ELIMINAR" && $rolInstancia::consulta_permisos_rol("('ELIMINARROL')",$rolInstancia::decryption($_SESSION[GUID]["rol_id"]))->rowCount()>=1)
{
    $res = $rolInstancia->actualiza_estatus_rol_rol_controlador(false,$_POST["rol_id"]);
    echo $res;
}else
if (isset($_POST["accion"]) && $_POST["accion"] == "EDITAR" && $rolInstancia::consulta_permisos_rol("('EDITARROL')",$rolInstancia::decryption($_SESSION[GUID]["rol_id"]))->rowCount()>=1) {
  
    $res = $rolInstancia->editar_rol_rol_controlador($_POST);
    echo $res;
} elseif (isset($_POST["accion"]) && $_POST["accion"] == "CREAR" && $rolInstancia::consulta_permisos_rol("('CREARROL')",$rolInstancia::decryption($_SESSION[GUID]["rol_id"]))->rowCount()>=1) {
    
    $res = $rolInstancia->crear_rol_rol_controlador($_POST);
    echo $res;
}