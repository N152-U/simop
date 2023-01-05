<?php
session_start();
$peticionAjax = TRUE;

require_once "../controladores/usuarioControlador.php";
$usuarioInstancia = new usuarioControlador();
if(isset($_POST["accion"]) && $_POST["accion"] == "RESTABLECER" && $usuarioInstancia::consulta_permisos_rol("('RESTABLECERUSUARIO')",$usuarioInstancia::decryption($_SESSION[GUID]["rol_id"]))->rowCount()>=1)
{
    $res = $usuarioInstancia->actualiza_estatus_usuario_usuario_controlador(true,$_POST["usuario_id"]);
    echo $res;
}else
if(isset($_POST["accion"]) && $_POST["accion"] == "ELIMINAR" && $usuarioInstancia::consulta_permisos_rol("('ELIMINARROL')",$usuarioInstancia::decryption($_SESSION[GUID]["rol_id"]))->rowCount()>=1)
{
    $res = $usuarioInstancia->actualiza_estatus_usuario_usuario_controlador(false,$_POST["usuario_id"]);
    echo $res;
}else
if (isset($_POST["accion"]) && $_POST["accion"] == "EDITAR" && $usuarioInstancia::consulta_permisos_rol("('EDITARUSUARIO')",$usuarioInstancia::decryption($_SESSION[GUID]["rol_id"]))->rowCount()>=1) {
    $res = $usuarioInstancia->editar_usuario_usuario_controlador($_POST);
    echo $res;
} elseif (isset($_POST["accion"]) && $_POST["accion"] == "CREAR" && $usuarioInstancia::consulta_permisos_rol("('CREARUSUARIO')",$usuarioInstancia::decryption($_SESSION[GUID]["rol_id"]))->rowCount()>=1) {
    $res = $usuarioInstancia->crear_usuario_usuario_controlador($_POST);
    echo $res;
}