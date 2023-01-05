<?php
require_once dirname(__FILE__) . '/' . '../modelos/usuarioModelo.php';
class usuarioControlador extends usuarioModelo
{
    public function obtener_usuario_usuario_controlador($usuario_id)
    {
        $consulta_usuario = usuarioModelo::obtener_usuario_usuario_modelo($usuario_id);
        $usuario = array();


        while ($row = $consulta_usuario->fetch(PDO::FETCH_ASSOC)) {
            foreach (array_keys($row) as $element) {

                $usuario["$element"] = $row["$element"];
            }
        }
        return $usuario;
    }

    public function obtener_roles_usuario_controlador($estatus)
    {
        $consulta_roles = usuarioModelo::obtener_roles_usuario_modelo($estatus);
        $roles = array();


        while ($row = $consulta_roles->fetch(PDO::FETCH_ASSOC)) {
            array_push($roles, $row);
        }
        return $roles;
    }

    public function crear_usuario_usuario_controlador($usuarioDatos)
    {
        $crea_usuario =  usuarioModelo::crear_usuario_usuario_modelo($usuarioDatos);
        return $crea_usuario;
    }

    public function editar_usuario_usuario_controlador($usuarioDatos)
    {
        $actualiza_usuario =  usuarioModelo::editar_usuario_usuario_modelo($usuarioDatos);

        return $actualiza_usuario;
    }

    public function actualiza_estatus_usuario_usuario_controlador($estatus,$usuario_id)
    { 
        $elimina_usuario =  usuarioModelo::actualiza_estatus_usuario_usuario_modelo($estatus,$usuario_id);

        return $elimina_usuario;

    }
}


if (isset($_GET["vistas"])) {
    $data_url = explode("/", $_GET["vistas"]);


    if (isset($data_url) && sizeof($data_url) == 2) {

        $usuario_id = $data_url[1];
        
        $usuarioInstancia = new usuarioControlador();
        $usuarioDatos = $usuarioInstancia->obtener_usuario_usuario_controlador($usuario_id);
      
        if (isset($usuarioDatos) && $usuarioDatos) {
            $rolesContenedor = $usuarioInstancia->obtener_roles_usuario_controlador(1);
            $vista = true;
            $advertencia_autoeditado=false;
            print_r(usuarioControlador::decryption($_SESSION[GUID]["id"]));
            if($usuario_id==usuarioControlador::decryption($_SESSION[GUID]["id"])){
               
                $advertencia_autoeditado=true;
            }
            
        }
        else{
            $vista = false;
        }
    } else
    if (isset($data_url) && sizeof($data_url) == 1) {
        $usuarioInstancia = new usuarioControlador();
        $rolesContenedor = $usuarioInstancia->obtener_roles_usuario_controlador(1);

        $vista = true;
    }
}
