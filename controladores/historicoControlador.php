<?php
require_once dirname(__FILE__) . '/' . '../modelos/historicoModelo.php';
class historicoControlador extends historicoModelo
{

  public function obtener_puntos_historico_controlador()
  {
    $nombres_puntos_consulta = mainModel::obtener_puntos();
    $nombres = array();
    while ($row = $nombres_puntos_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($nombres, $row);
    }
    return $nombres;
  }



  public function obtener_fechas_punto_historico_controlador($fecha_hora_inicial, $fecha_hora_final, $punto_id)
  {

    $fechas_puntos_consulta = mainModel::obtener_fechas_punto($fecha_hora_inicial, $fecha_hora_final, $punto_id);
    $fechas_puntos = array();


    while ($row = $fechas_puntos_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($fechas_puntos, $row);
    }
    
    $fechas_registradas = $fechas_puntos;
    //print_r($fechas_registradas);
    
    return $fechas_registradas;
  }
}
