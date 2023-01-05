<?php
$peticionAjax = TRUE;
session_start();
require_once "../nucleo/configGeneral.php";
require_once "../controladores/controlRiegoControlador.php";

require_once '../libs/FormValidation.php';
require_once '../libs/lang/FormValidationMessages.php';
$form_validation = new \FormValidation\Form_Validation();


$capturaInstance = new controlRiegoControlador();

$rol_id = $capturaInstance::decryption($_SESSION[GUID]["rol_id"]);


if (isset($_POST['accion']) && ($_POST['accion'] == "GUARDAR") && $capturaInstance::consulta_permisos_rol("('CAPTURAPUNTOVENTURYII','CAPTURAPUNTOVENTURYIII','CAPTURAPUNTOALZATE','CAPTURAPUNTOATARASQUILLO','CAPTURAPUNTOVENADO','CAPTURAPUNTODOLORES','CAPTURAPUNTOCAIDADELBORRACHO')", $rol_id)->rowCount() >= 1) {



    /*Validaciones*/
    $form_validation->validate(array("punto_id", 'punto_id', 'required|numeric', $messages));
    $form_validation->validate(array("hora_programada", 'hora_programada', 'required', $messages));
    $form_validation->validate(array("tirante", 'tirante', 'required|numeric', $messages));
    $form_validation->validate(array("gasto", 'gasto', 'required|numeric', $messages));
    $form_validation->validate(array("presion", 'presion', 'required|numeric', $messages));
    $form_validation->validate(array("novedades", 'novedades', 'required|>300|<1|matches/^[a-zA-Z]+( [a-zA-Z0-9_]+)*/', $messages));
    $form_validation->validate(array("transmitio", 'transmitio', 'required|>100|<1|matches/^[a-zA-Z]+( [a-zA-Z0-9_]+)*/', $messages));
    $form_validation->validate(array("usuario_id", 'usuario_id', 'required|numeric', $messages));

    // Checar validaciones
    if ($form_validation->is_form_ok() === false) {

        // Custom error markup
        $form_validation->set_error_markup('<li>', '</li>');

        // Showing validation errors
        $errors = $form_validation->show_validation_errors();
        /*
         for ($i = 0; $i < count($errors); $i++) {
 
             echo "alert('".$errors[$i]."')";
         }
         */
        header("HTTP/1.1 400");
        echo json_encode($errors, JSON_NUMERIC_CHECK);
    } else {
        $res = $capturaInstance->crear_registros_captura_controlador($_POST);
        header("HTTP/1.1 200 OK");
        echo $res;
    }
} else if (isset($_POST['accion']) && ($_POST['accion'] == "CONSULTA") && isset($_POST["punto_id"]) && isset($_SESSION[GUID]["id"]) && $capturaInstance::consulta_permisos_rol("('CAPTURAPUNTOVENTURYII','CAPTURAPUNTOVENTURYIII','CAPTURAPUNTOALZATE','CAPTURAPUNTOATARASQUILLO','CAPTURAPUNTOVENADO','CAPTURAPUNTODOLORES','CAPTURAPUNTOCAIDADELBORRACHO')", $rol_id)->rowCount() >= 1) {
    $res = $capturaInstance->obtener_fechas_punto_captura_controlador($_POST["punto_id"], null, null);

    echo json_encode($res);
} else if (isset($_POST['accion']) && ($_POST['accion'] == "VALIDACION") && isset($_POST["punto_id"]) && isset($_SESSION[GUID]["id"])) {
    $res = $capturaInstance->obtener_validacion_rango_tirante_captura_controlador($_POST["punto_id"]);

    echo json_encode($res);
} else if (isset($_POST['accion']) && ($_POST['accion'] == "CONSULTAFECHASEDICION") && isset($_POST["punto_id"]) && isset($_POST["fecha_hora_inicial"]) && isset($_POST["fecha_hora_final"]) && isset($_SESSION[GUID]["id"])) {

    $res = $capturaInstance->obtener_fechas_punto_captura_controlador($_POST["punto_id"], $_POST["fecha_hora_inicial"], $_POST["fecha_hora_final"]);

    echo json_encode($res);
} else if ( $rol_id == 1 && isset($_POST['accion']) && ($_POST['accion'] == "EDITAR") && (isset($_POST['registro_id'])) && $capturaInstance::consulta_permisos_rol("('EDITARREGISTROVENTURYII','EDITARREGISTROVENTURYIII','EDITARREGISTROALZATE','EDITARREGISTROATARASQUILLO','EDITARREGISTROVENADO','EDITARREGISTRODOLORES','EDITARREGISTROCAIDADELBORRACHO')", $rol_id)->rowCount() >= 1) {
    /*Nos permite editar un registro existente,
        es necesario proporcionar los campos listados
        */

    /*Validaciones*/
    $form_validation->validate(array("registro_id", 'registro_id', 'required|numeric', $messages));
    $form_validation->validate(array("punto_id", 'punto_id', 'required|numeric', $messages));
    $form_validation->validate(array("hora_programada", 'hora_programada', 'required', $messages));
    $form_validation->validate(array("tirante", 'tirante', 'required|numeric', $messages));
    $form_validation->validate(array("gasto", 'gasto', 'required|numeric', $messages));
    $form_validation->validate(array("presion", 'presion', 'required|numeric', $messages));
    $form_validation->validate(array("novedades", 'novedades', 'required|>300|<1', $messages));
    $form_validation->validate(array("transmitio", 'transmitio', 'required|>100|<1|matches/^[a-zA-Z]+( [a-zA-Z0-9_]+)*/', $messages));
    $form_validation->validate(array("usuario_id", 'usuario_id', 'required|numeric', $messages));

    // Checar validaciones
    if ($form_validation->is_form_ok() === false) {

        // Custom error markup
        $form_validation->set_error_markup('<li>', '</li>');

        // Showing validation errors
        $errors = $form_validation->show_validation_errors();
        /*
        for ($i = 0; $i < count($errors); $i++) {

            echo "alert('".$errors[$i]."')";
        }
        */
        header("HTTP/1.1 400");
        echo json_encode($errors, JSON_NUMERIC_CHECK);
    } else {
        $res = $capturaInstance->editar_registros_captura_controlador($_POST);
        header("HTTP/1.1 200 OK");
        echo $res;
    }
} else if ($rol_id == 1 && isset($_POST['accion']) && ($_POST['accion'] == "EDITAR") && $capturaInstance::consulta_permisos_rol("('CAPTURAPUNTOVENTURYII','CAPTURAPUNTOVENTURYIII','CAPTURAPUNTOALZATE','CAPTURAPUNTOATARASQUILLO','CAPTURAPUNTOVENADO','CAPTURAPUNTODOLORES','CAPTURAPUNTOCAIDADELBORRACHO','EDITARREGISTROVENTURYII','EDITARREGISTROVENTURYIII','EDITARREGISTROALZATE','EDITARREGISTROATARASQUILLO','EDITARREGISTROVENADO','EDITARREGISTRODOLORES','EDITARREGISTROCAIDADELBORRACHO')", $rol_id)->rowCount() >= 1) {
    /*Nos permite crear un registro en una fecha posterior
        */

    /*Validaciones*/
    $form_validation->validate(array("punto_id", 'punto_id', 'required|numeric', $messages));
    $form_validation->validate(array("hora_programada", 'hora_programada', 'required', $messages));
    $form_validation->validate(array("tirante", 'tirante', 'required|numeric', $messages));
    $form_validation->validate(array("gasto", 'gasto', 'required|numeric', $messages));
    $form_validation->validate(array("presion", 'presion', 'required|numeric', $messages));
    $form_validation->validate(array("novedades", 'novedades', 'required|>300|<1', $messages));
    $form_validation->validate(array("transmitio", 'transmitio', 'required|>100|<1|matches/^[a-zA-Z]+( [a-zA-Z0-9_]+)*/', $messages));
    $form_validation->validate(array("usuario_id", 'usuario_id', 'required|numeric', $messages));

    // Checar validaciones
    if ($form_validation->is_form_ok() === false) {

        // Custom error markup
        $form_validation->set_error_markup('<li>', '</li>');

        // Showing validation errors
        $errors = $form_validation->show_validation_errors();
        /*
        for ($i = 0; $i < count($errors); $i++) {

            echo "alert('".$errors[$i]."')";
        }
        */
        header("HTTP/1.1 400");
        echo json_encode($errors, JSON_NUMERIC_CHECK);
    } else {
        $res = $capturaInstance->crear_registros_captura_controlador($_POST);
        header("HTTP/1.1 200 OK");
        echo $res;
    }
} else {
    header("HTTP/1.1 400");
    echo "NO SE ENCONTRO RESPUESTA A SU PETICIÓN";
}
