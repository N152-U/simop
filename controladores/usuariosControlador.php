<?php
require_once dirname(__FILE__) . '/' . '../modelos/usuariosModelo.php';
class usuariosControlador extends usuariosModelo
{
    public function obtener_usuarios_usuarios_controlador($estatus)
    {
        $consulta_usuarios = usuariosModelo::obtener_usuarios_usuarios_modelo($estatus);

        $usuarios = array();
        while ($row = $consulta_usuarios->fetch(PDO::FETCH_ASSOC)) {
           array_push($usuarios,$row);
        }
        return $usuarios;
    }
}


if (isset($_GET["vistas"])) {
    $data_url = explode("/", $_GET["vistas"]);
    $usuariosInstancia = new usuariosControlador();
    $usuariosActivosContenedor = $usuariosInstancia->obtener_usuarios_usuarios_controlador(1);
    $usuariosInactivosContenedor = $usuariosInstancia->obtener_usuarios_usuarios_controlador(0);
}