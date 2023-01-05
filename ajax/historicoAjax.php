<?php
    $peticionAjax = TRUE;
    session_start();
    require_once "../nucleo/configGeneral.php";
    require_once "../controladores/historicoControlador.php";

    $capturaInstance = new historicoControlador();
    
    if(isset($_POST['accion'])&&($_POST['accion'] == "CONSULTA")&&isset($_POST["fecha_hora_inicial"])&&isset($_POST["fecha_hora_final"])&&isset($_POST["punto_id"])&&isset($_SESSION[GUID]["id"])){
        
        $res=$capturaInstance-> obtener_fechas_punto_historico_controlador($_POST["fecha_hora_inicial"],$_POST["fecha_hora_final"],$_POST["punto_id"]);
        echo json_encode($res);
      
    }
   
