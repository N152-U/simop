<?php
    $peticionAjax = TRUE;
    session_start();
    require_once "../nucleo/configGeneral.php";
    require_once "../controladores/histSubControlador.php";

    $hist_sub_instancia = new histSubControlador();
    
    if(isset($_POST['accion']) && ($_POST['accion'] == "CONSULTA")){
        //print_r($_POST);
        $res = $hist_sub_instancia -> obtener_datos_historico_subestaciones_controlador($_POST);
        echo json_encode($res);
      
    }
   
