<?php
require_once dirname(__FILE__) . '/' . '../modelos/permisosModelo.php';
class permisosControlador extends permisosModelo
{
    public function consulta_permisos_permisos_controlador($permisos,$rol_id)
    {
        
        $consulta_permisos_rol = mainModel::consulta_permisos_rol($permisos,$rol_id);

        $permisos_rol = array();
        while ($row = $consulta_permisos_rol->fetch(PDO::FETCH_ASSOC)) {
           array_push($permisos_rol,$row);
        }
        return $permisos_rol;
    }
}