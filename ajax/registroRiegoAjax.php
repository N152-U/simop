<?php
$peticionAjax = TRUE;
session_start();
require_once "../nucleo/configGeneral.php";
require_once "../controladores/registroRiegoControlador.php";

require_once '../libs/FormValidation.php';
require_once '../libs/lang/FormValidationMessages.php';
$form_validation = new \FormValidation\Form_Validation();


$capturaInstance = new registroRiegoControlador();

$rol_id = $capturaInstance::decryption($_SESSION[GUID]["rol_id"]);


if (isset($_POST['accion']) && ($_POST['accion'] == "GUARDAR") && $capturaInstance::consulta_permisos_rol("('CREARREGISTRORIEGO')", $rol_id)->rowCount() >= 0) {
    /*Validaciones*/
    $form_validation->validate(array("fecha", 'fecha','required', $messages));
    $form_validation->validate(array("gasto_acueducto_real", 'gasto_acueducto_real', 'required|numeric', $messages));
    $form_validation->validate(array("gasto_otras_fuentes_real", 'gasto_otras_fuentes_real', 'required|numeric', $messages));
   
    // Checar validaciones
    if ($form_validation->is_form_ok() === false) {

        // Custom error markup
        $form_validation->set_error_markup('<li>', '</li>');

        // Showing validation errors
        $errors = $form_validation->show_validation_errors();

        header("HTTP/1.1 400");
        echo json_encode($errors, JSON_NUMERIC_CHECK);
    } else {
        $res = $capturaInstance->editar_registro_riego_controlador($_POST);
        header("HTTP/1.1 200 OK");
        echo $res;
    }
} else if ($rol_id == 1 && isset($_POST['accion']) && ($_POST['accion'] == "CONSULTAMEDICIONES") && $capturaInstance::consulta_permisos_rol("('CAPTURAPUNTOVENTURYII','CAPTURAPUNTOVENTURYIII','CAPTURAPUNTOALZATE','CAPTURAPUNTOATARASQUILLO','CAPTURAPUNTOVENADO','CAPTURAPUNTODOLORES','CAPTURAPUNTOCAIDADELBORRACHO','EDITARREGISTROVENTURYII','EDITARREGISTROVENTURYIII','EDITARREGISTROALZATE','EDITARREGISTROATARASQUILLO','EDITARREGISTROVENADO','EDITARREGISTRODOLORES','EDITARREGISTROCAIDADELBORRACHO')", $rol_id)->rowCount() >= 1) {
    /*Nos permite crear un registro en una fecha posterior
        */

    /*Validaciones*/
    $form_validation->validate(array("year_id", 'year_id', 'required|numeric', $messages));
  

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
        $res = $capturaInstance->obtener_mediciones_programa_riego_controlador($_POST["programa_riego_id"]);
        header("HTTP/1.1 200 OK");
        echo $res;
    }
}
else if ($rol_id == 1 && isset($_POST['accion']) && ($_POST['accion'] == "EDITAR") && $capturaInstance::consulta_permisos_rol("('CAPTURAPUNTOVENTURYII','CAPTURAPUNTOVENTURYIII','CAPTURAPUNTOALZATE','CAPTURAPUNTOATARASQUILLO','CAPTURAPUNTOVENADO','CAPTURAPUNTODOLORES','CAPTURAPUNTOCAIDADELBORRACHO','EDITARREGISTROVENTURYII','EDITARREGISTROVENTURYIII','EDITARREGISTROALZATE','EDITARREGISTROATARASQUILLO','EDITARREGISTROVENADO','EDITARREGISTRODOLORES','EDITARREGISTROCAIDADELBORRACHO')", $rol_id)->rowCount() >= 1) {
    /*Nos permite crear un registro en una fecha posterior
        */

    /*Validaciones*/
    $form_validation->validate(array("registro_id", 'punto_id', 'required|numeric', $messages));
    $form_validation->validate(array("fecha", 'hora_programada', 'required', $messages));
    $form_validation->validate(array("gasto_acueducto_real", 'tirante', 'required|numeric', $messages));
    $form_validation->validate(array("gasto_otras_fuentes_real", 'gasto', 'required|numeric', $messages));
    $form_validation->validate(array("usuario_id", 'presion', 'required|numeric', $messages));
    $form_validation->validate(array("novedades", 'novedades', 'required|>300|<1', $messages));
  

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
        $res = $capturaInstance->editar_registro_riego_controlador($_POST);
        header("HTTP/1.1 200 OK");
        echo $res;
    }
}
else {
    header("HTTP/1.1 400");
    echo "NO SE ENCONTRO RESPUESTA A SU PETICIÓN";
}
