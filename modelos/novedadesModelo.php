<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';

class novedadesModelo extends mainModel
{
    protected function crear_registros_novedades_modelo($datos)
    {
        $usuario_id = mainModel::decryption($_SESSION[GUID]["id"]);
        $consulta1 = "INSERT INTO novedades (   
            usuario_id,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
            tipo_afectacion,  
            hora_inicio,
            hora_final,
            lugar_afectacion,
            gasto,
            razon,
            reporto,
            recibio_centro_informacion,
            hora_centro_informacion,
            recibio_san_joaquin,
            hora_san_joaquin,
            created_at,
            modified_at
            )
            VALUES (  
            :usuario_id,
            :tipo,  
            :hora_inicio,
            :hora_final,
            :lugar,
            :gasto,
            :razon,
            :reporto,
            :centro_informacion,
            :ci_hora,
            :san_joaquin,
            :sj_hora,                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
            now(),                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
            now()
        
            )";
        $sql = mainModel::conectar()->prepare($consulta1);

        /* $sql->bindParam(":tipo", $datos["tipo"]);
        $sql->bindParam(":hora_inicio", $datos["hora_inicio"]);
        $sql->bindParam(":hora_final", $datos["hora_final"]);
        $sql->bindParam(":lugar", $datos["lugar"]);
        $sql->bindParam(":gasto", $datos["gasto"]);
        $sql->bindParam(":razon", $datos["razon"]);
        $sql->bindParam(":reporto", $datos["reporto"]);
        $sql->bindParam(":centro_informacion", $datos["centro_informacion"]);
        $sql->bindParam(":ci_hora", $datos["ci_hora"]);
        $sql->bindParam(":san_joaquin", $datos["san_joaquin"]);
        $sql->bindParam(":sj_hora", $datos["sj_hora"]); */
        $sql->bindParam(":tipo", $datos["novedades_tipo"]);
        $sql->bindParam(":hora_inicio", $datos["dateranage_inicio"]);
        $sql->bindParam(":hora_final", $datos["dateranage_fin"]);
        $sql->bindParam(":lugar", $datos["lugar"]);
        $sql->bindParam(":gasto", $datos["gasto"]);
        $sql->bindParam(":razon", $datos["razon"]);
        $sql->bindParam(":reporto", $datos["reporto"]);
        $sql->bindParam(":centro_informacion", $datos["centro_informacion"]);
        $sql->bindParam(":ci_hora", $datos["dateranage_ci_hora"]);
        $sql->bindParam(":san_joaquin", $datos["san_joaquin"]);
        $sql->bindParam(":sj_hora", $datos["dateranage_sj_hora"]);
        $sql->bindParam(":usuario_id", $usuario_id);

        $sql->execute();
        return $sql;
    }
    protected function obtener_novedades_modelo()
    {
        $fecha_inicial = date("Y-m-d 00:00:00");
        $fecha_final = date("Y-m-d 23:59:59");
        $consulta = "SELECT * FROM novedades WHERE created_at BETWEEN '" . trim($fecha_inicial) . "'  AND '" . trim($fecha_final) . "'";
        $sql = mainModel::ejecutar_consulta_simple($consulta);
        return $sql;
    }
   
}
