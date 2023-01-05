<?php
require_once dirname(__FILE__) . '/' . '../modelos/histSubModelo.php';
class histSubControlador extends histSubModelo
{

  public function obtener_datos_historico_subestaciones_controlador($datos)
  {
    $consulta = histSubModelo::obtener_datos_historico_subestacion_modelo($datos);
    $datos_consulta = array();
    while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($datos_consulta, $row);
    }
    return $datos_consulta;
  }

}
