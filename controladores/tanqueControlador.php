<?php
require_once dirname(__FILE__) . '/' . '../modelos/tanqueModelo.php';
class tanqueControlador extends tanqueModelo
{


    public function obtener_tanques_controlador()
    {

        $promedios_puntos_consulta = tanqueModelo::obtener_tanques_modelo();
        $tablero = array();
        while ($row = $promedios_puntos_consulta->fetch(PDO::FETCH_ASSOC)) {
            array_push($tablero, $row);
        }
        return $tablero;
    }

    public function crear_registro_tanque_controlador($datos)
    {

        //print_r($datos);
        $res = -1;

        $crear_registro = tanqueModelo::crear_registro_tanque_modelo($datos);

        if ($crear_registro == 0) {
            $res = 0;
        }

        return $res;
    }

    public function obtener_fechas_tanque_controlador($tanque_id)
    {

        $fecha_hora_ayer    = date('Y-m-d', strtotime("-24 hours"));
        $fecha_hora_hoy     = date("Y-m-d H:00", strtotime("+1 hours"));
        $inicio_combo       = new DateTime($fecha_hora_ayer);
        $fin_combo          = new DateTime($fecha_hora_hoy);
        $intervalo          = new DateInterval('PT120M');
        $periodo            = new DatePeriod($inicio_combo, $intervalo, $fin_combo);
        $horas              = array();

        foreach ($periodo as $hora) {
            array_push($horas, $hora->format('Y-m-d H:i'));
        }

        $fechas_registradas = tanqueModelo::obtener_fechas_tanque_modelo($tanque_id, $fecha_hora_ayer, $fecha_hora_hoy);
        $fechas_r = array();

        while ($row = $fechas_registradas->fetch(PDO::FETCH_ASSOC)) {
            $date = new DateTime($row["fecha_hora_programada"]);
            $hora_programada = date_format($date, 'Y-m-d H:i');

            if (array_search($hora_programada, $horas) >= -1) {

                unset($horas[array_search($hora_programada, $horas)]);
            }
            array_push($fechas_r, $row);
        }

        $fechas_concentrado = array("fechas_registradas" => $fechas_r, "fechas_restantes" => $horas);
        return $fechas_concentrado;
    }

    public function obtener_catalogo_despliegue_usuarios_tanque_controlador($permiso, $rolCuentaUsuario)
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
            array_push($usuarios, $usuarioActual);
        }

        while ($row = $usuarios_consulta->fetch(PDO::FETCH_ASSOC)) {
            array_push($usuarios, $row);
        }
        return $usuarios;
    }
    
}

$data_url = explode("/", $_GET["vistas"]);

if (sizeof($data_url) == 1) {

    $data_url = explode("/", $_GET["vistas"]);

    $instancia = new tanqueControlador();
    $rolCuentaUsuario = $_SESSION[GUID]["rol_id"];
    $contenedor_tanques = $instancia->obtener_tanques_controlador();
    $contenedorUsuarios = $instancia->obtener_catalogo_despliegue_usuarios_tanque_controlador('DESPLEGARUSUARIOCAPTURATANQUES', $rolCuentaUsuario);

    //print_r($contenedor_tanques);


}
