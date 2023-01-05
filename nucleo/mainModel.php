<?php
require_once dirname(__FILE__) . '/' . '../nucleo/configApp.php';
require_once dirname(__FILE__) . '/' . '../nucleo/configGeneral.php';
class mainModel
{
    static protected function conectar()
    {

        $enlace = new PDO(SGBD, USER, PASS);
        return $enlace;
    }

    protected function conectar_ms()
    {
        try {
            $enlace = new PDO(SGBD_MS, USER_MS, PASS_MS);

            return $enlace;
        } catch (PDOException $e) {
            echo "ERROR EN LA CONEXION";
        }
    }

    static protected function ejecutar_consulta_simple($consulta)
    {

        $respuesta = self::conectar()->prepare($consulta);
        $respuesta->execute();
        // print_r($respuesta->errorInfo());
        return $respuesta;
    }

    static protected function ejecutar_consulta_simple_ms($consulta)
    {

        $respuesta = self::conectar_ms()->prepare($consulta);
        $respuesta->execute();
        // print_r($respuesta->errorInfo());
        return $respuesta;
    }

    protected function obtener_gastos_puntos($fecha_inicial, $fecha_final)
    {

        $consulta = "SELECT apr.gasto, p.punto,p.id, r.hora_programada FROM atributos_punto_registros apr 
        INNER JOIN registros r
        ON r.id=apr.registro_id 
        INNER JOIN puntos p
        ON r.punto_id=p.id
        WHERE r.hora_programada BETWEEN '" . trim($fecha_inicial) . "'  AND '" . trim($fecha_final) . "'";
        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }
    protected function obtener_gastos_puntos_prom($fecha_inicial, $fecha_final)
    {

        $consulta = "SELECT (SUM(apr.gasto)/COUNT(p.id)) AS promedio,p.punto 
        FROM atributos_punto_registros apr
        INNER JOIN registros r
        ON r.id=apr.registro_id 
        INNER JOIN puntos p
        ON r.punto_id=p.id
        WHERE r.hora_programada BETWEEN '" . trim($fecha_inicial) . "'  AND '" . trim($fecha_final) . "'
        GROUP BY p.id;";
        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }

    protected function obtener_catalogo_despliegue_usuarios($permiso)
    {
        $consulta = "SELECT usrs.id, usrs.usuario, CONCAT_WS(' ',usrs.nombre, usrs.ap, usrs.am) as nombre_completo, p.permiso FROM usuarios usrs INNER JOIN roles_permisos rp ON usrs.rol_id= rp. rol_id INNER JOIN permisos p ON  rp.permiso_id=p.id WHERE usrs.rol_id!=1 AND p.permiso='$permiso'";

        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }

    public function getUsersByPermissionsEnabled($permisos)
    {       
            $permisos=explode(",", $permisos);
            $consulta = "SELECT usrs.id, usrs.usuario, CONCAT_WS(' ',usrs.nombre, usrs.ap, usrs.am) as nombre_completo, p.permiso FROM usuarios usrs INNER JOIN roles_permisos rp ON usrs.rol_id= rp. rol_id INNER JOIN permisos p ON  rp.permiso_id=p.id ";
            if(sizeof($permisos)>0){
                $permission_params="";
                
                for($i=0;$i<sizeof( $permisos); $i++)
                {
                    $permission_params.="?,";
                }
                $permission_params=substr($permission_params,0, strlen($permission_params)-1);
                $consulta = "SELECT usrs.id, usrs.usuario, CONCAT_WS(' ',usrs.nombre, usrs.ap, usrs.am) as nombre_completo, p.permiso FROM usuarios usrs INNER JOIN roles_permisos rp ON usrs.rol_id= rp. rol_id INNER JOIN permisos p ON  rp.permiso_id=p.id WHERE p.permiso IN (".$permission_params.")";
            }
          
           
           
           
            $sql = mainModel::conectar()->prepare($consulta);

       

            foreach ($permisos as $k => $permission)
                $sql->bindValue(($k+1), $permission);
       
           
            $sql->execute();
            
           $users=[];
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $row["id"]=mainModel::encryption($row["id"]);
                array_push($users, $row);
            }
         
            /* $stmt->close(); */
           
            return $users;
    }


    protected function obtener_fechas_punto($fecha_hora_inicial, $fecha_hora_final, $punto_id)
    {
        $consulta = "SELECT p.punto, r.punto_id, r.hora_programada, r.usuario_id, r.transmitio, r.novedades, GROUP_CONCAT(b.bomba SEPARATOR ', ') as bomba, GROUP_CONCAT(DISTINCT apr.presion SEPARATOR ',') as presion, GROUP_CONCAT(DISTINCT apr.tirante SEPARATOR ',') as tirante, GROUP_CONCAT(DISTINCT apr.gasto SEPARATOR ',') as gasto, apr.registro_id   
        FROM atributos_punto_registros apr INNER JOIN registros r
        ON r.id = apr.registro_id
        INNER JOIN puntos p
        ON p.id=r.punto_id
        INNER JOIN bombas b
        ON apr.bomba_id=b.id
        WHERE " . ($punto_id != 0 ? "r.punto_id=$punto_id AND " : ' ') . " r.hora_programada BETWEEN '" . trim($fecha_hora_inicial) . "' AND '" . trim($fecha_hora_final) . "'
	GROUP BY r.punto_id, r.hora_programada
	ORDER BY r.hora_programada, r.punto_id";
        # print_r($consulta);
        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }

    protected function obtener_fechas_puntos($fecha_hora_inicial, $fecha_hora_final, $puntos)
    {
        /*$consulta= "SELECT UPPER(p.punto) AS punto, r.punto_id, r.hora_programada, COALESCE(rps.folio,'NA') AS reporte_folio, COALESCE(rps.fecha,'NA') AS reporte_fecha, COALESCE(rps.id,'NA') AS reporte_id, r.usuario_id, r.transmitio,  b.bomba, apr.presion, apr.tirante, apr.gasto, apr.registro_id   
        FROM atributos_punto_registros apr INNER JOIN registros r
        ON r.id = apr.registro_id
        INNER JOIN puntos p
        ON p.id=r.punto_id
        INNER JOIN bombas b
        ON apr.bomba_id=b.id
	    LEFT JOIN  (SELECT DATE_FORMAT(fecha, '%Y-%m-%d') AS fecha, folio, id FROM reportes) rps 
        ON DATE_FORMAT(r.hora_programada, '%Y-%m-%d')=rps.fecha
        WHERE p.punto IN " . $puntos . " AND r.hora_programada BETWEEN '" . trim($fecha_hora_inicial) . "' AND '" . trim($fecha_hora_final) . "'
        ORDER BY r.punto_id, r.hora_programada";*/

        $consulta = " SELECT sb_registros.registro_id, UPPER(sb_registros.punto) AS punto, sb_registros.punto_id, sb_registros.hora_programada, sb_registros.transmitio, 
        sb_registros.tirante, sb_registros.gasto,  COALESCE(sb_novedades.novedades_id,'NA') AS novedades_id,  
        COALESCE(sb_novedades.tipos_afectacion,'NA') AS tipos_afectacion,  COALESCE(sb_novedades.fechas_horas_inicio,'NA') AS fechas_horas_inicio_novedad, 
        COALESCE(sb_novedades.fechas_horas_fin,'NA') AS fechas_horas_fin_novedad,  COALESCE(sb_novedades.reporto,'NA') AS reporto,
        COALESCE(sb_novedades.reporte_id,'NA') AS reporte_id, COALESCE(sb_novedades.reporte_folio,'NA') AS reporte_folio, COALESCE(sb_novedades.reporte_fecha,'NA') AS reporte_fecha
        
        FROM (SELECT rps.reporte_id, rps.reporte_folio, rps.reporte_fecha, GROUP_CONCAT(res1.novedad_id SEPARATOR '|') AS novedades_id, res2.registro_id, GROUP_CONCAT(res1.fecha_hora_inicio SEPARATOR '|') AS fechas_horas_inicio,GROUP_CONCAT(res1.fecha_hora_final SEPARATOR '|') fechas_horas_fin, GROUP_CONCAT(res1.tipo_afectacion SEPARATOR '|') AS tipos_afectacion, GROUP_CONCAT(res1.reporto SEPARATOR '|') AS reporto FROM ((SELECT 
                CONCAT_WS(' ',DATE_FORMAT(created_at, '%Y-%m-%d'), 
                DATE_FORMAT(hora_inicio,'%H:00:00')) AS fecha_hora_inicio,
                CONCAT_WS(' ',DATE_FORMAT(created_at, '%Y-%m-%d'),hora_final) AS fecha_hora_final, 
                tipo_afectacion, id AS novedad_id, reporto FROM novedades WHERE hora_final<>'00:00') res1
                JOIN 
                (SELECT r.punto_id, r.hora_programada, r.id AS registro_id, punto
                FROM registros r 
                INNER JOIN puntos p
                ON p.id=r.punto_id
                WHERE r.hora_programada BETWEEN '" . trim($fecha_hora_inicial) . "' AND '" . trim($fecha_hora_final) . "') res2 )
		INNER JOIN reporte_novedades USING(novedad_id)
		INNER JOIN (SELECT id AS reporte_id, folio AS reporte_folio, fecha AS reporte_fecha FROM reportes) rps  USING (reporte_id)
                WHERE res2.punto IN " . $puntos . " AND res2.hora_programada BETWEEN res1.fecha_hora_inicio AND fecha_hora_final GROUP BY res2.registro_id, rps.reporte_id ) sb_novedades
          RIGHT JOIN  
            (SELECT UPPER(p.punto) AS punto, r.punto_id, r.hora_programada, r.usuario_id, r.transmitio, apr.bomba_id, apr.presion, apr.tirante, apr.gasto, apr.registro_id   
                FROM atributos_punto_registros apr INNER JOIN registros r
                ON r.id = apr.registro_id
                INNER JOIN puntos p
                ON p.id=r.punto_id
                INNER JOIN bombas b
                ON apr.bomba_id=b.id WHERE r.hora_programada 
                BETWEEN '" . trim($fecha_hora_inicial) . "' AND '" . trim($fecha_hora_final) . "') sb_registros USING (registro_id)
          
         WHERE sb_registros.punto IN " . $puntos . "
         ORDER BY sb_registros.punto_id, sb_registros.hora_programada";
        //print_r($consulta);
        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }


    protected function obtener_puntos()
    {

        $consulta = "SELECT id, UPPER(punto) as nombre_punto FROM puntos";
        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }

    protected function obtener_lumbreras()
    {

        $consulta = "SELECT id, UPPER(lumbrera) as nombre_lumbrera FROM lumbreras WHERE active=true";
        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }

    static protected function obtener_lumbreras_cuenta_fechas_restantes( $fecha_hora_inicial=null, $fecha_hora_final=null)
    {

        if ($fecha_hora_inicial == null && $fecha_hora_final == null) {
        
        $fecha_hora_inicial= date('Y-m-d H:00', strtotime('-'.PERIODO_LUMBRERAS.' hours'));
        $fecha_hora_final= date('Y-m-d H:00');
          // $consulta = "SELECT * FROM puntos p INNER JOIN registros r ON p.id=r.pozo WHERE DATE(r.hora_programada) = DATE(NOW()) and p.id=" . $punto_id;
          $consulta = "SELECT COALESCE(r2.id,r1.id ) AS id, UPPER(COALESCE(r2.lumbrera,r1.lumbrera )) AS nombre_lumbrera, COALESCE(r2.lumbrera_id,r1.lumbrera_id ) AS lumbrera_id, ".PERIODO_LUMBRERAS."-COALESCE(r2.cuenta,r1.cuenta ) as cuenta  FROM (
            SELECT l.id, l.lumbrera,l.leyenda, l.id AS lumbrera_id, 0 AS cuenta
            FROM lumbreras l WHERE active=TRUE
            )
            r1
            LEFT JOIN
            (
            SELECT l.id, l.lumbrera, lm.lumbrera_id, COUNT(*) cuenta
            FROM lumbreras l 
            LEFT JOIN lumbreras_mediciones lm ON l.id=lm.lumbrera_id 
            WHERE fecha_hora_programada 
            BETWEEN '" . trim($fecha_hora_inicial) . "' AND '" . trim($fecha_hora_final) . "'
            GROUP BY l.lumbrera
             ORDER BY lm.fecha_hora_programada 
            )r2
            ON r1.lumbrera_id=r2.lumbrera_id";
          
          
  
          $sql = mainModel::ejecutar_consulta_simple($consulta);
        
        }else{
            $consulta = "SELECT COALESCE(r2.id,r1.id ) AS id, UPPER(COALESCE(r2.lumbrera,r1.lumbrera )) AS nombre_lumbrera, COALESCE(r2.lumbrera_id,r1.lumbrera_id ) AS lumbrera_id,  ".PERIODO_LUMBRERAS."-COALESCE(r2.cuenta,r1.cuenta ) as cuenta  FROM (
                SELECT l.id, l.lumbrera,l.leyenda, l.id AS lumbrera_id, 0 AS cuenta
                FROM lumbreras l WHERE active=TRUE
                )
                r1
                LEFT JOIN
                (
                SELECT l.id, l.lumbrera, lm.lumbrera_id, COUNT(*) cuenta
                FROM lumbreras l 
                LEFT JOIN lumbreras_mediciones lm ON l.id=lm.lumbrera_id 
                WHERE fecha_hora_programada 
                BETWEEN '" . trim($fecha_hora_inicial) . "' AND '" . trim($fecha_hora_final) . "'
                GROUP BY l.lumbrera
                 ORDER BY lm.fecha_hora_programada 
                )r2
                ON r1.lumbrera_id=r2.lumbrera_id";
              
            
          $sql = mainModel::ejecutar_consulta_simple($consulta);
        }
  
        return $sql;
    }

    static protected function obtener_lumbrera_fechas_restantes( $lumbrera_id, $fecha_hora_inicial=null, $fecha_hora_final=null)
    {

        if ($fecha_hora_inicial == null && $fecha_hora_final == null) {
        
        $fecha_hora_inicial= date('Y-m-d H:00', strtotime('-'.PERIODO_LUMBRERAS.' hours'));
        $fecha_hora_final= date('Y-m-d H:00');
          // $consulta = "SELECT * FROM puntos p INNER JOIN registros r ON p.id=r.pozo WHERE DATE(r.hora_programada) = DATE(NOW()) and p.id=" . $punto_id;
          $consulta = "SELECT l.id, l.lumbrera,l.leyenda, lm.lumbrera_id, lm.tirante, lm.id AS registro_id, lm.transmitio, lm.novedades,  DATE_FORMAT(lm.fecha_hora_programada,'%Y-%m-%d %H:%i') AS hora_programada, lm.compuertas
          FROM lumbreras l 
          LEFT JOIN lumbreras_mediciones lm ON l.id=lm.lumbrera_id 
          WHERE 
           lm.lumbrera_id=".$lumbrera_id."
         AND fecha_hora_programada  BETWEEN '" . trim($fecha_hora_inicial) . "' AND '" . trim($fecha_hora_final) . "'
           ORDER BY lm.fecha_hora_programada ";
          

        
        }else{
            $consulta = "SELECT l.id, l.lumbrera,l.leyenda, lm.lumbrera_id, lm.tirante,  lm.id AS registro_id, lm.transmitio, lm.novedades,  DATE_FORMAT(lm.fecha_hora_programada,'%Y-%m-%d %H:%i') AS hora_programada, lm.compuertas
            FROM lumbreras l 
            LEFT JOIN lumbreras_mediciones lm ON l.id=lm.lumbrera_id 
            WHERE 
             lm.lumbrera_id=".$lumbrera_id."
            AND fecha_hora_programada  BETWEEN '" . trim($fecha_hora_inicial) . "' AND '" . trim($fecha_hora_final) . "'
             AND lm.lumbrera_id=".$lumbrera_id."
             ORDER BY lm.fecha_hora_programada ";;
              
        }
        $sql = mainModel::ejecutar_consulta_simple($consulta);
        return $sql;
    }

    protected function obtener_sistemas()
    {

        $consulta = "SELECT id, nombre_sistema  FROM sistemas ";
        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }

    protected function obtener_anios_riego_modelo()
    {
        $consulta = "SELECT id, anio from programa_riego ORDER BY anio DESC";
        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }

    protected function obtener_historico_riego_modelo($anio)
    {
        $anio = intval($anio);
        
        $consulta = "SELECT * FROM programa_riego 
        INNER JOIN programa_riego_mediciones ON programa_riego.id=programa_riego_mediciones.programa_riego_id
        WHERE programa_riego.anio = " . $anio . " AND programa_riego_mediciones.gasto_otras_fuentes_real IS NOT NULL AND programa_riego_mediciones.gasto_acueducto_real IS NOT NULL";
      
        $sql = mainModel::ejecutar_consulta_simple($consulta);
        return $sql;
    }

    public function  obtener_detalle_programa_riego_modelo($anio)
    {
      $res="";
      $consulta1 = "SELECT id, anio FROM programa_riego WHERE anio=:anio LIMIT 1"; 
  
      $pdo = mainModel::conectar();
      try {
  
          $pdo->beginTransaction();
          $stmt = $pdo->prepare($consulta1);
          $params=array(
            ":anio" => $anio,
          );
        
          $response = $stmt->execute($params);
        
          $response = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
          $stmt->closeCursor();
       
        /*   print_r($response); */
          $stmt->closeCursor();
   
      } catch (PDOException $e) {
          $pdo->rollBack();
          die($e->getMessage());
          //Error
        
      }
      return $response;
    }


    protected function guardar_bitacora($datosbitacora)
    {
        $consulta1 = "INSERT INTO bitacoras(usuario_id,ip,tabla,accion,fecha_hora) VALUES (:usuario_id,:ip,:tabla,:accion,now())";

        $pdo = mainModel::conectar();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare($consulta1);
            $stmt->execute(array(":usuario_id" => $_SESSION[GUID]["id"], ":ip" => $_SESSION[GUID]["ip"], ":tabla" => $datosbitacora["tabla"], ":accion" => $datosbitacora["accion"]));
            $subcategoriaConsulta = $stmt->fetchColumn();
            $codigos = $stmt->errorInfo();
            switch ($codigos[0]) {
                case 0:
                    $pdo->commit();
                    //Se ingresa
                    $res = 0;
                    break;
                default:
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
        -1 Ocurrio un Error 
        0 Se inserto la bitacora
        */
    }

    static public function consulta_permisos_rol($permisos, $rol_id)
    {

        $consulta = "SELECT p.id, p.permiso 
            FROM permisos p 
            INNER JOIN roles_permisos rp ON rp.permiso_id=p.id 
            WHERE rp.rol_id=" . $rol_id . ($permisos == "" ? ";" : " AND p.permiso IN " . $permisos." ORDER BY p.index_view");

        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }

    public function encryption($string)
    {
        $output = FALSE;
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    static public function decryption($string)
    {
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        //             $output= base64_decode($output);
        return $output;
    }

    protected function generar_codigo_aleatorio($letra, $longitud, $num)
    {
        for ($i = 1; $i <= $longitud; $i++) {
            $numero = rand(0, 9);
            $letra .= $numero;
        }
        return $letra . $num; //o return $letra."-".$num;
    }

    protected function limpiar_cadena($cadena)
    {
        $cadena = trim($cadena); //elimina los espacios en blanco de los textos
        $cadena = stripslashes($cadena); //elimina las barras invertidas
        $cadena = str_ireplace("<script>", "", $cadena); //elimina el valos script
        $cadena = str_ireplace("</script>", "", $cadena);
        $cadena = str_ireplace("<script src>", "", $cadena);
        $cadena = str_ireplace("<script type=>", "", $cadena);
        $cadena = str_ireplace("SELECT FROM *", "", $cadena);
        $cadena = str_ireplace("DELETE FROM", "", $cadena);
        $cadena = str_ireplace("INSERT INTO", "", $cadena);
        $cadena = str_ireplace("--", "", $cadena);
        $cadena = str_ireplace("^", "", $cadena);
        $cadena = str_ireplace("[", "", $cadena);
        $cadena = str_ireplace("]", "", $cadena);
        $cadena = str_ireplace("==", "", $cadena);
        $cadena = str_ireplace(";", "", $cadena);
        return $cadena;
    }

    protected function enviar_mensaje($mensaje)
    {
        $data = [
            'chat_id' => GROUPID,
            'text' => $mensaje
        ];
        //print_r(http_build_query($data));
        $response = file_get_contents("http://api.telegram.org/bot" . APIKEYBOT . "/sendMessage?" . http_build_query($data));
        return $response;
    }
}
