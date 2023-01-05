
<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';
class usuariosModelo extends mainModel
{
    protected function obtener_usuarios_usuarios_modelo($estatus)
    {
        $consulta = "SELECT u.id, u.usuario, CONCAT_WS(' ',u.nombre,u.ap,u.am) AS nombre, u.pwd, r.rol, u.index_view FROM usuarios u INNER JOIN roles r ON r.id=u.rol_id AND u.rol_id!=1 AND u.estatus=".$estatus." ORDER BY u.index_view ASC";


        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }

    
}