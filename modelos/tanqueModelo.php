<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';

    class tanqueModelo extends mainModel{

        protected function obtener_tanques_modelo(){

            $consulta= "SELECT id, tanque FROM tanques
                        ORDER BY FIELD( id, 1, 4, 33, 34, 28, 27, 5, 6, 7, 25, 26, 29, 8, 9, 10, 11, 12, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 39, 38, 37, 13, 31, 32, 30 )";
            
            $sql = mainModel::ejecutar_consulta_simple($consulta);

            return $sql;

        }

        protected function obtener_fechas_tanque_modelo( $tanque_id, $fecha_inicial, $fecha_final ) {

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
                        WHERE tp.tanque_id = " . $tanque_id . " AND tp.fecha_hora_programada BETWEEN '".trim($fecha_inicial)."' AND '".trim($fecha_final)."'";

// WHERE r.punto_id=" . $tanque_id. " AND r.hora_programada BETWEEN '".trim($fecha_inicial)."' AND '".trim($fecha_final)."'
            // print_r($consulta);
            $sql = mainModel::ejecutar_consulta_simple($consulta);

            return $sql;
            
        }

        protected function crear_registro_tanque_modelo($datos) {

            $res = 0;
            $consulta = "INSERT INTO tanques_poniente (                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
                usuario_id,
                tanque_id,
                fecha_hora_programada,

                tirante_uno,
                tirante_dos,
                tirante_tres,
                tirante_cuatro,

                vertedor,

                descarga_uno,
                descarga_dos,
                descarga_tres,

                local,
                presion,
                gasto,

                eq1,
                eq2,
                eq3,
                eq4,
                eq5,

                bypass,
                equipos,

                transmite,
                novedad,
                created_at
                )
                VALUES (
                :usuario_id,
                :tanque_id,
                :fecha_hora_programada,

                :tirante_uno,
                :tirante_dos,
                :tirante_tres,
                :tirante_cuatro,

                :vertedor,

                :descarga_uno,
                :descarga_dos,
                :descarga_tres,

                :local,
                :presion,
                :gasto,
                
                :eq1,
                :eq2,
                :eq3,
                :eq4,
                :eq5,

                :bypass,
                :equipos,

                :transmite,
                :novedad,
                NOW()
                )";

            $pdo = mainModel::conectar();
            try {

                $pdo->beginTransaction();
                $stmt = $pdo->prepare($consulta);
                $stmt->execute(array(
                    ":usuario_id" => $datos["usuario_id"],
                    ":tanque_id" => $datos["tanque_id"],
                    ":fecha_hora_programada" => $datos["fecha_hora_programada"],

                    ":tirante_uno" => $datos["tirante_uno"],
                    ":tirante_dos" => $datos["tirante_dos"],
                    ":tirante_tres" => $datos["tirante_tres"],
                    ":tirante_cuatro" => $datos["tirante_cuatro"],

                    ":vertedor" => $datos["vertedor"],

                    ":descarga_uno" => $datos["descarga_uno"],
                    ":descarga_dos" => $datos["descarga_dos"],
                    ":descarga_tres" => $datos["descarga_tres"],

                    ":local" => $datos["local"],
                    ":presion" => $datos["presion"],
                    ":gasto" => $datos["gasto"],

                    ":eq1" => $datos["eq1"],
                    ":eq2" => $datos["eq2"],
                    ":eq3" => $datos["eq3"],
                    ":eq4" => $datos["eq4"],
                    ":eq5" => $datos["eq5"],

                    ":bypass" => $datos["bypass"],
                    ":equipos" => $datos["equipos"],

                    ":transmite" => $datos["transmite"],
                    ":novedad" => $datos["novedad"]

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
