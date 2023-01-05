<?php
require_once dirname(__FILE__) . '/' . '../modelos/CapturaLumbreraModelo.php';
class CapturaLumbreraControlador extends CapturaLumbreraModelo
{


  public function obtener_lumbreras_captura_lumbrera_controlador()
  {
  /*   $fecha_hora_inicial= date('Y-m-d H:00', strtotime('-'.PERIODO_LUMBRERAS.' hours'));
    $fecha_hora_final= date('Y-m-d H:00'); */
    $lumbreras_consulta = mainModel::obtener_lumbreras();
    $lumbreras = array();
  
    while ($row = $lumbreras_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($lumbreras, $row);
    }

   /*  print_r($lumbreras); */
    return $lumbreras;
  }


  public function crear_registros_captura_lumbrera_controlador($capturadatos)
  {
    $res = -1;


    $inserta_registros = CapturaLumbreraModelo::crear_registros_captura_lumbrera_modelo($capturadatos);
    if ($inserta_registros == 0) {
      $res = 0;
    }


    return $res;
  }


  public function editar_registros_captura_controlador($capturadatos)
  {
    $res = -1;


    $edicion_registros = CapturaLumbreraModelo::editar_registros_captura_lumbrera_modelo($capturadatos);
    if ($edicion_registros == 0) {
      $res = 0;
    }


    return $res;
  }






  public function obtener_fechas_lumbrera_captura_lumbrera_controlador($lumbrera_id,  $fecha_hora_inicial = null, $fecha_hora_final = null)
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

    $consulta_fechas_lumbrera = mainModel::obtener_lumbrera_fechas_restantes($lumbrera_id, date_format($fecha_hora_inicial, 'Y-m-d H:00'), date_format($fecha_hora_final, 'Y-m-d H:00'));
    $fechas_lumbreras = array();

    //Quitamos las horas que ya fueron registradas
    while ($row = $consulta_fechas_lumbrera->fetch(PDO::FETCH_ASSOC)) {
      $date = new DateTime($row["hora_programada"]);
      $hora_programada = date_format($date, 'Y-m-d H:i');




      if (array_search($hora_programada, $horas) >= -1) {

        unset($horas[array_search($hora_programada, $horas)]);
      }
      array_push($fechas_lumbreras, $row);
    }

    $fechas_registradas = array();
    $temp_registro_id = "";
    foreach ($fechas_lumbreras as $index => $row) {
      // Inicia la Iteración
      if ($index == 0) {
        array_push($fechas_registradas, array("registro_id" => $fechas_lumbreras[$index]["registro_id"], "lumbrera_id" => $row["lumbrera_id"], "usuario_id" => $row["usuario_id"], "lumbrera" => $row["lumbrera"], "tirante" => $row["tirante"], "compuertas" => $row["compuertas"], "gasto" => $row["gasto"], "hora_programada" => $row["hora_programada"], "transmitio" => $row["transmitio"], "novedades" => $row["novedades"]));
        $temp_registro_id = $row["registro_id"];
        // Cuando el registro sea diferente
      } else if ($temp_registro_id != $fechas_lumbreras[$index]["registro_id"]) {
        array_push($fechas_registradas, array("registro_id" => $fechas_lumbreras[$index]["registro_id"], "lumbrera_id" => $row["lumbrera_id"], "usuario_id" => $row["usuario_id"], "lumbrera" => $row["lumbrera"], "tirante" => $row["tirante"], "compuertas" => $row["compuertas"], "gasto" => $row["gasto"], "hora_programada" => $row["hora_programada"], "transmitio" => $row["transmitio"], "novedades" => $row["novedades"]));
        $temp_registro_id = $row["registro_id"];
      }
     
    }


    $horas = array_values($horas);

    $fechas_concentrado = array("fechas_registradas" => $fechas_registradas, "fechas_restantes" => $horas);

    return $fechas_concentrado;
  }


  public function obtener_validacion_rango_tirante_captura_controlador($lumbrera_id)
  {

    $nombres_lumbreras_consulta = CapturaLumbreraModelo::obtener_validacion_rango_tirante_captura_modelo($lumbrera_id);
    $nombres = array();
    while ($row = $nombres_lumbreras_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($nombres, $row);
    }
    return $nombres;
  }

  public function obtener_catalogo_despliegue_usuarios_captura_lumbrera_controlador($permiso, $rolCuentaUsuario)
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

  $instancia = new CapturaLumbreraControlador();
  $rolCuentaUsuario = $_SESSION[GUID]["rol_id"];
  $contenedorlumbreras = $instancia->obtener_lumbreras_captura_lumbrera_controlador();
  $contenedorUsuarios = $instancia->obtener_catalogo_despliegue_usuarios_captura_lumbrera_controlador('DESPLEGARUSUARIOCAPTURA_LUMBRERAS', $rolCuentaUsuario);

 
 // $contenedorUsuarios = $instancia->obtener_catalogo_despliegue_usuarios_captura_controlador('DESPLEGARUSUARIOCAPTURALERMA', $rolCuentaUsuario);

  $data_url = explode("/", $_GET["vistas"]);
}
