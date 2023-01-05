<?php
require_once dirname(__FILE__) . '/' . '../modelos/reporteSistemasModelo.php';
class reporteSistemasControlador extends reporteSistemasModelo
{

  public function obtener_fechas_puntos_reporte_sistemas_controlador($fecha_inical,$fecha_final,$puntos)
  {
    $fechas_puntos_consulta = mainModel::obtener_fechas_puntos($fecha_inical,$fecha_final,$puntos);
    $fechas_puntos = array();
    while ($row = $fechas_puntos_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($fechas_puntos, $row);
    }
    return $fechas_puntos;
  }


  public function obtener_ultima_fecha_reporte_sistemas_controlador()
  {
    $ultima_fecha_consulta = reporteSistemasModelo::obtener_ultima_fecha_reporte_sistemas_modelo();
  
    return $ultima_fecha_consulta->fetch(PDO::FETCH_ASSOC)["ultima_hora"];
  }
}