<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';

class registroAnioRiegoModelo extends mainModel
{
    protected function crear_registros_riego_anio_captura_modelo($datos,$usuario_id)
    {
        
        $res = 0;
        $consulta1 = "INSERT INTO programa_riego (                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
            anio,  
            meta_volumen_acueducto,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
            meta_superficie_acueducto,
            meta_volumen_otras_fuentes,
            meta_superficie_otras_fuentes,
            created_at,
            modified_at,
            created_by)
            VALUES (  
            :anio,                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
            :meta_volumen_acueducto,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
            :meta_superficie_acueducto,
            :meta_volumen_otras_fuentes,
            :meta_superficie_otras_fuentes,
            now(),
            now(),
            :created_by)";
            
        $consulta2 = "INSERT INTO programa_riego_mediciones (                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
            programa_riego_id, 
            gasto_otras_fuentes_programado,  
            gasto_acueducto_programado,    
            fecha,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
            created_at,
            modified_at,
            created_by)
            VALUES ( 
            :programa_riego_id,
            :gasto_otras_fuentes_programado,                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
            :gasto_acueducto_programado,    
            :fecha,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
            now(),
            now(),
            :created_by)";
        $pdo = mainModel::conectar();
        try {

            $pdo->beginTransaction();
            $stmt = $pdo->prepare($consulta1);

            $stmt->execute(array(
                ":anio" => $datos["anio"],
                ":meta_volumen_acueducto" => $datos["meta_volumen_acueducto"],
                ":meta_superficie_acueducto" => $datos["meta_superficie_acueducto"],
                ":meta_volumen_otras_fuentes" => $datos["meta_volumen_otras_fuentes"],
                ":meta_superficie_otras_fuentes" => $datos["meta_superficie_otras_fuentes"],
                ":created_by" => $usuario_id[0]
            ));
            $stmt->closeCursor();
            $codigos = $stmt->errorInfo();

            if ($codigos[1] != null) {
                print_r($codigos);
                $res = -1;
            }else {

                $programa_riego_id = $pdo->lastInsertId();

                foreach ($datos['gasto_acueducto_programado'] as $index => $value) {
                    
                    $stmt = $pdo->prepare($consulta2);

                    $stmt->execute(array(
                        ":programa_riego_id" => $programa_riego_id,
                        ":gasto_otras_fuentes_programado" => $datos['gasto_otras_fuentes_programado'][$index],                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
                        ":gasto_acueducto_programado" => $datos['gasto_acueducto_programado'][$index],    
                        ":fecha" => $datos['fecha'][$index], 
                        ":created_by" => $usuario_id[0]
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
}
