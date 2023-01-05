<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';

class reporteModelo extends mainModel
{
    protected function crear_registros_reporte_modelo($datos)
    {
        // print_r($datos);
        $res = 0;
        $reporte_berros = "EQUIPOS TRABAJANDO: ";
        $ultimo_equipo = sizeof($datos['check_equipo']);
        foreach ($datos['check_equipo'] as $key => $equipo) {
            if($ultimo_equipo == ($key+1)){
                $reporte_berros .= ' Y '.$equipo;
            }else if($key==0){
                $reporte_berros .=  $equipo;
            }else{
                $reporte_berros .= ', '.$equipo;
            }
        }
        $consulta0 = "SELECT COUNT(*) FROM reportes WHERE YEAR(fecha) = :anio";
        $consulta1 = "INSERT INTO reportes(
                    usuario_id,   
                    folio,
                    fecha,
                    reporte_berros,
                    lluvia_almoloya,
                    lluvia_villa_carmela,
                    lluvia_alzate,
                    lluvia_ixtlahuaca,
                    hora_recibio,
                    recibio,
                    transmitio,
                    gasto_venado,
                    operador_uno,
                    operador_dos,
                    jefe_reponsable_turno,
                    created_at,
                    modified_at
                    )
                    VALUES (
                    :usuario_id,
                    :folio,
                    :fecha,
                    :reporte_berros,
                    :lluvia_almoloya,
                    :lluvia_villa_carmela,
                    :lluvia_alzate,
                    :lluvia_ixtlahuaca,
                    :hora_recibio,
                    :recibio,
                    :transmitio,
                    :gasto_venado,
                    :operador_uno,
                    :operador_dos,
                    :jefe_reponsable_turno,
                    NOW(),
                    NOW()
                    )";
        $consulta2 = "SELECT id FROM notas WHERE created_at LIKE :fecha";
        $consulta3 = "SELECT id FROM novedades WHERE created_at LIKE :fecha";
        $consulta4 = "INSERT INTO reporte_notas (
                    reporte_id,
                    nota_id)
                    VALUES (
                    :reporte_id,
                    :nota_id
                    )";
        $consulta5 = "INSERT INTO reporte_novedades (
                    reporte_id,
                    novedad_id)
                    VALUES (
                    :reporte_id,
                    :novedad_id
                    )";

        $pdo = mainModel::conectar();

        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare($consulta0);
            $anio = date("Y");
            $stmt->execute(array(
                ":anio" => $anio
            ));
            $numero_folio = $stmt->fetchColumn();
            $numero_folio++;
            $folio = str_pad($numero_folio, 3, "0", STR_PAD_LEFT) . '/' . $anio;
            $stmt->closeCursor();
            $stmt = $pdo->prepare($consulta1);
            $stmt->execute(array(
                ":folio" => $folio,
                ":fecha" => $datos['fecha'],
                ":reporte_berros" => $reporte_berros,
                ":lluvia_almoloya" => $datos['lluvia_almoloya'],
                ":lluvia_villa_carmela" => $datos['lluvia_villa_carmela'],
                ":lluvia_alzate" => $datos['lluvia_alzate'],
                ":lluvia_ixtlahuaca" => $datos['lluvia_ixtlahuaca'],
                ":hora_recibio" => $datos['hora_recibio'],
                ":recibio" => $datos['recibio'],
                ":transmitio" => $datos['transmitio'],
                ":gasto_venado" => $datos['gasto_venado'],
                ":operador_uno" => $datos['operador_uno'],
                ":operador_dos" => $datos['operador_dos'],
                ":jefe_reponsable_turno" => $datos['jefe_reponsable_turno'],
                ":usuario_id" => mainModel::decryption($_SESSION[GUID]["id"])


            ));

            $stmt->closeCursor();
            $codigos = $stmt->errorInfo();
            //print_r($codigos);
            if ($codigos[1] == 0) {
                $reporte_id = $pdo->lastInsertId();
                $fecha = $datos['fecha'] . '%';
                //print_r($fecha);
                $stmt = $pdo->prepare($consulta2);
                $stmt->execute(array(
                    ":fecha" => $fecha
                ));
                $notas_ids = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
                $stmt->closeCursor();
                $stmt = $pdo->prepare($consulta3);
                $stmt->execute(array(
                    ":fecha" => $fecha
                ));
                $novedades_ids = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
                $stmt->closeCursor();
                //print_r($notas_ids);
                foreach ($notas_ids as $key => $nota_id) {
                    $stmt = $pdo->prepare($consulta4);
                    $stmt->execute(array(
                        ":reporte_id" => $reporte_id,
                        ":nota_id" => $nota_id
                    ));
                    $stmt->closeCursor();
                    if ($codigos[1] != 0) {
                        // Error al unir el reporte con las notas
                        $res = 2;
                    }
                }
                foreach ($novedades_ids as $key => $novedad_id) {
                    $stmt = $pdo->prepare($consulta5);
                    $stmt->execute(array(
                        ":reporte_id" => $reporte_id,
                        ":novedad_id" => $novedad_id
                    ));
                    $stmt->closeCursor();
                    if ($codigos[1] != 0) {
                        // Error al unir el reporte con las novedades
                        $res = 3;
                    }
                }
            } else if($codigos[1] == 1062){
                // El reporte se encuentra generado
                $res = 4;
            } else {
                // Error a la hora de crear el reporte
                $res = 1;
            }
            //print_r($codigos);
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
        //  print_r($consulta1);
        return $res;
    }
}
