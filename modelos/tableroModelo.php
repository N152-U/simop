<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';

class tableroModelo extends mainModel{
    protected function obtener_puntos_tablero_modelo($intervalo_id, $puntos, $fechaHoraInicial, $fechaHoraFinal)
    {

    $consulta="";
    switch($intervalo_id){
        case 1:
            $consulta="SELECT COUNT(*), UPPER(p.punto) AS punto, r.punto_id, r.hora_programada AS fecha, AVG(apr.gasto) AS promedio_gasto,  SUM(apr.gasto) AS suma_gasto
            FROM (SELECT DISTINCT registro_id, gasto FROM atributos_punto_registros) apr INNER JOIN registros r
            ON r.id = apr.registro_id
            INNER JOIN puntos p
            ON p.id=r.punto_id
            WHERE p.punto IN ".$puntos." AND r.hora_programada BETWEEN '".$fechaHoraInicial."' AND '".$fechaHoraFinal."'
            GROUP BY fecha, punto, r.punto_id
            ORDER BY r.punto_id, fecha;";
            break;
        case 2:
            $consulta="SELECT COUNT(*), UPPER(p.punto) AS punto, r.punto_id, DATE_FORMAT(r.hora_programada,'%Y-%m-%d') AS fecha,  AVG(apr.gasto) AS promedio_gasto,  SUM(apr.gasto) AS suma_gasto
            FROM (SELECT DISTINCT registro_id, gasto FROM atributos_punto_registros) apr INNER JOIN registros r
            ON r.id = apr.registro_id
            INNER JOIN puntos p
            ON p.id=r.punto_id
            WHERE p.punto IN ".$puntos." AND r.hora_programada BETWEEN '".$fechaHoraInicial."' AND '".$fechaHoraFinal."'
            GROUP BY fecha, punto, r.punto_id
            ORDER BY r.punto_id, fecha;";
            break;
        case 3:
            $consulta="SELECT COUNT(*), UPPER(p.punto) AS punto, r.punto_id, DATE_FORMAT(r.hora_programada,'%Y-%m') AS fecha,  AVG(apr.gasto) AS promedio_gasto,  SUM(apr.gasto) AS suma_gasto
            FROM (SELECT DISTINCT registro_id, gasto FROM atributos_punto_registros) apr INNER JOIN registros r
            ON r.id = apr.registro_id
            INNER JOIN puntos p
            ON p.id=r.punto_id
            WHERE p.punto IN ".$puntos." AND r.hora_programada BETWEEN '".$fechaHoraInicial."' AND '".$fechaHoraFinal."'
            GROUP BY fecha, punto, r.punto_id
            ORDER BY r.punto_id, fecha;";
            break;
        case 4:
            $consulta="SELECT COUNT(*), UPPER(p.punto) AS punto, r.punto_id, DATE_FORMAT(r.hora_programada,'%Y') AS fecha,  AVG(apr.gasto) AS promedio_gasto,  SUM(apr.gasto) AS suma_gasto
            FROM (SELECT DISTINCT registro_id, gasto FROM atributos_punto_registros) apr INNER JOIN registros r
            ON r.id = apr.registro_id
            INNER JOIN puntos p
            ON p.id=r.punto_id
            WHERE p.punto IN ".$puntos." AND r.hora_programada BETWEEN '".$fechaHoraInicial."' AND '".$fechaHoraFinal."'
            GROUP BY fecha, punto, r.punto_id
            ORDER BY r.punto_id, fecha;";
            break;
        default:
            break;

        }

    $sql = self::ejecutar_consulta_simple($consulta);
    /* var_dump($sql );  */
    return $sql;
       

    }


}