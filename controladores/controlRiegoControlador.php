<?php
require_once dirname(__FILE__) . '/' . '../modelos/controlRiegoModelo.php';
class controlRiegoControlador extends controlRiegoModelo
{


  public function obtener_anios_riego_controlador()
  {
    $anios_consulta = mainModel::obtener_anios_riego_modelo();
    $anios_riego = array();
    while ($row = $anios_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($anios_riego, $row);
    }
   
    return $anios_riego;
  }

  public function obtener_anio_controlador()
  {
    $anios_consulta = controlRiegoModelo::obtener_anios_riego_modelo();
    $anios_riego = array();
    while ($row = $anios_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($anios_riego, $row);
    }
    return $anios_riego;
  }

}


$data_url = explode("/", $_GET["vistas"]);

if (sizeof($data_url) == 1) {

  $instancia = new controlRiegoControlador();
  $rolCuentaUsuario = $_SESSION[GUID]["rol_id"];

  $data_url = explode("/", $_GET["vistas"]);
 /*  if(sizeof($data_url) == 4)
  {
    $anio=$data_url[4];
    $data=$instancia->obtener_anio_controlador($anio);

  } */

}
