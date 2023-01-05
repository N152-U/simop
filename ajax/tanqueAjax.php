<?php
$peticionAjax = TRUE;
session_start();
require_once "../nucleo/configGeneral.php";
require_once "../controladores/tanqueControlador.php";

require_once '../libs/FormValidation.php';
require_once '../libs/lang/FormValidationMessages.php';
$form_validation = new \FormValidation\Form_Validation();

$instancia_tanque = new tanqueControlador();

if (isset($_POST['accion']) && ($_POST['accion'] == "GUARDAR")) {


    /*Validaciones*/
    $form_validation->validate(array("tanque_id", 'tanque_id', 'required|numeric', $messages));
    $form_validation->validate(array("fecha_hora_programada", 'fecha_hora_programada', 'required', $messages));
    $form_validation->validate(array("tirante_uno", 'tirante_uno', 'numeric', $messages));
    $form_validation->validate(array("tirante_dos", 'tirante_dos', 'numeric', $messages));
    $form_validation->validate(array("tirante_tres", 'tirante_tres', 'numeric', $messages));
    $form_validation->validate(array("tirante_cuatro", 'tirante_cuatro', 'numeric', $messages));
    $form_validation->validate(array("vertedor", 'vertedor', 'numeric', $messages));
    $form_validation->validate(array("descarga_uno", 'descarga_uno', 'numeric', $messages));
    $form_validation->validate(array("descarga_dos", 'descarga_dos', 'numeric', $messages));
    $form_validation->validate(array("descarga_tres", 'descarga_tres', 'numeric', $messages));
    $form_validation->validate(array("local", 'local', 'numeric', $messages));
    $form_validation->validate(array("presion", 'presion', 'numeric', $messages));
    $form_validation->validate(array("gasto", 'gasto', 'numeric', $messages));
    $form_validation->validate(array("eq1", 'eq1', 'numeric', $messages));
    $form_validation->validate(array("eq2", 'eq2', 'numeric', $messages));
    $form_validation->validate(array("eq3", 'eq3', 'numeric', $messages));
    $form_validation->validate(array("eq4", 'eq4', 'numeric', $messages));
    $form_validation->validate(array("eq5", 'eq5', 'numeric', $messages));
    $form_validation->validate(array("bypass", 'bypass', 'numeric', $messages));
    $form_validation->validate(array("equipos", 'equipos', '>100|<1', $messages));
    $form_validation->validate(array("transmite", 'transmite', 'required|>100|<1|matches/^[a-zA-Z]+( [a-zA-Z0-9_]+)*/', $messages));
    $form_validation->validate(array("novedad", 'novedad', 'required|>300|<1|matches/^[a-zA-Z]+( [a-zA-Z0-9_]+)*/', $messages));
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

        $res = $instancia_tanque->crear_registro_tanque_controlador($_POST);

        header("HTTP/1.1 200 OK");
        echo $res;
    }
} else if (isset($_POST['accion']) && ($_POST['accion'] == "CONSULTA") && isset($_POST["tanque_id"])) {

    // print_r($_POST);
    $res = $instancia_tanque->obtener_fechas_tanque_controlador($_POST["tanque_id"]);
    echo json_encode($res);
} else {
    header("HTTP/1.1 400");
    echo "NO SE ENCONTRO RESPUESTA A SU PETICIÓN";
}
