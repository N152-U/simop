<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';

class CapturaLumbreraModelo extends mainModel
{
    protected function crear_registros_captura_lumbrera_modelo($datos)
    {

        $res = 0;
       
        $consulta1 = "INSERT INTO lumbreras_mediciones (                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
            usuario_id, 
            lumbrera_id,  
            fecha_hora_programada,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
            transmitio,
            novedades,
            tirante,
            gasto,
            created_at,
            modified_at)
            VALUES (  
            :usuario_id,
            :lumbrera_id,                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
            :fecha_hora_programada,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
            :transmitio,
            :novedades,
            :tirante,
            :gasto,
            now(),
            now())";

        
        $pdo = mainModel::conectar();
        try {

            $pdo->beginTransaction();
            $stmt = $pdo->prepare($consulta1);
            $date = new DateTime($datos["fecha_hora_programada"]);
            $hora_programada = date_format($date, 'Y-m-d H:i:00');
            $stmt->execute(array(
                ":usuario_id" => $datos["usuario_id"],
                ":lumbrera_id" => $datos["lumbrera_id"],
                ":fecha_hora_programada" => $hora_programada,
                ":transmitio" => $datos["transmitio"],
                ":novedades" => $datos["novedades"],
                ":tirante" => $datos["tirante"],
                ":gasto" => $datos["gasto"]
            ));
            $stmt->closeCursor();
            $codigos = $stmt->errorInfo();



            switch ($codigos[1]) {
                case null:

                    $pdo->commit();
                    //Se ingresaron
                    $res = 0;
                    break;
                default:
                    print_r($codigos);
                    $pdo->rollBack();
                    //Error
                    $res = -1;
                    break;
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            die($e->getMessage());
            //Error
            $res = -1;
        }

        return $res;

        /*
        $res
        0 Se ingresaron los articulos
        -1 Ocurrio un Error 
        */
    }


    public function editar_registros_captura_lumbrera_modelo($datos)
    {
        $res = 0;

        $consulta1 = "DELETE FROM atributos_lumbrera_registros WHERE registro_id = :registro_id";

        $consulta2 = "UPDATE registros SET 
                    usuario_id = :usuario_id, 
                    transmitio = :transmitio,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                    novedades = :novedades,
                    modified_at = NOW(), 
                    modified_by = :modified_by WHERE id = :registro_id";

        $consulta3 = "INSERT INTO atributos_lumbrera_registros (                                                                                                                                                                                                                                                                                                                                                                                                                                
                    bomba_id,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
                    registro_id,                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
                    tirante,
                    presion,
                    gasto)
                    VALUES (                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
                    :bomba_id,                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
                    :registro_id,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                    :tirante,                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
                    :presion,
                    :gasto)";

        $pdo = mainModel::conectar();
        try {
            $registro_id =  $datos["registro_id"];
            $pdo->beginTransaction();
            //Borramos los registros previos asociados a bombas
            $stmt = $pdo->prepare($consulta1);
            $stmt->execute(array(
                ":registro_id" => $registro_id
            ));
            $stmt->closeCursor();
            $codigos = $stmt->errorInfo();
            if ($codigos[1] != null) {
                print_r($codigos);
                $res = -1;
            } else {
              
                $stmt = $pdo->prepare($consulta2);
                $stmt->execute(array(
                    ":usuario_id" => $datos["usuario_id"],
                    ":transmitio" => $datos["transmitio"],
                    ":novedades" => $datos["novedades"],
                    ":modified_by" => mainModel::decryption($_SESSION[GUID]["id"]),
                    ":registro_id" => $registro_id
                ));
                $stmt->closeCursor();
                $codigos = $stmt->errorInfo();

                if ($codigos[1] != null) {
                    print_r($codigos);
                    $res = -1;
                } else {
                    foreach ($datos["bomba_id"] as $index => $value) {

                        $stmt = $pdo->prepare($consulta3);

                        $stmt->execute(array(
                            ":bomba_id" => $value,
                            ":registro_id" => $registro_id,
                            ":tirante" => $datos["tirante"],
                            ":presion" => $datos["presion"],
                            ":gasto" => $datos["gasto"]
                        ));
                        $stmt->closeCursor();
                        $codigos = $stmt->errorInfo();

                        if ($codigos[1] != null) {
                            print_r($codigos);
                            $res = -1;
                            break;
                        }
                    }
                }

                switch ($codigos[1]) {
                    case null:

                        $pdo->commit();
                        //Se ingresaron
                        $res = 0;
                        break;
                    default:
                        print_r($codigos);
                        $pdo->rollBack();
                        //Error
                        $res = -1;
                        break;
                }
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            die($e->getMessage());
            //Error
            $res = -1;
        }

        return $res;

        /*
        $res
        0 Se ingresaron los registros
        -1 Ocurrio un Error 
        */




        return $res;
    }



    protected function obtener_fechas_lumbrera_captura_modelo($lumbrera_id, $fecha_inicial, $fecha_final)
    {


        // $consulta = "SELECT * FROM lumbreras p INNER JOIN registros r ON p.id=lm.pozo WHERE DATE(lm.hora_programada) = DATE(NOW()) and p.id=" . $lumbrera_id;
        $consulta = "SELECT p.lumbrera, lm.lumbrera_id, DATE_FORMAT(lm.hora_programada,'%Y-%m-%d %H:%i') AS hora_programada, lm.usuario_id, lm.transmitio, lm.novedades,
      lm.tirante, lm.gasto   
        FROM lumbreras_mediciones lm 
        INNER JOIN lumbreras l
        ON l.id=lm.lumbrera_id
        WHERE lm.lumbrera_id=" . $lumbrera_id . " AND lm.hora_programada BETWEEN '" . trim($fecha_inicial) . "' AND '" . trim($fecha_final) . "'
        ORDER BY lm.hora_programada";

        $sql = mainModel::ejecutar_consulta_simple($consulta);


        return $sql;
    }

    protected function obtener_validacion_rango_tirante_captura_modelo($lumbrera_id)
    {
        $consulta=" SELECT lm.lumbrera_id, p.lumbrera, MAX(aplm.tirante) AS maximo, MIN(aplm.tirante) AS minimo
        FROM atributos_lumbrera_registros apr INNER JOIN registros r  ON lm.id=aplm.registro_id INNER JOIN lumbreras p ON p.id=lm.lumbrera_id 
        WHERE lm.lumbrera_id=" . $lumbrera_id;
        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
       
    }


   
}
