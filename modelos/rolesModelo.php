<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';
class rolesModelo extends mainModel
{
    protected function obtener_roles_roles_modelo($estatus)
    {
        $consulta = "SELECT * FROM roles WHERE id != 1  AND estatus=".$estatus."  ORDER BY index_view ASC";


        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }
    
}