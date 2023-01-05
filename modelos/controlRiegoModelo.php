<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';

class controlRiegoModelo extends mainModel
{

    /* protected function obtener_anios_riego_modelo()
    {
        $consulta = "SELECT id, anio from programa_riego ORDER BY anio DESC";
        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    } */

    protected function obtener_detalle_riego_modelo()
    {


        $consulta = "SELECT 
          id ,
            programa_riego_id ,
            gasto_otras_fuentes_real ,
            gasto_otras_fuentes_programado ,
            gasto_acueducto_real ,
            gasto_acueducto_programado ,
            fecha,
            estatus ,
            created_at ,
            modified_at ,
            created_by ,
            modified_by ,
            transmitio 
        
        
         from programa_riego 
         where 
         ORDER BY anio DESC";
        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }
   
}
