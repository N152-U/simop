<?php
    $peticionAjax = TRUE;
    session_start();
    require_once "../nucleo/configGeneral.php";
    require_once "../controladores/reporteSistemasControlador.php";

    $reporteSitemasInstance = new reporteSistemasControlador();
    
    if(isset($_POST['accion'])&&($_POST['accion'] == "CONSULTA")&&isset($_POST["fecha_hora_inicial"])&&isset($_POST["fecha_hora_final"])&&isset($_POST["puntos"])&&isset($_SESSION[GUID]["id"])){
        $res=$reporteSitemasInstance-> obtener_fechas_puntos_reporte_sistemas_controlador($_POST["fecha_hora_inicial"],$_POST["fecha_hora_final"],$_POST["puntos"]);
       

        echo json_encode($res);
      
    }else if(isset($_POST['accion'])&&($_POST['accion'] == "CONSULTA")&&($_POST['tipo'] == "ultima_fecha")){
        $res=$reporteSitemasInstance-> obtener_ultima_fecha_reporte_sistemas_controlador();
       

        echo json_encode($res);
      
    }
    ?>
