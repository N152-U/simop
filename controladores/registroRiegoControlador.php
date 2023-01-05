<?php
require_once dirname(__FILE__) . '/' . '../modelos/registroRiegoModelo.php';
class registroRiegoControlador extends registroRiegoModelo
{
  public function editar_registro_riego_controlador($capturadatos)
  {
    $res = -1;
    
    $actualiza_registros = registroRiegoModelo::editar_registro_riego_captura_modelo($capturadatos);
    if ($actualiza_registros == 0) {
      $res = 0;
    }

    return $res;
  }
  public function obtener_catalogo_despliegue_usuarios_captura_controlador($permiso, $rolCuentaUsuario)
  {
    $usuarios_consulta = mainModel::obtener_catalogo_despliegue_usuarios($permiso);
    $usuarios = array();
    /*Añadimos la cuenta actual, en caso de que el rol id sea el 1 (Administrador)*/
    if (mainModel::decryption($rolCuentaUsuario) == "1") {
     
      $usuarioActual = array(
        "id" => mainModel::decryption($_SESSION[GUID]["id"]),
        "usuario" =>  $_SESSION[GUID]["usuario"],
        "nombre_completo" =>   $_SESSION[GUID]["nombre"],
        "permiso" =>  $permiso
      );
      array_push($usuarios,$usuarioActual);
    }

    while ($row = $usuarios_consulta->fetch(PDO::FETCH_ASSOC)) {

      array_push($usuarios, $row);
    }
    
  
    return $usuarios;
  }

  public function obtener_detalle_programa_riego_controlador($anio){

    $anio = mainModel::obtener_detalle_programa_riego_modelo($anio);
   
    return $anio;

  }

  public function obtener_anios_riego_controlador()
  {
    $anios_consulta = mainModel::obtener_anios_riego_modelo();
    $anios_riego = array();
    while ($row = $anios_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($anios_riego, $row);
    }
    return $anios_riego;
  }

  public function obtener_mediciones_programa_riego_controlador($programa_riego_id)
  {
    $resultado=registroRiegoModelo::obtener_mediciones_programa_riego_modelo($programa_riego_id);

    $programa_riego_mediciones = array();
    while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
      array_push($programa_riego_mediciones, $row);
    }
    return $programa_riego_mediciones;
  }
  public function obtener_historico_riego_controlador($anio){
    $historico_riego_consulta = mainModel::obtener_historico_riego_modelo($anio);
    
    $historico_riego = array();
    while ($row = $historico_riego_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($historico_riego, $row);
    }
    return $historico_riego;
  }
  public function obtener_fechas($anio){
    $obtener_fechas_consulta = registroRiegoModelo::obtener_fechas($anio);
    
    $fechas_riego = array();
    while ($row = $obtener_fechas_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($fechas_riego, $row);
    }
    return $fechas_riego;
  }
}



if(sizeof(explode("/", $_GET["vistas"]))==2)
{ 
  $instanciaRegistroRiego = new registroRiegoControlador();

  $rolCuentaUsuario = $_SESSION[GUID]["rol_id"];
  $contenedorUsuarios = $instanciaRegistroRiego->obtener_catalogo_despliegue_usuarios_captura_controlador('CREARREGISTRORIEGO', $rolCuentaUsuario);
  $contenedoranios = $instanciaRegistroRiego->obtener_anios_riego_controlador();
  $instanciaRegistroRiego = new registroRiegoControlador();
  $anio = explode("/", $_GET["vistas"])[1];
  $programaRiego=0;
 $programaRiego=$instanciaRegistroRiego->obtener_detalle_programa_riego_controlador($anio);
 
 /* print_r($programaRiego); */
 /*  $datos$instanciaRegistroRiego->obtener_mediciones_programa_riego_controlador($anio); */
}


