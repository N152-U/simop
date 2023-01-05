<?php
require_once dirname(__FILE__) . '/' . '../modelos/graficaRiegoModelo.php';
class graficaRiegoControlador extends graficaRiegoModelo
{

  public function obtener_puntos_tablero_controlador(  $anio)
  {
    $puntos_operacion_consulta = graficaRiegoModelo::obtener_puntos_tablero_modelo( $anio);
 
    //Arreglo final con nombre de puntos como llaves con sus respectivos datos de suma y promedio
    $data_util=[];
    $tmp_key="";
    $row_anio=array();
    $row_promedio_gasto=0;
    while($row=$puntos_operacion_consulta->fetch())
    {
      if($tmp_key!=$row["anio"])
      {
      
        $tmp_key=$row["anio"];
        $data_util[$tmp_key]["gasto_otras_fuentes_programado"]=[];
        $data_util[$tmp_key]["gasto_acueducto_programado"]=[];
        $data_util[$tmp_key]["gasto_otras_fuentes_real"]=[];
        $data_util[$tmp_key]["gasto_acueducto_real"]=[];
         
      }
      $data_util[$tmp_key]["gasto_otras_fuentes_programado"]["name"]="Gasto Otras Fuentes Programado";
      $data_util[$tmp_key]["gasto_acueducto_programado"]["name"]="Gasto Acueducto Programado";
      $data_util[$tmp_key]["gasto_otras_fuentes_real"]["name"]="Gasto Otras Fuentes Real";
      $data_util[$tmp_key]["gasto_acueducto_real"]["name"]="Gasto Acueducto Real";
      array_push($data_util[$tmp_key]["gasto_otras_fuentes_programado"],array("name"=>$row["fecha"],"y"=>$row["gasto_otras_fuentes_programado"]));
      array_push($data_util[$tmp_key]["gasto_acueducto_programado"],array("name"=>$row["fecha"],"y"=>$row["gasto_acueducto_programado"]));
      array_push($data_util[$tmp_key]["gasto_otras_fuentes_real"],array("name"=>$row["fecha"],"y"=>$row["gasto_otras_fuentes_real"]));
      array_push($data_util[$tmp_key]["gasto_acueducto_real"],array("name"=>$row["fecha"],"y"=>$row["gasto_acueducto_real"]));
    
    
    }

    return $data_util;
    
  }

  public function obtener_resumen_riego_controlador($anio){
    $historico_riego_consulta = graficaRiegoModelo::obtener_resumen_riego_modelo($anio);
    
    $historico_riego = array();
    while ($row = $historico_riego_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($historico_riego, $row);
    }
   
    return $historico_riego;
  }

  public function obtener_gasto_diario_riego_controlador($anio){
    $gasto_diario_riego_consulta = graficaRiegoModelo::obtener_gasto_diario_riego_modelo($anio);
    
    $diario_riego = array();
    while ($row = $gasto_diario_riego_consulta->fetch(PDO::FETCH_ASSOC)) {
      array_push($diario_riego, $row);
    }
    return $diario_riego;
  }




}
