<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';

class reportesModelo extends mainModel
{
    protected function obtener_reportes_modelo()
    {
        $consulta = "SELECT id, folio, fecha from reportes ORDER BY fecha DESC";

        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }
    


    
  
    protected function obtener_detalle_reportes_modelo($reporte_id)
    {
        $consulta = "SELECT *  FROM reportes WHERE id='$reporte_id'";
        $sql = mainModel::ejecutar_consulta_simple($consulta);
        return $sql;
    }

    protected function obtener_novedades_reportes_modelo($reporte_id)
    {
        $consulta = "SELECT rn.reporte_id,rn.novedad_id,n.* FROM reporte_novedades rn
        INNER JOIN novedades AS n ON n.id = rn.novedad_id WHERE rn.reporte_id='$reporte_id' 
        ORDER BY n.created_at ASC";
        $sql = mainModel::ejecutar_consulta_simple($consulta);
        return $sql;
    }
    protected function obtener_notas_reportes_modelo($reporte_id)
    {
        $consulta = "SELECT rn.reporte_id,rn.nota_id,n.descripcion FROM reporte_notas rn
        INNER JOIN notas AS n ON n.id = rn.nota_id WHERE rn.reporte_id='$reporte_id' 
        ORDER BY n.created_at ASC";
        $sql = mainModel::ejecutar_consulta_simple($consulta);
        return $sql;
    }

    protected function obtener_datos_personal_pdf_reporte_modelo($reporte_id)
    {
        $consulta = "SELECT *  FROM reportes WHERE id='$reporte_id'";
        $sql = mainModel::ejecutar_consulta_simple($consulta);
        return $sql;
    }
    protected function obtener_datos_personal_pdf_notas_modelo($reporte_id)
    {
        $consulta = "SELECT rn.reporte_id,rn.nota_id,n.descripcion FROM reporte_notas rn
        INNER JOIN notas AS n ON n.id = rn.nota_id WHERE rn.reporte_id='$reporte_id' 
        ORDER BY n.created_at ASC";
        $sql = mainModel::ejecutar_consulta_simple($consulta);
        return $sql;
    }
    protected function obtener_datos_personal_pdf_novedades_modelo($reporte_id)
    {        $consulta = "SELECT rn.reporte_id,rn.novedad_id,n.* FROM reporte_novedades rn
        INNER JOIN novedades AS n ON n.id = rn.novedad_id WHERE rn.reporte_id='$reporte_id' 
        ORDER BY n.created_at ASC";
        $sql = mainModel::ejecutar_consulta_simple($consulta);
        return $sql;

    }
   

}
