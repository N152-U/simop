<?php
require_once dirname(__FILE__) . '/' . '../modelos/reportesModelo.php';
class reportesControlador extends reportesModelo
{

  public function obtener_reportes_controlador()
  {
    $reportes_consulta = reportesModelo::obtener_reportes_modelo();
    $reportes = array();
    while ($row = $reportes_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($reportes, $row);
    }
    return $reportes;
  }


  
  public function obtener_detalle_reportes_controlador($reporte_id)
  {
      $reportes_consulta = reportesModelo::obtener_detalle_reportes_modelo($reporte_id);
      $reportes = $reportes_consulta->fetch(PDO::FETCH_ASSOC);
     
      return $reportes;
  }
       
  public function obtener_novedades_reportes_controlador($reporte_id)
  {
    $reportes_consulta = reportesModelo::obtener_novedades_reportes_modelo($reporte_id);
    $reportes = array();
    while ($row = $reportes_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($reportes, $row);
    }
    return $reportes;
  }
      
  public function obtener_notas_reportes_controlador($reporte_id)
  {
    $reportes_consulta = reportesModelo::obtener_notas_reportes_modelo($reporte_id);
    $reportes = array();
    while ($row = $reportes_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($reportes, $row);
    }
    return $reportes;
  }
  public function obtener_datos_personal_pdf_reporte_controlador($reporte_id)
  {
      $reportes_consulta = reportesModelo::obtener_datos_personal_pdf_reporte_modelo($reporte_id);
      $reportes = $reportes_consulta->fetch(PDO::FETCH_ASSOC);
     
      return $reportes;
  }
  
  public function obtener_datos_personal_pdf_notas_controlador($reporte_id)
  {
      $reportes_consulta = reportesModelo::obtener_datos_personal_pdf_notas_modelo($reporte_id);
      $reportes = array();
      while ($row = $reportes_consulta->fetch(PDO::FETCH_ASSOC)) {
        array_push($reportes, $row);
      }
      return $reportes; 

  }
  
  public function obtener_datos_personal_pdf_novedades_controlador($reporte_id)
  {
      $reportes_consulta = reportesModelo::obtener_datos_personal_pdf_novedades_modelo($reporte_id);
      $reportes = array();
      while ($row = $reportes_consulta->fetch(PDO::FETCH_ASSOC)) {
        array_push($reportes, $row);
      }
      return $reportes; 

      
  }

  
}


