<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';

class historicoSistemasModelo extends mainModel
{

    protected function obtener_historico_historico_sistemas_modelo($historicoDatos)
    {
        $sistema = "";
        $consulta= "";
        switch ($historicoDatos['sistema_id']) {
            case 1:
                $sistema = "cutzamala";
                break;
            case 2:
                $sistema = "atarasquillo";
                break;
            case 3:
                $sistema = "lerma";
                break;

            default:
                # code...
                break;
        }

        switch ($historicoDatos['periodo_id']) {
            case 1:
                $rango_fechas="'".str_replace(" / ", "' AND '",$historicoDatos['datetimes'] )."'";
     
                $consulta = "SELECT fecha AS fecha_sis, ".$sistema." AS sistema FROM historico WHERE fecha BETWEEN " .$rango_fechas;
                break;
            case 2:
                $rango_fechas="'".str_replace(" / ", "' AND '",$historicoDatos['datetimes'] )."'";
             
                $consulta = "SELECT DATE_FORMAT(fecha,'%Y-%m') AS fecha_sis, SUM(".$sistema.") AS sistema  FROM historico WHERE fecha BETWEEN " .$rango_fechas." GROUP BY fecha_sis";
                break;
            case 3:
                $rango_fechas="'".str_replace(" / ", "' AND '",$historicoDatos['datetimes'] )."'";
                $consulta = "SELECT DATE_FORMAT(fecha,'%Y') AS fecha_sis, SUM(".$sistema.") AS sistema  FROM historico WHERE fecha BETWEEN ".$rango_fechas." GROUP BY fecha_sis;";
                break;
            default:
                # code...
                break;
        }
        //echo $consulta;
        $sql = mainModel::ejecutar_consulta_simple($consulta);
        return $sql;
    }
}
