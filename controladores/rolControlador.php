<?php
require_once dirname(__FILE__) . '/' . '../modelos/rolModelo.php';
class rolControlador extends rolModelo
{
    public function obtener_rol_rol_controlador($rol_id)
    {
        $consulta_rol = rolModelo::obtener_rol_rol_modelo($rol_id);

        $rol = array();
        while ($row = $consulta_rol->fetch(PDO::FETCH_ASSOC)) {
            foreach (array_keys($row) as $element) {

                $rol["$element"] = $row["$element"];
            }
        }

        return $rol;
    }

    public function obtener_permisos_rol_rol_controlador($rol_id)
    {
        $consulta_permisos_rol = rolModelo::obtener_permisos_rol_rol_modelo($rol_id);

        $permisos_rol = array();
        while ($row = $consulta_permisos_rol->fetch(PDO::FETCH_ASSOC)) {
            array_push($permisos_rol, $row);
        }
        return $permisos_rol;
    }

    public function obtener_permisos_rol_controlador($rolCuentaUsuario)
    {
        $consulta_permisos = rolModelo::obtener_permisos_rol_modelo($rolCuentaUsuario);
        
        $permisos = array();
        while ($row = $consulta_permisos->fetch(PDO::FETCH_ASSOC)) {
            array_push($permisos, $row);
        }
        return $permisos;
    }

    public function crear_rol_rol_controlador($rolDatos)
    {

        $crear_rol = rolModelo::crear_rol_rol_modelo($rolDatos);

        return $crear_rol;
    }

    public function editar_rol_rol_controlador($rolDatos)
    {
        $actualiza_rol = rolModelo::editar_rol_rol_modelo($rolDatos);

        return $actualiza_rol;
    }

    public function actualiza_estatus_rol_rol_controlador($estatus,$rol_id)
    {
        $actualiza_estatus_rol=rolModelo::actualiza_estatus_rol_rol_modelo($estatus,$rol_id);
        return $actualiza_estatus_rol;
    }
 
}


if (isset($_GET["vistas"])) {
    $data_url = explode("/", $_GET["vistas"]);


    if (isset($data_url) && sizeof($data_url) == 2) {
        $rol_id = $data_url[1];
        $rolInstancia = new rolControlador();
        $rolDatos = $rolInstancia->obtener_rol_rol_controlador($rol_id);
      
        if (isset($rolDatos) && $rolDatos) {
            
            $permisosContenedor = $rolInstancia->obtener_permisos_rol_controlador($_SESSION[GUID]["rol_id"]);
            $permisosDatos = $rolInstancia->obtener_permisos_rol_rol_controlador($rolDatos["id"]);
            $vista = true;
        }
        else{
            $vista = false;
        }

    } else
    if (isset($data_url) && sizeof($data_url) == 1) {
        $tipoAdministrador=false;
        $rolInstancia = new rolControlador();
        $permisosDatos=array();
        $permisosContenedor = $rolInstancia->obtener_permisos_rol_controlador($_SESSION[GUID]["rol_id"]);
        $vista = true;
    }
}
