<?php
require_once dirname(__FILE__) . '/' . '../modelos/novedadesModelo.php';
class novedadesControlador extends novedadesModelo
{

  public function crear_registros_novedades_controlador($novedadesdatos)
  {
    $res = -1;

    //  $datos = array("tipo" => $novedadesdatos["tipo"],"hora_inicio" => $novedadesdatos["hora_inicio"],"hora_final" => $novedadesdatos["hora_final"],"lugar" => $novedadesdatos["lugar"],"gasto" => $novedadesdatos["gasto"],"razon" => $novedadesdatos["razon"],"reporto" => $novedadesdatos["reporto"],"centro_informacion" => $novedadesdatos["centro_informacion"],"ci_hora" => $novedadesdatos["ci_hora"],"san_joaquin" => $novedadesdatos["san_joaquin"],"sj_hora" => $novedadesdatos["sj_hora"]);
    //print_r($datos);
    $creacion_novedades = novedadesModelo::crear_registros_novedades_modelo($novedadesdatos);
    $res = -1;
    if ($creacion_novedades->rowCount() >= 1) {
      $res = 0;
      $fecha = date("Y-m-d H:i:s");
      $mensaje = "\xF0\x9F\x97\x9E NOVEDAD $fecha\n\n\n";
      $mensaje .= "\xF0\x9F\x9A\xB0 " . $novedadesdatos['novedades_tipo'] . " DE " . $novedadesdatos['dateranage_inicio'] . " A " . $novedadesdatos['dateranage_fin'] . " HRS, EN " . $novedadesdatos['lugar'] . " DEJANDO DE APORTAR UN GASTO DE " . $novedadesdatos['gasto'] . " L.P.S. " . $novedadesdatos['razon'];
      /* $mensaje .= "\u{1F5FC} TIPO DE AFECTACIÓN: " . $novedadesdatos['novedades_tipo'] . "\n\n";
      $mensaje .= "\u{1F570} HORA DE AFECTACIÓN: " . $novedadesdatos['dateranage_inicio'] . " A " . $novedadesdatos['dateranage_fin'] . "\n\n";
      $mensaje .= "\u{1F3DB} LUGAR DE AFECTACIÓN: " . $novedadesdatos['lugar'] . "\n\n";
      $mensaje .= "\u{1F6B0} GASTO DEJADO DE APORTAR: " . $novedadesdatos['gasto'] . " L/s\n\n";
      $mensaje .= "\u{1F4A1} RAZON: " . $novedadesdatos['razon'] . "\n\n";
      $mensaje .= "\u{1F472} REPORTO: " . $novedadesdatos['reporto'] . "\n\n";
      $mensaje .= "\u{1F3E2} CENTRO DE INFORMACIÓN: " . $novedadesdatos['centro_informacion'] . " " . $novedadesdatos['dateranage_ci_hora'] . "\n\n";
      $mensaje .= "\u{1F3E1} SAN JOAQUIN: " . $novedadesdatos['san_joaquin'] . " " . $novedadesdatos['dateranage_sj_hora'] . "\n\n"; */
      $chat = mainModel::enviar_mensaje($mensaje);
    }


    // }

    return $res;
  }

  public function obtener_novedades_controlador()
  {
    $novedades_consulta = novedadesModelo::obtener_novedades_modelo();
    $novedades = array();
    while ($row = $novedades_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($novedades, $row);
    }
    return $novedades;
  }

  public function getCount_NovedadesController()
  {
    $novedades_consulta = novedadesModelo::obtener_novedades_modelo();
  
    return sizeof($novedades_consulta->fetchAll());
  }
 
}

$data_url = explode("/", $_GET["vistas"]);

if (sizeof($data_url) == 1) {

  $instancia = new novedadesControlador();
  $contenedorUsuarios = $instancia->getUsersByPermissionsEnabled("RECIBIRNOTIFICACIONES");

}

