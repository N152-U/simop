<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';

class comparativoScadaModelo extends mainModel
{
    static protected function consultar_simop_comparativo_scada_modelo()
    {
        //Esta función solo esta preparada para el tirante de atarasquillo y el venado, hacer cambio al momento de hacer agregar
        //Por ahora se toma la nomenclatura del scada, corroborar despues su cambio al momento de agregar mas puntos o mas propiedades
        $consulta = "(SELECT DISTINCT s.nombre, s.gateId, us.nomenclatura AS unidades_bitacora, us.nomenclatura AS unidades_scada, s.fecha AS fecha_bitacora, s.propiedad, ( CASE s.propiedad WHEN 'tirante' THEN ROUND(apr.tirante/100,3 ) WHEN 'gasto' THEN apr.tirante END ) AS valor_bitacora FROM (SELECT re.*, reg.id FROM (SELECT sca.*, MAX(r.hora_programada) AS fecha, p.punto AS nombre FROM scada sca INNER JOIN registros r ON sca.registro_id = r.punto_id INNER JOIN puntos p ON sca.registro_id = p.id WHERE sca.tabla = 1 GROUP BY sca.gateId) re INNER JOIN registros reg ON ( re.registro_id = reg.punto_id AND re.fecha = reg.hora_programada )) s INNER JOIN atributos_punto_registros apr ON s.id = apr.registro_id INNER JOIN unidades ub ON s.unidades_bitacora_id = ub.id INNER JOIN unidades us ON s.unidades_scada_id = us.id) UNION (SELECT DISTINCT s.nombre, s.gateId, ub.nomenclatura AS unidades_bitacora, us.nomenclatura AS unidades_scada, s.fecha AS fecha_bitacora, s.propiedad, ( CASE s.propiedad WHEN 'tirante_uno' THEN tp.tirante_uno WHEN 'tirante_dos' THEN tp.tirante_dos WHEN 'tirante_tres' THEN tp.tirante_tres WHEN 'tirante_cuatro' THEN tp.tirante_cuatro WHEN 'vertedor' THEN tp.vertedor WHEN 'descarga_uno' THEN tp.descarga_uno WHEN 'descarga_dos' THEN tp.descarga_dos WHEN 'descarga_tres' THEN tp.descarga_tres WHEN 'local' THEN tp.local WHEN 'presion' THEN tp.presion WHEN 'gasto' THEN tp.gasto WHEN 'eq1' THEN tp.eq1 WHEN 'eq2' THEN tp.eq2 WHEN 'eq3' THEN tp.eq3 WHEN 'eq4' THEN tp.eq4 WHEN 'eq5' THEN tp.eq5 WHEN 'equipos' THEN tp.equipos WHEN 'bypass' THEN tp.bypass END ) AS valor_bitacora FROM (SELECT re.*, reg.id FROM (SELECT sca.*, MAX(tp.fecha_hora_programada) AS fecha, t.tanque AS nombre FROM scada sca INNER JOIN tanques_poniente tp ON sca.registro_id = tp.tanque_id INNER JOIN tanques t ON sca.registro_id = t.id WHERE sca.tabla = 2 GROUP BY sca.gateId) re INNER JOIN tanques_poniente reg ON ( re.registro_id = reg.tanque_id AND re.fecha = reg.fecha_hora_programada )) s INNER JOIN tanques_poniente tp ON s.id = tp.id INNER JOIN unidades ub ON s.unidades_bitacora_id = ub.id INNER JOIN unidades us ON s.unidades_scada_id = us.id) UNION (SELECT DISTINCT s.nombre, s.gateId, ub.nomenclatura AS unidades_bitacora, us.nomenclatura AS unidades_scada, s.fecha AS fecha_bitacora, s.propiedad, ( CASE s.propiedad WHEN 'amperaje' THEN se.amperaje END ) AS valor_bitacora FROM (SELECT re.*, reg.id FROM (SELECT sca.*, MAX(se.fecha_hora_programada) AS fecha, sub.subestacion AS nombre FROM scada sca INNER JOIN subs_electricas se ON sca.registro_id = se.subestacion_id INNER JOIN subestaciones sub ON sca.registro_id = sub.id WHERE sca.tabla = 3 GROUP BY sca.gateId) re INNER JOIN subs_electricas reg ON ( re.registro_id = reg.subestacion_id AND re.fecha = reg.fecha_hora_programada )) s INNER JOIN subs_electricas se ON s.id = se.id INNER JOIN unidades ub ON s.unidades_bitacora_id = ub.id INNER JOIN unidades us ON s.unidades_scada_id = us.id)";
        //print_r($consulta);
        $sql = mainModel::ejecutar_consulta_simple($consulta);
        return $sql;
    }

    static protected function consultar_scada_comparativo_scada_modelo($gateId)
    {
        $consulta = "SELECT TOP 1 ROUND(value, 3) AS valor_scada,FORMAT(DATEADD(HH, -5,DATEADD(SECOND, CAST(time/1000 AS int) ,'1970/1/1')), 'yyyy-MM-dd HH:mm:ss') AS fecha_scada FROM dbo.VfiTagNumHistory WHERE gateId = $gateId ORDER BY time DESC";
        //print_r($consulta);
        $sql = mainModel::ejecutar_consulta_simple_ms($consulta);
        return $sql;
    }

    static protected function obtener_registros_comparativo_scada_modelo($datos)
    {
        if ($datos['tabla'] == 1) {
            $consulta = "SELECT p.punto AS nombre ,s.registro_id FROM scada s INNER JOIN puntos p ON p.id = s.registro_id WHERE s.tabla =" . $datos['tabla'];
        } else if ($datos['tabla'] == 2) {
            $consulta = "SELECT t.tanque AS nombre ,s.registro_id FROM scada s INNER JOIN tanques t ON t.id = s.registro_id WHERE s.tabla =" . $datos['tabla'];
        } else if ($datos['tabla'] == 3) {
            $consulta = "SELECT sub.subestacion AS nombre ,s.registro_id FROM scada s INNER JOIN subestaciones sub ON sub.id = s.registro_id WHERE s.tabla =" . $datos['tabla'];
        }

        //print_r($consulta);
        $sql = mainModel::ejecutar_consulta_simple($consulta);
        return $sql;
    }

    static protected function obtener_propiedades_comparativo_scada_modelo($datos)
    {
        $consulta = "SELECT s.gateId, s.propiedad FROM scada s WHERE s.tabla = " . $datos['tabla'] . " AND registro_id = " . $datos['registro_id'];
        //print_r($consulta);
        $sql = mainModel::ejecutar_consulta_simple($consulta);
        return $sql;
    }

    static protected function consultar_comparativo_simop_comparativo_scada_modelo($fecha_hora_inicial, $fecha_hora_final, $propiedad, $tabla_comparativa, $registro_id)
    {
        
        switch ($tabla_comparativa) {
            case '1':
                if ($registro_id == 4 || $registro_id == 5 || $registro_id == 6) {
                    $consulta = "SELECT DISTINCT UNIX_TIMESTAMP(r.hora_programada)*1000 AS fecha, ROUND($propiedad/100, 3) AS propiedad FROM registros r INNER JOIN atributos_punto_registros apr ON apr.registro_id = r.id WHERE r.hora_programada BETWEEN '$fecha_hora_inicial' AND '$fecha_hora_final' AND r.punto_id = $registro_id ORDER BY 1";
                } else {
                    $consulta = "SELECT DISTINCT UNIX_TIMESTAMP(r.hora_programada)*1000 AS fecha, ROUND($propiedad, 3) AS propiedad FROM registros r INNER JOIN atributos_punto_registros apr ON apr.registro_id = r.id WHERE r.hora_programada BETWEEN '$fecha_hora_inicial' AND '$fecha_hora_final' AND r.punto_id = $registro_id ORDER BY 1";
                }
                break;
            case '2':
                $consulta = "SELECT DISTINCT UNIX_TIMESTAMP(tp.fecha_hora_programada)*1000 AS fecha, ROUND($propiedad, 3) AS propiedad FROM tanques_poniente tp WHERE tp.fecha_hora_programada BETWEEN '$fecha_hora_inicial' AND '$fecha_hora_final' AND tp.tanque_id = $registro_id ORDER BY 1";
                break;
            case '3':
                $consulta = "SELECT DISTINCT UNIX_TIMESTAMP(se.fecha_hora_programada)*1000 AS fecha, ROUND($propiedad, 3) AS propiedad FROM subs_electricas se WHERE se.fecha_hora_programada BETWEEN '$fecha_hora_inicial' AND '$fecha_hora_final' AND se.subestacion_id = $registro_id ORDER BY 1";
                break;

            default:
                # code...
                break;
        }
        //print_r($consulta);
        $sql = mainModel::ejecutar_consulta_simple($consulta);
        return $sql;
    }

    static protected function consultar_comparativo_scada_comparativo_scada_modelo($fecha_hora_inicial_epoch, $fecha_hora_final_epoch, $gateId)
    {
        if($gateId==19672792){
            $consulta = "SELECT time AS fecha, ROUND(value/1000,3) AS propiedad FROM dbo.VfiTagNumHistory WHERE time BETWEEN $fecha_hora_inicial_epoch AND $fecha_hora_final_epoch AND gateId = $gateId ORDER BY 1";
        }else{
            $consulta = "SELECT time AS fecha, ROUND(value,3) AS propiedad FROM dbo.VfiTagNumHistory WHERE time BETWEEN $fecha_hora_inicial_epoch AND $fecha_hora_final_epoch AND gateId = $gateId ORDER BY 1";
        }
        

        //print_r($consulta);
        $sql = mainModel::ejecutar_consulta_simple_ms($consulta);
        return $sql;
    }
}
