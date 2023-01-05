<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';

class graficaRiegoModelo extends mainModel{
   
    protected function obtener_puntos_tablero_modelo($anio)
   
    {
  
    $consulta="";
  
      
            $consulta = "SELECT * FROM programa_riego 
            INNER JOIN programa_riego_mediciones ON programa_riego.id=programa_riego_mediciones.programa_riego_id
            WHERE fecha LIKE '$anio%' ";
      
   
    $sql = self::ejecutar_consulta_simple($consulta);
   /*  var_dump($sql); */
    return $sql;
       

    }
    
    protected function obtener_resumen_riego_modelo($anio)
    {
        $anio = intval($anio);
            
        $consulta = " SELECT (SUM(prm.`gasto_acueducto_real`)+ (SELECT IF(gasto_acueducto_real IS NULL, 0, gasto_acueducto_real) FROM programa_riego_mediciones WHERE fecha = " . "'$anio-04-30'" ."))*86.4 AS volumen_gasto_acueducto, 
        (SUM( prm.`gasto_otras_fuentes_real`)+ (SELECT IF(gasto_otras_fuentes_real IS NULL,0,gasto_otras_fuentes_real) FROM programa_riego_mediciones WHERE fecha = " . "'$anio-04-30'" ."))*86.4 AS volumen_gasto_otras_fuentes,
            pr.meta_volumen_acueducto, pr.meta_superficie_acueducto,
            pr.meta_volumen_otras_fuentes, pr.meta_superficie_otras_fuentes,
            
             ((SUM( prm.`gasto_otras_fuentes_real`)+ (SELECT IF(gasto_otras_fuentes_real IS NULL,0,gasto_otras_fuentes_real) FROM programa_riego_mediciones WHERE fecha = " . "'$anio-04-30'" ."))*86.4)*(ROUND(pr.meta_superficie_otras_fuentes/pr.meta_volumen_otras_fuentes,15)) AS superficie_otras_fuentes,
             
             
             ((SUM(prm.`gasto_acueducto_real`)+ (SELECT IF(gasto_acueducto_real IS NULL,0,gasto_acueducto_real) FROM programa_riego_mediciones WHERE fecha = " . "'$anio-04-30'" ."))*86.4)*(ROUND((pr.meta_superficie_acueducto/pr.meta_volumen_acueducto),15)) AS superficie_acueducto,
             
             
             
             
	  (((SUM( prm.`gasto_otras_fuentes_real`)+ (SELECT IF(gasto_otras_fuentes_real IS NULL,0,gasto_otras_fuentes_real) FROM programa_riego_mediciones WHERE fecha = " . "'$anio-04-30'" ."))*86.4)/meta_volumen_otras_fuentes)*100 AS avance_gasto_otras_fuentes,
	   (((SUM(prm.`gasto_acueducto_real`)+ (SELECT IF(gasto_acueducto_real IS NULL,0,gasto_acueducto_real) FROM programa_riego_mediciones WHERE fecha = " . "'$anio-04-30'" ."))*86.4)/meta_volumen_acueducto)*100 AS avance_gasto_acueducto, (meta_volumen_acueducto+meta_volumen_otras_fuentes) 
	   AS total_meta_volumen,
       (meta_superficie_acueducto+meta_superficie_otras_fuentes) AS total_meta_superficie
            FROM programa_riego pr
                    INNER JOIN programa_riego_mediciones prm ON
                     pr.id=prm.programa_riego_id
        WHERE pr.anio = " . $anio . " AND prm.gasto_otras_fuentes_real IS NOT NULL AND prm.gasto_acueducto_real IS NOT NULL
        ";
       
        $sql = mainModel::ejecutar_consulta_simple($consulta);
     
        return $sql;
    }
    protected function obtener_gasto_diario_riego_modelo($anio)
   
    {   
        $anio = intval($anio);
        
        if($anio == date("Y")){
            $consulta =  "SELECT IF(prm.gasto_otras_fuentes_real IS NULL,0,prm.gasto_otras_fuentes_real ) AS gasto_otras_fuentes_real,
            IF(prm.gasto_acueducto_real IS NULL,0,prm.gasto_acueducto_real ) AS gasto_acueducto_real,
            prm.fecha
                FROM programa_riego pr
                        INNER JOIN programa_riego_mediciones prm ON
                         pr.id=prm.programa_riego_id
                        WHERE pr.anio = " . $anio . " AND prm.fecha = CAST(NOW() AS DATE)";
        }else{
            $consulta =  " SELECT IF(prm.gasto_otras_fuentes_real IS NULL,0,prm.gasto_otras_fuentes_real ) AS gasto_otras_fuentes_real,
            IF(prm.gasto_acueducto_real IS NULL,0,prm.gasto_acueducto_real ) AS gasto_acueducto_real,
            prm.fecha
            FROM programa_riego pr
            INNER JOIN programa_riego_mediciones prm ON
            pr.id=prm.programa_riego_id
            WHERE pr.anio = " . $anio . " AND prm.fecha = " . "'$anio-05-01'" ."";
        }
        
    $sql = mainModel::ejecutar_consulta_simple($consulta);

    return $sql;

    }

}