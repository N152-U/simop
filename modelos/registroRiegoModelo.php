<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';

class registroRiegoModelo extends mainModel
{
    protected function editar_registro_riego_captura_modelo($datos)
    {
      $usuario_id = mainModel::decryption($_SESSION[GUID]["id"]);

        $res = 0;
        $consulta1 = "UPDATE programa_riego_mediciones SET
            transmitio = :transmitio,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
            gasto_acueducto_real = :gasto_acueducto_real,
            gasto_otras_fuentes_real = :gasto_otras_fuentes_real,
            modified_at =  now(),
            created_by = :created_by
            WHERE fecha LIKE :fecha"; 

        $pdo = mainModel::conectar();
        try {

            $pdo->beginTransaction();
            $stmt = $pdo->prepare($consulta1);

            $stmt->execute(array(
                ":transmitio" => $datos["transmitio"],
                ":gasto_acueducto_real" => $datos["gasto_acueducto_real"],
                ":gasto_otras_fuentes_real" => $datos["gasto_otras_fuentes_real"],
                ":created_by" => $usuario_id[0],
                ":fecha" =>  $datos['fecha'] . '%',
            ));
            $stmt->closeCursor();
            $codigos = $stmt->errorInfo();

            if ($codigos[1] != null) {
                print_r($codigos);
                $res = -1;
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
 

  public function  obtener_mediciones_programa_riego_modelo($programa_riego_id)
  {
    $res="";
    $consulta1 = "SELECT * FROM programa_riego 
    INNER JOIN programa_riego_mediciones ON programa_riego.id=programa_riego_mediciones.programa_riego_id
    WHERE programa_riego.id=:programa_riego_id"; 

    $pdo = mainModel::conectar();
    try {

        $pdo->beginTransaction();
        $stmt = $pdo->prepare($consulta1);

        $stmt->execute(array(
            ":programa_riego_id" => $programa_riego_id,
        ));
        $res=$stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
 
    } catch (PDOException $e) {
        $pdo->rollBack();
        die($e->getMessage());
        //Error
      
    }

    return $res;
  }
  public function obtener_fechas($anio){
    $anio = intval($anio);
    $actual_date = date("Y-m-d");
        
  
     if($anio == date("Y")){
        $consulta = "SELECT prm.fecha FROM programa_riego 
        INNER JOIN programa_riego_mediciones prm ON programa_riego.id=prm.programa_riego_id
        WHERE programa_riego.anio = " . $anio . " AND prm.gasto_otras_fuentes_real IS NULL AND prm.gasto_acueducto_real IS NULL AND prm.fecha BETWEEN " . "'$anio-02-01'" ." AND " . "'$actual_date'" ." ";
    }else{
        $consulta = "SELECT prm.fecha FROM programa_riego 
        INNER JOIN programa_riego_mediciones prm ON programa_riego.id=prm.programa_riego_id
        WHERE programa_riego.anio = " . $anio . " AND prm.gasto_otras_fuentes_real IS NULL AND prm.gasto_acueducto_real IS NULL AND prm.fecha BETWEEN " . "'$anio-02-01'" ." AND  " . "'$anio-05-01'" ." ";
       }
  
    $sql = mainModel::ejecutar_consulta_simple($consulta);
    return $sql;
  }

}
