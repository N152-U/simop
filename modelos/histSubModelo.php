
<?php

require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';

    class histSubModelo extends mainModel{

        protected function obtener_datos_historico_subestacion_modelo($datos){

            $consulta = "SELECT 
                se.subestacion_id, 
                se.fecha_hora_programada,
                se.amperaje,
                se.transmite,
                se.sub_novedades,
                sub.subestacion
            FROM subs_electricas AS se INNER JOIN subestaciones AS sub ON sub.id = se.subestacion_id
            WHERE se.subestacion_id = " . $datos["subestacion_id"] ." AND se.fecha_hora_programada BETWEEN '".trim($datos['fecha_hora_inicial'])."' AND '".trim($datos['fecha_hora_final'])."' ";
            //print_r($consulta);
            $sql = self::ejecutar_consulta_simple($consulta);
            return $sql;

        }
        
    }