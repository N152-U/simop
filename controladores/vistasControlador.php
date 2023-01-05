<?php
require_once './modelos/vistasModelos.php';
class vistasControlador extends vistasModelo
{
    public function obtener_plantilla_controlador()
    {
        return require_once './vistas/plantilla.php';
    }
    public function obtener_vistas_controlador()
    {
        if (isset($_GET['vistas']) && (isset($_SESSION[GUID]['pwd']) || isset($_SESSION[GUID]['usuario']))) {
            $ruta = explode("/", $_GET['vistas']);
            $respuesta = vistasModelo::obtener_vistas_modelo($ruta[0]); //self, referencia a clases heredadas, con los :: le decimos que queremos acceder a la funcion
            if (sizeof($ruta) >= 1 && ($respuesta["vista_regreso_params"] > 0)) {
                $ruta = array_slice($ruta, 1, ($respuesta["vista_regreso_params"]), true);
                $output = implode("/", $ruta);
                $respuesta["ruta_regreso"] = $respuesta["vista_regreso"] . "/" . $output;
            } else {
                $respuesta["ruta_regreso"] = $respuesta["vista_regreso"];
            }
        } else {

            $respuesta = array("vista" => "login", "titulo" => "", "vista_regreso" => "", "vista_regreso_params" => 0);
        }





        return $respuesta;
    }
}
