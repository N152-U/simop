<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';

class subestacionesModelo extends mainModel
{

    protected function obtener_subestaciones_modelo(){

        $consulta= "SELECT id, subestacion FROM subestaciones";
        
        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;

    }

    protected function obtener_fechas_subestacion_modelo($subestacion_id,$fecha_inicial, $fecha_final){
        $consulta = "SELECT 
                        
                        se.fecha_hora_programada, 
                        se.amperaje, 
                        se.transmite, 
                        se.sub_novedades, 
                        
                        sub.subestacion

                    FROM subs_electricas AS se
                    INNER JOIN subestaciones AS sub ON sub.id = se.subestacion_id
                    WHERE subestacion_id = " . $subestacion_id ." AND se.fecha_hora_programada BETWEEN '".trim($fecha_inicial)."' AND '".trim($fecha_final)."'";
                    
        //print_r($consulta);
        $sql = self::ejecutar_consulta_simple($consulta);
        return $sql;

    }

    protected function crear_sub_electrica_modelo($datos)
    {

        $res = 0;
        $consulta = "INSERT INTO subs_electricas (                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
            usuario_id, 
            subestacion_id,
            fecha_hora_programada,                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
            amperaje,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
            transmite,
            sub_novedades,
            created_at
            )
            VALUES (
            :usuario_id,
            :subestacion_id,                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
            :fecha_hora_programada,
            :amperaje,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
            :transmite,
            :sub_novedades,
            NOW()
            )";

        $pdo = mainModel::conectar();
        try {

            $pdo->beginTransaction();
            $stmt = $pdo->prepare($consulta);
            $stmt->execute(array(
                ":usuario_id" =>$datos["usuario_id"],
                ":subestacion_id" => $datos["subestacion_id"],
                ":fecha_hora_programada" => $datos["fecha_hora_programada"],
                ":amperaje" => $datos["amperaje"],
                ":transmite" => $datos["transmite"],
                ":sub_novedades" => $datos["sub_novedades"]
            ));
            $stmt->closeCursor();
            $codigos = $stmt->errorInfo();
            //echo $codigos;
            //print_r($codigos);
            if ($codigos[1] != null) {
                $res = -1;
            }
            switch ($res) {
                case 0:
                    $pdo->commit();
                    break;
                default:
                    $pdo->rollBack();
                    break;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            die($e->getMessage());
            $res = -1;
        }
        return $res;
    }


}
