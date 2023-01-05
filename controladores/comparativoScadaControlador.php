<?php
require_once dirname(__FILE__) . '/' . '../modelos/comparativoScadaModelo.php';
class comparativoScadaControlador extends comparativoScadaModelo
{
    public function consultar_comparativo_scada_controlador()
    {
        $comparativo_scada_consulta_simop = comparativoScadaModelo::consultar_simop_comparativo_scada_modelo();
        $comparativo = array();
        while ($row = $comparativo_scada_consulta_simop->fetch(PDO::FETCH_ASSOC)) {
            $comparativo_scada_consulta_scada = comparativoScadaModelo::consultar_scada_comparativo_scada_modelo($row['gateId']);
            $scada = $comparativo_scada_consulta_scada->fetch(PDO::FETCH_ASSOC);
            $row_2 = array_merge($row, $scada);
            array_push($comparativo, $row_2);
        }
        return $comparativo;
    }

    public function obtener_registros_comparativo_scada_controlador($datos)
    {
        $comparativo_scada_consulta = comparativoScadaModelo::obtener_registros_comparativo_scada_modelo($datos);
        $registros = array();
        while ($row = $comparativo_scada_consulta->fetch(PDO::FETCH_ASSOC)) {
            array_push($registros, $row);
        }
        return $registros;
    }

    public function obtener_propiedades_comparativo_scada_controlador($datos)
    {
        $comparativo_scada_consulta = comparativoScadaModelo::obtener_propiedades_comparativo_scada_modelo($datos);
        $propiedades = array();
        while ($row = $comparativo_scada_consulta->fetch(PDO::FETCH_ASSOC)) {
            array_push($propiedades, $row);
        }
        return $propiedades;
    }

    public function consultar_comparativo_comparativo_scada_controlador($datos)
    {
        //print_r($datos);
        $comparativo_scada_consulta_simop = comparativoScadaModelo::consultar_comparativo_simop_comparativo_scada_modelo($datos['fecha_hora_inicial'], $datos['fecha_hora_final'], $datos['propiedad'], $datos['tabla_comparativa'], $datos['registro_id']);
        $registros_simop = array();
        while ($row = $comparativo_scada_consulta_simop->fetch(PDO::FETCH_ASSOC)) {
            array_push($registros_simop, $row);
        }

        $comparativo_scada_consulta_scada = comparativoScadaModelo::consultar_comparativo_scada_comparativo_scada_modelo(strtotime($datos['fecha_hora_inicial']) * 1000, strtotime($datos['fecha_hora_final']) * 1000, $datos['gateId']);
        $registros_scada = array();
        while ($row = $comparativo_scada_consulta_scada->fetch(PDO::FETCH_ASSOC)) {
            array_push($registros_scada, $row);
        }

        $registros = array(
            "simop" => $registros_simop,
            "scada" => $registros_scada
        );
        return $registros;
    }
}
