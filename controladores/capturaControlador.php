<?php
require_once dirname(__FILE__) . '/' . '../modelos/capturaModelo.php';
class capturaControlador extends capturaModelo
{


  public function obtener_promedios_puntos_captura_controlador()
  {
    $promedios_puntos_consulta = mainModel::obtener_promedios_puntos();
    $tablero = array();
    while ($row = $promedios_puntos_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($tablero, $row);
    }
    return $tablero;
  }

  public function obtener_puntos_captura_controlador()
  {
    $puntos_consulta = mainModel::obtener_puntos();
    $puntos = array();
    while ($row = $puntos_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($puntos, $row);
    }
    return $puntos;
  }

  public function obtener_bombas_captura_controlador()
  {
    $bombas_consulta = capturaModelo::obtener_bombas_captura_modelo();
    $bombas = array();
    while ($row = $bombas_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($bombas, $row);
    }
    return $bombas;
  }

  public function crear_registros_captura_controlador($capturadatos)
  {
    $res = -1;


    $inserta_registros = capturaModelo::crear_registros_captura_modelo($capturadatos);
    if ($inserta_registros == 0) {
      $res = 0;
    }


    return $res;
  }


  public function editar_registros_captura_controlador($capturadatos)
  {
    $res = -1;


    $edicion_registros = capturaModelo::editar_registros_captura_modelo($capturadatos);
    if ($edicion_registros == 0) {
      $res = 0;
    }


    return $res;
  }






  public function obtener_fechas_punto_captura_controlador($punto_id,  $fecha_hora_inicial = null, $fecha_hora_final = null)
  {

    if ($fecha_hora_inicial == null && $fecha_hora_final == null) {
      // ESTA ES CAPTURA
      $dia = date('N');
      // Aqui va la condicion

      if ($dia == 1) {
        //$fecha_hora_ayer = date('Y-m-d H:00', strtotime("-3 days"));
        $fecha_hora_inicial = date('Y-m-d H:00', strtotime("-3 days"));
      } else {
        $fecha_hora_inicial = date('Y-m-d H:00', strtotime("-1 days"));
      }

      // $fecha_hora_ayer = date('Y-m-d H:00', strtotime("-1 days"));
      $fecha_hora_inicial = new DateTime($fecha_hora_inicial);


      $fecha_hora_final =  date("Y-m-d H:00");
      $fecha_hora_final2 =  date("Y-m-d H:00", strtotime("+1 hours"));
      $fecha_hora_final2 = new DateTime($fecha_hora_final2);
      $fecha_hora_final = new DateTime($fecha_hora_final);

      $intervalo = new DateInterval('PT60M');
      $periodo   = new DatePeriod($fecha_hora_inicial, $intervalo, $fecha_hora_final2);
      $horas = array();
    } else {
      // ESTA ES EDICION
      $fecha_hora_inicial = new DateTime($fecha_hora_inicial);
      $fecha_hora_final = new DateTime($fecha_hora_final);

      $intervalo = new DateInterval('PT60M');
      $periodo   = new DatePeriod($fecha_hora_inicial, $intervalo, $fecha_hora_final);
      $horas = array();
    }

    foreach ($periodo as $hora) {

      // Guardamos las horas intervalos 
      array_push($horas, $hora->format('Y-m-d H:i'));
    }

    $consulta_fechas_pozo = capturaModelo::obtener_fechas_punto_captura_modelo($punto_id, date_format($fecha_hora_inicial, 'Y-m-d H:00'), date_format($fecha_hora_final, 'Y-m-d H:00'));
    $fechas_puntos = array();

    while ($row = $consulta_fechas_pozo->fetch(PDO::FETCH_ASSOC)) {
      $date = new DateTime($row["hora_programada"]);
      $hora_programada = date_format($date, 'Y-m-d H:i');




      if (array_search($hora_programada, $horas) >= -1) {

        unset($horas[array_search($hora_programada, $horas)]);
      }
      array_push($fechas_puntos, $row);
    }

    $fechas_registradas = array();
    $temp_registro_id = "";
    foreach ($fechas_puntos as $index => $row) {
      // Inicia la Iteración
      if ($index == 0) {
        array_push($fechas_registradas, array("registro_id" => $fechas_puntos[$index]["registro_id"], "punto_id" => $row["punto_id"], "usuario_id" => $row["usuario_id"], "punto" => $row["punto"], "presion" => $row["presion"], "tirante" => $row["tirante"], "gasto" => $row["gasto"], "hora_programada" => $row["hora_programada"], "transmitio" => $row["transmitio"], "novedades" => $row["novedades"], "bomba_id" => $row['bomba_id'], "bombas_usadas" => $row['bomba_usada_id']));
        $temp_registro_id = $row["registro_id"];
        // Cuando el registro sea diferente
      } else if ($temp_registro_id != $fechas_puntos[$index]["registro_id"]) {
        array_push($fechas_registradas, array("registro_id" => $fechas_puntos[$index]["registro_id"], "punto_id" => $row["punto_id"], "usuario_id" => $row["usuario_id"], "punto" => $row["punto"], "presion" => $row["presion"], "tirante" => $row["tirante"], "gasto" => $row["gasto"], "hora_programada" => $row["hora_programada"], "transmitio" => $row["transmitio"], "novedades" => $row["novedades"], "bomba_id" => $row['bomba_id'], "bombas_usadas" => $row['bomba_usada_id']));
        $temp_registro_id = $row["registro_id"];
      }
      // Cuando los demas no
      else {
        $fechas_registradas[sizeof($fechas_registradas) - 1]['bomba_id'] .= ", " . $row['bomba_id'];
        $fechas_registradas[sizeof($fechas_registradas) - 1]['bombas_usadas'] .= "," . $row['bomba_usada_id'];
      }
    }


    $horas = array_values($horas);

    $fechas_concentrado = array("fechas_registradas" => $fechas_registradas, "fechas_restantes" => $horas);

    return $fechas_concentrado;
  }


  public function obtener_validacion_rango_tirante_captura_controlador($punto_id)
  {

    $nombres_puntos_consulta = capturaModelo::obtener_validacion_rango_tirante_captura_modelo($punto_id);
    $nombres = array();
    while ($row = $nombres_puntos_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($nombres, $row);
    }
    return $nombres;
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
}


$data_url = explode("/", $_GET["vistas"]);

if (sizeof($data_url) == 1) {

  $instancia = new capturaControlador();
  $rolCuentaUsuario = $_SESSION[GUID]["rol_id"];
  $contenedorpuntos = $instancia->obtener_puntos_captura_controlador();
  $contenedorbombas = $instancia->obtener_bombas_captura_controlador();
  $contenedorUsuarios = $instancia->obtener_catalogo_despliegue_usuarios_captura_controlador('DESPLEGARUSUARIOCAPTURALERMA', $rolCuentaUsuario);

  $data_url = explode("/", $_GET["vistas"]);
}
