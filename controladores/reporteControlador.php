<?php
require_once dirname(__FILE__) . '/' . '../modelos/reporteModelo.php';
class reporteControlador extends reporteModelo
{

  public function crear_registros_reporte_controlador($reportedatos)
  {
    $inserta_registros = reporteModelo::crear_registros_reporte_modelo($reportedatos);
    return $inserta_registros;
  }
}
