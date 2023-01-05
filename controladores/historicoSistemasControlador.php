<?php
require_once dirname(__FILE__) . '/' . '../modelos/historicoSistemasModelo.php';
class historicoSistemasControlador extends historicoSistemasModelo
{


  public function obtener_historico_historico_sistemas_controlador($historicoDatos)
  {
    $historicoDias = historicoSistemasModelo::obtener_historico_historico_sistemas_modelo($historicoDatos);
    $dias = array();
      while ($row = $historicoDias->fetch(PDO::FETCH_ASSOC)) {
        array_push($dias, $row);
      }
    return $dias;
  }
  public function obtener_sistemas_controlador()
  {
    $puntos_consulta = mainModel::obtener_sistemas();
    $puntos = array();
    while ($row = $puntos_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($puntos, $row);
    }
    return $puntos;
  }

}
