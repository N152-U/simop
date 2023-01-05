<?php
    $peticionAjax = TRUE;
    session_start();
    require_once "../nucleo/configGeneral.php";
    require_once "../controladores/histTanqueControlador.php";

    $instancia_historico_tanque = new histTanqueControlador();
    
    if ( isset($_POST['accion']) && ($_POST['accion'] == "CONSULTA") ){
        //print_r($_POST);
        $res = $instancia_historico_tanque -> obtener_datos_historico_tanques_controlador($_POST);
        echo json_encode($res);
      
    }
   
