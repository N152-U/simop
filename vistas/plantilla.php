<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title><?php echo COMPANY; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?php echo SERVERURL; ?>/vistas/assets/images/favicon-32x32.png">

    <link rel="stylesheet" type='text/css' href="http://187.216.198.249:8020/cdn/css/libs/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="http://187.216.198.249:8020/cdn/css/libs/mapsjs-ui.css">
    <!-- <link rel="stylesheet" type='text/css' href="http://187.216.198.249:8020/cdn/css/libs/jquery.flexdatalist.min.css" /> -->
    <link rel="stylesheet" type='text/css' href="http://187.216.198.249:8020/cdn/css/libs/icon.css">

    <link rel="stylesheet" type='text/css' href="http://187.216.198.249:8020/cdn/css/libs/all.min.css">
    <link rel="stylesheet" type='text/css' href="http://187.216.198.249:8020/cdn/css/libs/brands.min.css">
    <link rel="stylesheet" type='text/css' href="http://187.216.198.249:8020/cdn/css/libs/duotone.min.css">
    <link rel="stylesheet" type='text/css' href="http://187.216.198.249:8020/cdn/css/libs/light.min.css">
    <link rel="stylesheet" type='text/css' href="http://187.216.198.249:8020/cdn/css/libs/regular.min.css">
    <link rel="stylesheet" type='text/css' href="http://187.216.198.249:8020/cdn/css/libs/solid.min.css">
    <link rel="stylesheet" type='text/css' href="http://187.216.198.249:8020/cdn/css/libs/svg-with-js.min.css">
    <link rel="stylesheet" type='text/css' href="http://187.216.198.249:8020/cdn/css/libs/v4-shims.min.css">
    <link rel="stylesheet" type='text/css' href="http://187.216.198.249:8020/cdn/css/libs/fontawesome.min.css">
    <!-- <link rel="stylesheet" href="http://187.216.198.249:8020/cdn/css/libs/free.min.css"> -->
    <link rel="stylesheet" type='text/css' href="http://187.216.198.249:8020/cdn/css/libs/materialize.min.css">
    <!-- <link rel="stylesheet" href="http://187.216.198.249:8020/cdn/css/libs/font-awesome.min.css"> -->

    <link rel="stylesheet" type="text/css" href="http://187.216.198.249:8020/cdn/css/libs/AdminLTE.min.css" />
    <link rel="stylesheet" type="text/css" href="http://187.216.198.249:8020/cdn/css/libs/skins/_all-skins.min.css" />

    <link rel="stylesheet" type="text/css" href="http://187.216.198.249:8020/cdn/css/libs/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="http://187.216.198.249:8020/cdn/css/libs/nouislider.css" />
    <link rel="stylesheet" type='text/css' href="http://187.216.198.249:8020/cdn/css/libs/sweetalert2.css" />
    <link rel="stylesheet" type="text/css" href="http://187.216.198.249:8020/cdn/css/libs/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="http://187.216.198.249:8020/cdn/css/libs/select2-materialize.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="http://187.216.198.249:8020/cdn/css/libs/introjs.min.css" rel="stylesheet" />
    <link rel="stylesheet" type='text/css' href="http://187.216.198.249:8020/cdn/css/libs/introjs.min.css">
    <link rel="stylesheet" type='text/css' href="<?php echo SERVERURL; ?>vistas/assets/css/default.css?v=<?php echo VERSION; ?>">
    <link rel="stylesheet" type='text/css' href="<?php echo SERVERURL; ?>vistas/assets/css/login.css?v=<?php echo VERSION; ?>">
    <link rel="stylesheet" type='text/css' href="http://187.216.198.249:8020/cdn/css/libs/leaflet.css?v=<?php echo VERSION; ?>">
    <link rel="stylesheet" type='text/css' href="http://187.216.198.249:8020/cdn/css/libs/daterangepicker.css">

    <link rel="stylesheet" type='text/css' href="<?php echo SERVERURL; ?>vistas/assets/css/404.css">
    <!-- <link rel="stylesheet" type='text/css' href="<?php echo SERVERURL; ?>vistas/assets/css/navbar.css"> -->
    <link rel="stylesheet" type='text/css' href="<?php echo SERVERURL; ?>vistas/assets/css/edicionContenido.css">
    <link rel="stylesheet" type='text/css' href="<?php echo SERVERURL; ?>vistas/assets/css/main.css">
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->


    <!--Aqui empieza el javascript-->
    <script>
        var serverurl = "<?php echo SERVERURL; ?>";
        var timesession = "<?php echo TIMESESSION; ?>";
        var debug = false;
        const user_sid='<?php print $_SESSION[GUID]['id']; ?>';
        const ws_server='<?php echo WS_SERVER; ?>';
    </script>




    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/adminlte.min.js"></script>

    <!-- <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/mapsjs-core.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/mapsjs-service.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/mapsjs-ui.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/mapsjs-mapevents.js"></script> -->


    <!-- <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/jquery.flexdatalist.min.js"></script> -->

    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/materialize.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/datatables.min.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/nouislider.min.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/sweetalert2.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/select2.min.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/Chart.min.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/intro.min.js"></script>
    <!-- <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/navbar.js"></script> -->
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/moment.min.js"></script>
    <!--<script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/knockout-3.5.1.js"></script>-->

    <script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/init.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/daterangepicker-3.0.5.js"></script>
    <script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/jspdf_1.5.3.min.js"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/dompurify/2.2.2/purify.min.js" integrity="sha512-T6jx0SL5artICbQxeQCg3iToWGEuWM6P2XjNxP1vMI6fNtgIb3dnVD5gpd/pkQKoMfi1ygq5ezv/Z2VB3lLGtw==" crossorigin="anonymous"></script>

   
</head>

<body class="skin-black-light sidebar-collapse sidebar-mini" style="height: auto; min-height: 100%;">
    <div class="wrapper" style="height: auto; min-height: 100%;">
        <?php
        $peticionAjax = false;
        require_once "./controladores/vistasControlador.php";
        $vc = new vistasControlador;
        $respuesta = $vc->obtener_vistas_controlador();

        if ($respuesta["vista"] == 'login' || $respuesta["vista"] == '404') :
            if ($respuesta["vista"] == "login" && (!isset($_SESSION[GUID]['pwd']) || !isset($_SESSION[GUID]['usuario']))) {
                require_once "./vistas/templates/login.php";
            } else if ($respuesta["vista"] == "login" && (isset($_SESSION[GUID]['pwd']) || isset($_SESSION[GUID]['usuario']))) {

                echo '<script>
                swal({
                    title: "Bienvenido!",
                    text: "' . $_SESSION[GUID]["nombre"] . '",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onOpen: () => {
    
                        swal.showLoading();
                        window.location.href="' . SERVERURL . 'home";
                    }});
               
                  </script>';
                //echo "<script> window.location.href=" . SERVERURL . "home'</script>";

            } else {
                require_once "./vistas/templates/404.php";
            }
        else :
            require_once "./controladores/loginControlador.php";
            $lc = new loginControlador();
            if (!isset($_SESSION[GUID]['pwd']) || !isset($_SESSION[GUID]['usuario'])) {
                $lc->forzar_cierre_sesion_controlador();
            }

        ?>


            <!-- Content page -->
            <?php require_once "./vistas/modulos/navbar.php" ?>
            <div class="content-wrapper" style="min-height: 939px;">
                <?php

                require_once "./vistas/templates/" . $respuesta["vista"] . ".php";

                //  echo $_SESSION[GUID]['timestamp'];
                echo '  <a id="regresa_arriba" onclick="scrollToTop()" class="z-depth-2" href="#!"style="z-index:999;position:fixed;bottom:2vh; background-color:rgba(255, 255, 255,1); border-radius: 6px;right: 0px;"><i class="material-icons medium black-text">keyboard_arrow_up</i></a>';



                ?>
                <!--  <iframe id="telegram_preview" style="border:0px;height:500px;width:500px;margin:5px;top: 20%;right: 0;float: right;position: fixed;box-shadow: 0 0 16px 3px rgba(0,0,0,.2);" src="http://xn--r1a.website/s/extractora_plubs"></iframe> -->
            </div>
            <?php

            require_once "./vistas/modulos/logoutScript.php";
            require_once "./vistas/modulos/footer.php";

            ?>

        <?php
        endif;
        ?>

    </div>


</body>

<script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/assets/js/formsvalidations.js?v=<?php echo VERSION; ?>"></script>
<script>
    function sanitize(elem) {
        //console.log(elem)
        elem.value = DOMPurify.sanitize(elem.value)
    }

    function withSelectionRange(e) {

        const elem = e;
        // get start position and end position, in case of an selection these values
        // will be different
        const startPos = elem.selectionStart;
        const endPos = elem.selectionEnd;


        elem.value = elem.value.toUpperCase();
        elem.setSelectionRange(startPos, endPos);
        //elem.value = elem.value.trim();
        sanitize(elem)
    }
</script>

</html>