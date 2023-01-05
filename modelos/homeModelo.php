<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';
class homeModelo extends mainModel
{
    
    protected function consulta_informacion_puntos_home_modelo($tipo)
    {
        switch($tipo){
            case "tanques":
                $consulta = "SELECT tanque, lat, lon,  res2.fecha_hora_programada, COALESCE(res2.transmite, 'NA') AS transmite,  COALESCE(res2.tirante_uno,0) AS tirante_uno, COALESCE(res2.tirante_dos,0) AS tirante_dos, 
                COALESCE(res2.tirante_tres,0) AS tirante_tres, COALESCE(res2.tirante_cuatro,0) AS tirante_cuatro, COALESCE(res2.descarga_uno,0) AS descarga_uno, COALESCE(res2.descarga_dos,0) AS descarga_dos, 
                COALESCE(res2.descarga_tres,0) AS descarga_tres,  COALESCE(res2.eq1,'NA') AS eq1, COALESCE(res2.eq2,'NA') AS eq2, COALESCE(res2.eq3,'NA') AS eq3, 
                COALESCE(res2.eq4,'NA') AS eq4, COALESCE(res2.eq5,'NA') AS eq5, COALESCE(res2.equipos,'NA') AS equipos, COALESCE(res2.bypass,'NA') AS bypass FROM (
                SELECT  tq.tanque, MAX(lat) as lat, MAX(lon) as lon, MAX(tqp.fecha_hora_programada) AS fecha_hora_programada, MAX(tqp.id) AS tanques_poniente_id FROM tanques tq INNER JOIN tanques_poniente tqp ON tq.id=tqp.tanque_id 
                GROUP BY tq.tanque) res1
                INNER JOIN ( SELECT * FROM tanques_poniente) res2 ON res1.tanques_poniente_id=res2.id";
                break;
            case "subestaciones":
                $consulta="SELECT subestacion, lat, lon,  res1.fecha_hora_programada, COALESCE(res2.amperaje,0) AS amperaje, COALESCE(res2.transmite,'NA') AS transmite FROM (
                    SELECT sub.subestacion, MAX(lat) as lat, MAX(lon) as lon, MAX(subels.fecha_hora_programada) AS fecha_hora_programada , MAX(subels.id) AS subs_electricas_id FROM subestaciones sub INNER JOIN subs_electricas subels ON sub.id=subels.subestacion_id GROUP BY sub.subestacion
                    ) res1
                    INNER JOIN ( SELECT * FROM subs_electricas) res2 ON res1.subs_electricas_id=res2.id";
                break;
            case "plantas_rembombeo":
                $consulta="SELECT punto, res1.lat, res1.lon, res1.punto_id, res1.hora_programada, GROUP_CONCAT(res2.bomba SEPARATOR ', ') AS bomba, GROUP_CONCAT(DISTINCT res2.presion SEPARATOR ',') AS presion, GROUP_CONCAT(DISTINCT res2.tirante SEPARATOR ',') AS tirante, GROUP_CONCAT(DISTINCT res2.gasto SEPARATOR ',') AS gasto, res1.registro_id FROM
                (SELECT p.punto, p.lat, p.lon, r.punto_id, MAX(r.hora_programada) AS hora_programada, MAX(apr.registro_id ) AS registro_id 
                        FROM atributos_punto_registros apr INNER JOIN registros r
                        ON r.id = apr.registro_id
                        INNER JOIN puntos p
                        ON p.id=r.punto_id
                         
                    GROUP BY r.punto_id) res1
                INNER JOIN (SELECT * FROM atributos_punto_registros INNER JOIN bombas b
                        ON bomba_id=b.id  ) res2 ON res1.registro_id =res2.registro_id
                   GROUP BY res1.punto_id";
             
        }
       

        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }
}
