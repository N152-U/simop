<?php
require_once dirname(__FILE__) . '/' . '../modelos/registroAnioRiegoModelo.php';
class registroAnioRiegoControlador extends registroAnioRiegoModelo
{
  public function crear_registros_riego_anio_captura_controlador($capturadatos,$usuario_id)
  {
    $res = -1;
    
    $inserta_registros = registroAnioRiegoModelo::crear_registros_riego_anio_captura_modelo($capturadatos,$usuario_id);
    if ($inserta_registros == 0) {
      $res = 0;
    }

    return $res;
  }

  public function obtener_detalle_programa_riego_controlador($anio){

    $anio = mainModel::obtener_detalle_programa_riego_modelo($anio);
   
    return $anio;

  }

}


$data_url = explode("/", $_GET["vistas"]);

if (sizeof($data_url) == 1) {
$vista=true;
  $instancia = new registroAnioRiegoControlador();
  $rolCuentaUsuario = $_SESSION[GUID]["rol_id"];


  $anio = date("Y");
  /* print_r($instancia->obtener_detalle_programa_riego_controlador($anio)); */

  if($anio==$instancia->obtener_detalle_programa_riego_controlador($anio)["anio"])
  {
  $vista=false;
  }
}
