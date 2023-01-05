<?php
require_once "nucleo/configGeneral.php";
require_once './controladores/vistasControlador.php';

if((DEPLOY&&!isset($_GET["dev"]))||(!DEPLOY&&isset($_GET["dev"])))
{
    $plantilla = new vistasControlador();
    $plantilla->obtener_plantilla_controlador();
    
}
else{
    require_once "./vistas/modulos/support.php";
  
}
