<?php
session_start();
require_once "../nucleo/configGeneral.php";
$time=time();
if(isset($_POST["accion"])&&$_POST["accion"]=="REFRESCAR")
{
    $_SESSION[GUID]['timestamp']=time();
}elseif(isset($_POST["accion"])&&$_POST["accion"]=="BUSCAR")
{
    if(isset($_SESSION[GUID]['timestamp'])&&($time - $_SESSION[GUID]['timestamp'] >= TIMESESSION)) { //subtract new timestamp from the old one
        echo json_encode(array('access' => '0'));
    } else{
    
        echo json_encode(array('access' => '1'));
    }

}elseif(isset($_POST["accion"])&&$_POST["accion"]=="CERRAR"){
    if(isset($_SESSION[GUID]['timestamp'])&&($time - $_SESSION[GUID]['timestamp'] >= TIMESESSION)) { //subtract new timestamp from the old one
        unset($_SESSION[GUID]);
        //session_destroy();
        echo json_encode(array('access' => '0'));
    } else{
    
        echo json_encode(array('access' => '1'));
    }
}





?>