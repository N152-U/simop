<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';

class capturaModelo extends mainModel
{
    protected function crear_registros_captura_modelo($datos)
    {

        $res = 0;
       
        $consulta1 = "INSERT INTO registros (                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
            usuario_id, 
            punto_id,  
            hora_programada,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
            transmitio,
            novedades,
            created_at,
            modified_at)
            VALUES (  
            :usuario_id,
            :punto_id,                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
            :hora_programada,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
            :transmitio,
            :novedades,
            now(),
            now())";

        $consulta2 = "INSERT INTO atributos_punto_registros (                                                                                                                                                                                                                                                                                                                                                                                                                                
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

            $pdo->beginTransaction();
            $stmt = $pdo->prepare($consulta1);
            $date = new DateTime($datos["hora_programada"]);
            $hora_programada = date_format($date, 'Y-m-d H:i:00');
            $stmt->execute(array(
                ":usuario_id" => $datos["usuario_id"],
                ":punto_id" => $datos["punto_id"],
                ":hora_programada" => $hora_programada,
                ":transmitio" => $datos["transmitio"],
                ":novedades" => $datos["novedades"]
            ));
            $stmt->closeCursor();
            $codigos = $stmt->errorInfo();

            if ($codigos[1] != null) {
                print_r($codigos);
                $res = -1;
            } else {

                $registro_id = $pdo->lastInsertId();
                foreach ($datos["bomba_id"] as $index => $value) {

                    $stmt = $pdo->prepare($consulta2);

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


    public function editar_registros_captura_modelo($datos)
    {
        $res = 0;

        $consulta1 = "DELETE FROM atributos_punto_registros WHERE registro_id = :registro_id";

        $consulta2 = "UPDATE registros SET 
                    usuario_id = :usuario_id, 
                    transmitio = :transmitio,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                    novedades = :novedades,
                    modified_at = NOW(), 
                    modified_by = :modified_by WHERE id = :registro_id";

        $consulta3 = "INSERT INTO atributos_punto_registros (                                                                                                                                                                                                                                                                                                                                                                                                                                
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



    protected function obtener_bombas_captura_modelo()
    {

        $consulta = "SELECT * FROM bombas";

        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }


    protected function obtener_fechas_punto_captura_modelo($punto_id, $fecha_inicial, $fecha_final)
    {


        // $consulta = "SELECT * FROM puntos p INNER JOIN registros r ON p.id=r.pozo WHERE DATE(r.hora_programada) = DATE(NOW()) and p.id=" . $punto_id;
        $consulta = "SELECT p.punto, r.punto_id, DATE_FORMAT(r.hora_programada,'%Y-%m-%d %H:%i') AS hora_programada, r.usuario_id, r.transmitio, r.novedades, b.bomba 
        AS bomba_id, b.id AS bomba_usada_id, apr.presion, apr.tirante, apr.gasto, apr.registro_id   
        FROM atributos_punto_registros apr INNER JOIN registros r
        ON r.id = apr.registro_id
        INNER JOIN puntos p
        ON p.id=r.punto_id
        INNER JOIN bombas b
        ON apr.bomba_id=b.id
        WHERE r.punto_id=" . $punto_id . " AND r.hora_programada BETWEEN '" . trim($fecha_inicial) . "' AND '" . trim($fecha_final) . "'
        ORDER BY r.hora_programada";

        $sql = mainModel::ejecutar_consulta_simple($consulta);


        return $sql;
    }

    protected function obtener_validacion_rango_tirante_captura_modelo($punto_id)
    {
        $consulta=" SELECT r.punto_id, p.punto, MAX(apr.tirante) AS maximo, MIN(apr.tirante) AS minimo
        FROM atributos_punto_registros apr INNER JOIN registros r  ON r.id=apr.registro_id INNER JOIN puntos p ON p.id=r.punto_id 
        WHERE r.punto_id=" . $punto_id;
        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
       
    }


   
}