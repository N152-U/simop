<?php
require_once dirname(__FILE__) . '/' . '../modelos/notasModelo.php';
class notasControlador extends notasModelo
{
  public function crear_registros_notas_controlador($notasdatos)
  {
    $res = -1;
    $datos = array("descripcion" => $notasdatos["descripcion"]);
    //print_r($datos);
    $creacion_notas = notasModelo::crear_registros_notas_modelo($datos);
    $res = -1;
    if ($creacion_notas->rowCount() >= 1) {
      $res = 0;
      $fecha = date("Y-m-d H:i:s");
      // $mensaje = "\u{1F9A0}  Nota enviada a las ".$fecha."\n".$notasdatos["descripcion"];
      $mensaje = " \xF0\x9F\x97\x92 NOTA $fecha\n\n\n\xE2\x9C\x8F ".$notasdatos["descripcion"];
      $chat = mainModel::enviar_mensaje($mensaje);
    }


    // }

    return $res;
  }

  public function obtener_notas_controlador()
  {
    $notas_consulta = notasModelo::obtener_notas_modelo();
    $notas = array();
    while ($row = $notas_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($notas, $row);
    }
    return $notas;
  }
}



$data_url = explode("/", $_GET["vistas"]);

if (sizeof($data_url) == 1) {

  $instancia = new notasControlador();
  $rolCuentaUsuario = $_SESSION[GUID]["rol_id"];

  $contenedorUsuarios = $instancia->getUsersByPermissionsEnabled('RECIBIRNOTIFICACIONES');

  $data_url = explode("/", $_GET["vistas"]);
}
