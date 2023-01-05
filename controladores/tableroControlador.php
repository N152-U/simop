<?php
require_once dirname(__FILE__) . '/' . '../modelos/tableroModelo.php';
class tableroControlador extends tableroModelo
{

  public function obtener_puntos_tablero_controlador($intervalo_id, $puntos, $fechaHoraInicial, $fechaHoraFinal)
  {
    $puntos_operacion_consulta = tableroModelo::obtener_puntos_tablero_modelo($intervalo_id, $puntos, $fechaHoraInicial, $fechaHoraFinal);

    //Arreglo final con nombre de puntos como llaves con sus respectivos datos de suma y promedio
    $data_util=[];
    $tmp_key="";
    $row_suma_gasto=0;
    $row_promedio_gasto=0;
    while($row=$puntos_operacion_consulta->fetch())
    {
      if($tmp_key!=$row["punto"])
      {

        /*NO ENTRA EN LA PRIMER ITERACION, ENTRA HASTA EL CAMBIO DE PUNTO, SE SACA EL PROMEDIO Y SE SOBREESCRIBEN LAS FECHAS
        QUE SE UTILIZARAN DE MANERA GENERAL (TIENEN QUE SER SIMETRICAS EL TOTAL DE FECHAS TRAIDAS PARA TODOS LOS PUNTOSm DE FORMA
        CONTRARIA SE TOMARA SOLO EL QUE TENGA LA MENOR CANTIDAD DE FECHAS*/
        if($tmp_key!=""){
          //Gasto total promedio
          $data_util[$tmp_key]["gasto_total_promedio"]=$data_util[$tmp_key]["gasto_total_promedio"]/sizeof($data_util[$tmp_key]["data_util_promedios_gasto"]);
        
        }
          
        $tmp_key=$row["punto"];
        $data_util[$tmp_key]["data_util_acumulados_gasto"]=[];
        $data_util[$tmp_key]["data_util_promedios_gasto"]=[];
         
        $data_util[$tmp_key]["gasto_total_acumulado"]=0;
        $data_util[$tmp_key]["gasto_total_promedio"]=0;
        $row_suma_gasto=0;
        $row_promedio_gasto=0;
        
      }
    
      $row_suma_gasto+=(float)$row["suma_gasto"];
      $row_promedio_gasto=(float)$row["promedio_gasto"];
      array_push($data_util[$tmp_key]["data_util_acumulados_gasto"],array("name"=>$row["fecha"],"y"=>$row_suma_gasto));
      array_push($data_util[$tmp_key]["data_util_promedios_gasto"],array("name"=>$row["fecha"],"y"=>$row_promedio_gasto));
      $data_util[$tmp_key]["gasto_total_acumulado"]+=$row_suma_gasto;
      $data_util[$tmp_key]["gasto_total_promedio"]+=$row_promedio_gasto;
    
    }

    
    return $data_util;
  }



}
