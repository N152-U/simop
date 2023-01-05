<?php
if (!isset($_SESSION[GUID])) { 
    $_SESSION[GUID]["pwd_tries"]=0;
}

if (TRUE) {
    require_once dirname(__FILE__) . '/' . '../modelos/loginModelo.php';
} else {
    require_once "./modelos/loginModelo.php";
}

class loginControlador extends loginModelo
{

    public function getUserIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function iniciar_sesion_login_controlador()
    {
        $usuario = "";
        $pwd = "";
        $rol = "";
        $alerta = [];
       
        //Se llama a la funcion limpiar cadena para asegurarnos que no contiene inyeccion SQL
        $usuario = mainModel::limpiar_cadena($_POST['usuario']);
        $pwd = mainModel::limpiar_cadena($_POST['pwd']);

        if ($pwd === "" && $usuario === "") {

            echo '<script>swal({    
                title: "Atención",
                text: "Ingresa usuario y contraseña",
                type:"info"
                })</script>';
        } else if ($usuario === "") {

            echo '<script>swal({    
                title: "Atención",
                text: "Debes ingresar un usuario",
                type:"info"
                })</script>';
        } else if ($pwd === "") {

            echo '<script>swal({    
                title: "Atención",
                text: "Debes ingresar una contraseña",
                type:"info"
                })</script>';
        } else {
            $loginDatos = [
                "usuario" => $usuario,
                "pwd" => hash("sha512", $pwd)
            ];
            $recaptcha = $_POST["g-recaptcha-response"];
            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $data = array(
                'secret' => '6LcWP-kUAAAAAPfr1K8Een9BjqbTI2rnyQMey6MK',
                'response' => $recaptcha
            );      
            $options = array(
                'http' => array(
                    'header'=>"Content-Type: application/x-www-form-urlencoded",
                    'method' => 'POST',
                    'content' => http_build_query($data)
                )
            );
            $context  = stream_context_create($options);
            $verify = file_get_contents($url, false, $context);
            $captcha_success = json_decode($verify);
            if ($captcha_success->success||$_SESSION[GUID]["pwd_tries"]<2) {
                $consulta_cuenta = loginModelo::iniciar_sesion_login_modelo($loginDatos);
                while ($row = $consulta_cuenta->fetch(PDO::FETCH_ASSOC)) {

                    $_SESSION[GUID] = [
                        "id" => loginModelo::encryption($row['id']),
                        "usuario" => $row['usuario'],
                        "nombre" =>  $row['nombre'],
                        "pwd" =>  $row['pwd'],
                        "rol_id" => loginModelo::encryption($row['rol_id']),
                        "rol" => $row['rol'],
                        "timestamp" => time(),
                        "ip" => self::getUserIpAddr()
                    ];
                   
                    $actualiza_login = loginModelo::actualizar_login_usuario_login_modelo();
                }

                if (!isset($_SESSION[GUID]["usuario"]) || !isset($_SESSION[GUID]["pwd"])) {
                    $_SESSION[GUID]["pwd_tries"]+=1;
                    echo '<script>swal({    
                                title: "Atención",
                                text: "Los datos introducidos son incorrectos",
                                type:"info"
                                })</script>';
                    
                } else if ($actualiza_login == 0) {
    
                    return $urlLocation = '<script> window.location="' . SERVERURL . '"</script>';
                }
            }
            else
            {
                
                echo '<script>
                $("#recaptcha").show();
                
                swal({    
                    title: "Atención",
                    text: "Active el recuadro del CAPTCHA",
                    type:"info"
                    })</script>';
                
            }
           
        }
    }


 

    public function cerrar_sesion_login_controlador()
    {
        //session_start(['name' => 'SDO']);
        $token = mainModel::decryption($_GET['token']);


        unset($_SESSION[GUID]);
        //session_destroy();
        $respuesta = "TRUE";

        return $respuesta;
    }

    public function forzar_cierre_sesion_controlador()
    {
        //session_start();
        unset($_SESSION[GUID]);
        //session_destroy();
        return header("location:" . SERVERURL . "login");
    }
}