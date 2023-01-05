<?php
require_once dirname(__FILE__) . '/' . '../modelos/histTanqueModelo.php';
class histTanqueControlador extends histTanqueModelo
{

  public function obtener_datos_historico_tanques_controlador($datos)
  {
    $consulta = histTanqueModelo::obtener_datos_historico_tanques_modelo($datos);
    $datos_consulta = array();
    while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($datos_consulta, $row);
    }
    return $datos_consulta;
  }

}
