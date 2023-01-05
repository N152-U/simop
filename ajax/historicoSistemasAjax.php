<?php
    $peticionAjax = TRUE;
    session_start();
    require_once "../nucleo/configGeneral.php";
    require_once "../controladores/historicoSistemasControlador.php";

    $capturaInstance = new historicoSistemasControlador();
    
    if(isset($_POST['accion']) && ($_POST['accion'] == "CONSULTAR")  && isset($_SESSION[GUID]["id"])){
        $res = $capturaInstance-> obtener_historico_historico_sistemas_controlador($_POST);      
        echo json_encode($res);
    // print_r($res); 
    }

?>