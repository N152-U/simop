
<?php

require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';

    class histTanqueModelo extends mainModel{

        protected function obtener_datos_historico_tanques_modelo($datos){
            $consulta = "SELECT 
                            tp.fecha_hora_programada, 

                            tp.tirante_uno, 
                            tp.tirante_dos, 
                            tp.tirante_tres, 
                            tp.tirante_cuatro, 

                            tp.vertedor, 

                            tp.descarga_uno, 
                            tp.descarga_dos, 
                            tp.descarga_tres, 

                            tp.local, 
                            tp.presion, 
                            tp.gasto, 

                            tp.eq1, 
                            tp.eq2, 
                            tp.eq3,
                            tp.eq4, 
                            tp.eq5, 

                            tp.bypass, 
                            tp.equipos, 

                            tp.novedad, 
                            tp.transmite, 
                            
                            t.tanque
                        FROM tanques_poniente AS tp
                        INNER JOIN tanques AS t ON t.id = tp.tanque_id
                        WHERE tp.tanque_id = " . $datos["tanque_id"] ." AND tp.fecha_hora_programada BETWEEN '".trim($datos['fecha_hora_inicial'])."' AND '".trim($datos['fecha_hora_final'])."' 
                        ORDER BY tp.fecha_hora_programada";
            //print_r($consulta);
            $sql = self::ejecutar_consulta_simple($consulta);
            return $sql;

        }
        
    }