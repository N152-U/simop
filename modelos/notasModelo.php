<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';

class notasModelo extends mainModel
{
    protected function crear_registros_notas_modelo($datos)
    {
        $usuario_id = mainModel::decryption($_SESSION[GUID]["id"]);
        $consulta1 = "INSERT INTO notas (                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
            descripcion,                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
            created_at,
            modified_at,
            usuario_id
            )
            VALUES (  
            :descripcion,                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
            now(),                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
            now(),
            :usuario_id
            )";
        $sql = mainModel::conectar()->prepare($consulta1);

        $sql->bindParam(":descripcion", $datos["descripcion"]);
        $sql->bindParam(":usuario_id", $usuario_id);
        $sql->execute();
        return $sql;
    }
    protected function obtener_notas_modelo()
    {
        $fecha_inicial = date("Y-m-d 00:00:00");
        $fecha_final = date("Y-m-d 23:59:59");
        $consulta = "SELECT descripcion, created_at as fecha FROM notas WHERE created_at BETWEEN '" . trim($fecha_inicial) . "'  AND '" . trim($fecha_final) . "'";
        //print_r($consulta);
        $sql = mainModel::ejecutar_consulta_simple($consulta);
        return $sql;
    }
}