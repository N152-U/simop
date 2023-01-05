<?php
$peticionAjax = TRUE;
session_start();
require_once "../nucleo/configGeneral.php";
require_once "../controladores/registroAnioRiegoControlador.php";

require_once '../libs/FormValidation.php';
require_once '../libs/lang/FormValidationMessages.php';
$form_validation = new \FormValidation\Form_Validation();


$capturaInstance = new registroAnioRiegoControlador();

$rol_id = $capturaInstance::decryption($_SESSION[GUID]["rol_id"]);
$usuario_id = $capturaInstance::decryption($_SESSION[GUID]["id"]);


if (isset($_POST['accion']) && ($_POST['accion'] == "GUARDAR") && $capturaInstance::consulta_permisos_rol("('')", $rol_id)->rowCount() >= 0) {
    /*Validaciones*/
    $form_validation->validate(array("anio", 'anio', 'required|numeric','required', $messages));
    $form_validation->validate(array("meta_volumen_acueducto", 'meta_volumen_acueducto', 'required|numeric', $messages));
    $form_validation->validate(array("meta_superficie_acueducto", 'meta_superficie_acueducto', 'required|numeric', $messages));
    $form_validation->validate(array("meta_volumen_otras_fuentes", 'meta_volumen_otras_fuentes', 'required|numeric', $messages));
    $form_validation->validate(array("meta_superficie_otras_fuentes", 'meta_superficie_otras_fuentes', 'required|numeric', $messages));
   
    // Checar validaciones
    if ($form_validation->is_form_ok() === false) {

        // Custom error markup
        $form_validation->set_error_markup('<li>', '</li>');

        // Showing validation errors
        $errors = $form_validation->show_validation_errors();

        header("HTTP/1.1 400");
        echo json_encode($errors, JSON_NUMERIC_CHECK);
    } else {
        $res = $capturaInstance->crear_registros_riego_anio_captura_controlador($_POST,$usuario_id);
        header("HTTP/1.1 200 OK");
        echo $res;
    }
} 
else {
    header("HTTP/1.1 400");
    echo "NO SE ENCONTRO RESPUESTA A SU PETICIÓN";
}
