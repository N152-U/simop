	
<?php
require_once dirname(__FILE__) . '/' . '../modelos/rolesModelo.php';
class rolesControlador extends rolesModelo
{
    public function obtener_roles_roles_controlador($estatus)
    {
        $consulta_roles = rolesModelo::obtener_roles_roles_modelo($estatus);

        $roles = array();
        while ($row = $consulta_roles->fetch(PDO::FETCH_ASSOC)) {
           array_push($roles,$row);
        }
        return $roles;
    }
}


if (isset($_GET["vistas"])) {
    $data_url = explode("/", $_GET["vistas"]);
    $rolesInstancia = new rolesControlador();
    $rolesActivosContenedor = $rolesInstancia->obtener_roles_roles_controlador(1);
    $rolesInactivosContenedor = $rolesInstancia->obtener_roles_roles_controlador(0);
}