<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';

class reporteSistemasModelo extends mainModel{
    protected function obtener_ultima_fecha_reporte_sistemas_modelo()
    {
        $consulta= "     SELECT 
        (CASE res2.suma
            WHEN
                4
            THEN
                (SELECT 
                        r.hora_programada
                    FROM
                        atributos_punto_registros apr
                            INNER JOIN
                        registros r ON r.id = apr.registro_id
                            INNER JOIN
                        puntos p ON r.punto_id = p.id
                    WHERE
                        p.punto IN ('VENTURYII' , 'VENTURYIII', 'ATARASQUILLO', 'VENADO')
                            AND r.hora_programada IN (SELECT 
                    MAX(r2.hora_programada)
                FROM
                    registros r2 INNER JOIN puntos p2 ON r2.punto_id = p2.id WHERE p2.punto IN('VENTURYII' , 'VENTURYIII', 'ATARASQUILLO', 'VENADO'))
                    GROUP BY p.id , r.hora_programada LIMIT 1)
            ELSE (SELECT 
                    MIN(ultima_fecha) AS ultima_fecha
                FROM
                    (SELECT 
                        UPPER(p.punto) punto, MAX(r.hora_programada) AS ultima_fecha
                    FROM
                        atributos_punto_registros apr
                    INNER JOIN registros r ON r.id = apr.registro_id
                    INNER JOIN puntos p ON r.punto_id = p.id
                    GROUP BY p.id) res1
                WHERE
                    res1.punto NOT IN (SELECT 
                            UPPER(p.punto) punto
                        FROM
                            atributos_punto_registros apr
                                INNER JOIN
                            registros r ON r.id = apr.registro_id
                                INNER JOIN
                            puntos p ON r.punto_id = p.id
                        WHERE
                            p.punto IN ('VENTURYII' , 'VENTURYIII', 'ATARASQUILLO', 'VENADO')
                                AND r.hora_programada IN (SELECT 
                    MAX(r2.hora_programada)
                FROM
                    registros r2 INNER JOIN puntos p2 ON r2.punto_id = p2.id WHERE p2.punto IN('VENTURYII' , 'VENTURYIII', 'ATARASQUILLO', 'VENADO'))
                        GROUP BY p.id , r.hora_programada)
                        AND res1.punto IN ('VENTURYII' , 'VENTURYIII', 'ATARASQUILLO', 'VENADO')
                LIMIT 1)
        END) AS ultima_hora
    FROM
        (SELECT 
            SUM(res.cuenta) suma
        FROM
            (SELECT 
            COUNT(*) cuenta, r.hora_programada AS ultima_fecha, p.punto
        FROM
            atributos_punto_registros apr
        INNER JOIN registros r ON r.id = apr.registro_id
        INNER JOIN puntos p ON r.punto_id = p.id
        WHERE
            p.punto IN ('VENTURYII' , 'VENTURYIII', 'ATARASQUILLO', 'VENADO')
                AND r.hora_programada IN (SELECT 
                    MAX(r2.hora_programada)
                FROM
                    registros r2 INNER JOIN puntos p2 ON r2.punto_id = p2.id WHERE p2.punto IN('VENTURYII' , 'VENTURYIII', 'ATARASQUILLO', 'VENADO'))
        GROUP BY p.id , r.hora_programada) res
        HAVING suma >= 1) res2;";
        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;

    }
    


}
?>
