<?php
$peticionAjax = TRUE;
session_start();
require_once "../nucleo/configGeneral.php";
require_once "../controladores/subestacionesControlador.php";

require_once '../libs/FormValidation.php';
require_once '../libs/lang/FormValidationMessages.php';
$form_validation = new \FormValidation\Form_Validation();


$subestacion_instancia = new subestacionesControlador();

if (isset($_POST['accion']) && ($_POST['accion'] == "GUARDAR")) {


    /*Nos permite editar un registro existente,
        es necesario proporcionar los campos listados
        */

    /*Validaciones*/
    $form_validation->validate(array("subestacion_id", 'subestacion_id', 'required|numeric', $messages));
    $form_validation->validate(array("amperaje", 'punto_id', 'required|numeric', $messages));
    $form_validation->validate(array("fecha_hora_programada", 'fecha_hora_programada', 'required', $messages));

    $form_validation->validate(array("sub_novedades", 'sub_novedades', 'required|>100|<1|matches/^[a-zA-Z]+( [a-zA-Z0-9_]+)*/', $messages));
    $form_validation->validate(array("transmite", 'transmite', 'required|>100|<1|matches/^[a-zA-Z]+( [a-zA-Z0-9_]+)*/', $messages));
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

        $res = $subestacion_instancia->crear_sub_electrica_controlador($_POST);

        header("HTTP/1.1 200 OK");
        echo $res;
    }
} else if (isset($_POST['accion']) && ($_POST['accion'] == "CONSULTA") && isset($_POST["subestacion_id"])) {

    //print_r($_POST);
    $res = $subestacion_instancia->obtener_fechas_subestacion_controlador($_POST["subestacion_id"]);
    echo json_encode($res);

    // var_dump($res);

} else {
    header("HTTP/1.1 400");
    echo "NO SE ENCONTRO RESPUESTA A SU PETICIÓN";
}
