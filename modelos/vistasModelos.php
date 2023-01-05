<?php
require_once dirname(__FILE__) . '/' . '../nucleo/mainModel.php';
class vistasModelo
{
    protected function obtener_vistas_modelo($vistas)
    {

        $listaBlanca = [
            "home" => array("vista" => "home", "titulo" => "Ubicación de los Puntos de Monitoreo", "vista_regreso" => "", "vista_regreso_params" => 0, "permisos_requeridos"=>""),
            "usuarios"=>array("vista"=>"usuarios","titulo"=>"Usuarios","vista_regreso"=>"","vista_regreso_params"=>0,"permisos_requeridos"=>"('LEERUSUARIO')"),
            "usuario"=>array("vista"=>"usuario","titulo"=>"Usuario","vista_regreso"=>"usuarios","vista_regreso_params"=>0,"permisos_requeridos"=>"('LEERUSUARIO','CREARUSUARIO','EDITARUSUARIO')"),
            "roles"=>array("vista"=>"roles","titulo"=>"Gestión de Roles","vista_regreso"=>"","vista_regreso_params"=>0,"permisos_requeridos"=>"('LEERROL')"),
            "rol"=>array("vista"=>"rol","titulo"=>"Rol","vista_regreso"=>"roles","vista_regreso_params"=>0,"permisos_requeridos"=>"('LEERROL','CREARROL','EDITARROL')"),

            "tablero" => array("vista" => "tablero", "titulo" => "Tablero", "vista_regreso" => "home", "vista_regreso_params" => 0, "permisos_requeridos"=>""),
            "comparativoScada" => array("vista" => "comparativoScada", "titulo" => "Comparativo Bitacora contra Medición", "vista_regreso" => "", "vista_regreso_params" => 0, "permisos_requeridos"=>"('COMPARATIVOSCADA')"),
            "historico" => array("vista" => "historico", "titulo" => "Historico", "vista_regreso" => "home", "vista_regreso_params" => 0, "permisos_requeridos"=> "('HISTORICOPUNTOVENTURYII','HISTORICOPUNTOVENTURYIII','HISTORICOPUNTOALZATE','HISTORICOPUNTOATARASQUILLO','HISTORICOPUNTOVENADO','HISTORICOPUNTODOLORES','HISTORICOPUNTOBORRACHO')"),
            "captura" => array("vista" => "captura", "titulo" => "Captura", "vista_regreso" => "tablero", "vista_regreso_params" => 0, "permisos_requeridos"=>"('CAPTURAPUNTOVENTURYII','CAPTURAPUNTOVENTURYIII','CAPTURAPUNTOALZATE','CAPTURAPUNTOATARASQUILLO','CAPTURAPUNTOVENADO','CAPTURAPUNTODOLORES','CAPTURAPUNTOCAIDADELBORRACHO')"),
            "capturaLumbrera" => array("vista" => "capturaLumbrera", "titulo" => "Captura Drenaje", "vista_regreso" => "home", "vista_regreso_params" => 0, "permisos_requeridos"=>"('CAPTURA_LUMBRERA0')"),
            "contacto" => array("vista" => "contacto", "titulo" => "Contacto", "vista_regreso" => "", "vista_regreso_params" => 0, "permisos_requeridos"=>""),
            "notas" => array("vista" => "notas", "titulo" => "Notas", "vista_regreso" => "reporte", "vista_regreso_params" => 0, "permisos_requeridos"=>"('LEERNOTA')"),
            "novedades" => array("vista" => "novedades", "titulo" => "Novedades", "vista_regreso" => "reporte", "vista_regreso_params" => 0, "permisos_requeridos"=>"('LEERNOVEDAD')"),
            "reportes" => array("vista" => "reportes", "titulo" => "Reportes de Radio", "vista_regreso" => "home", "vista_regreso_params" => 0, "permisos_requeridos"=>"('LEERREPORTE')"),
            "reporte" => array("vista" => "reporte", "titulo" => "Reporte de Radio", "vista_regreso" => "reportes", "vista_regreso_params" => 0, "permisos_requeridos"=>"('CREARREPORTE','EDITARREPORTE','ELIMINARREPORTE')"),
            "detallesReporte" => array("vista" => "detallesReporte", "titulo" => "Detalles del Reporte", "vista_regreso" => "reportes", "vista_regreso_params" => 0, "permisos_requeridos"=>"('LEERREPORTE')"),
            "controlRiego" => array("vista" => "controlRiego", "titulo" => "Programa de Riego", "vista_regreso" => "home", "vista_regreso_params" => 0, "permisos_requeridos"=>"('LEERRIEGO')"),
            "registroRiego" => array("vista" => "registroRiego", "titulo" => "Riego", "vista_regreso" => "controlRiego", "vista_regreso_params" => 0, "permisos_requeridos"=>""),
            "registroAnioRiego" => array("vista" => "registroAnioRiego", "titulo" => "Registro Año Riego", "vista_regreso" => "controlRiego", "vista_regreso_params" => 0, "permisos_requeridos"=>""),
            "graficaRiego" => array("vista" => "graficaRiego", "titulo" => "Gráfica de Riego", "vista_regreso" => "controlRiego", "vista_regreso_params" => 0, "permisos_requeridos"=>""),
            "histSub" => array("vista" => "histSub", "titulo" => "Historico Subestaciones", "vista_regreso" => "home", "vista_regreso_params" => 0, "permisos_requeridos"=>"('HISTORICOSUBESTACIONIXTLAHUACA')"),
            "subestaciones" => array("vista" => "subestaciones", "titulo" => "Subestaciones Electricas", "vista_regreso" => "home", "vista_regreso_params" => 0, "permisos_requeridos"=>"('CREARSUBESTACIONIXTLAHUACA')"),
            "tanque" => array("vista" => "tanque", "titulo" => "Tanques", "vista_regreso" => "home", "vista_regreso_params" => 0, "permisos_requeridos"=>"(
                                'CAPTURATANQUEAEROCLUB1',
                                'CAPTURATANQUEAEROCLUB2',
                                'CAPTURATANQUEAEROCLUB3',
                                'CAPTURATANQUECARTERO',
                                'CAPTURATANQUEPALOALTO',
                                'CAPTURATANQUEZARAGOZA',
                                'CAPTURATANQUEDOLORES',
                                'CAPTURATANQUESTALUCIA1',
                                'CAPTURATANQUESTALUCIA2',
                                'CAPTURATANQUESTALUCIA3',
                                'CAPTURATANQUESTALUCIA4',
                                'CAPTURATANQUESTALUCIA5',
                                'CAPTURATANQUEVILLAVERDUN',
                                'CAPTURATANQUEAGUILAS2',
                                'CAPTURATANQUEAGUILAS3',
                                'CAPTURATANQUEAGUILAS4',
                                'CAPTURATANQUEAGUILAS5',
                                'CAPTURATANQUEAGUILAS6',
                                'CAPTURATANQUEMIMOSA',
                                'CAPTURATANQUELIENZO',
                                'CAPTURATANQUEJUDIO',
                                'CAPTURATANQUESANFRANCISCO',
                                'CAPTURATANQUEPADIERNA',
                                'CAPTURATANQUEPICACHO',
                                'CAPTURATANQUEMADEDEROSII',
                                'CAPTURATANQUEMADEDEROSIII',
                                'CAPTURATANQUEMAPLE',
                                'CAPTURATANQUEZAPOTE',
                                'CAPTURATANQUEZAPOTE',
                                'CAPTURATANQUEFABRIQUITA',
                                'CAPTURATANQUECURVA',
                                'CAPTURATANQUEROMPEDOR',
                                'CAPTURATANQUEMERCEDGOMEZ',
                                'CAPTURATANQUEYAQUI',
                                'CAPTURATANQUECALVARIO',
                                'CAPTURATANQUECONTADERO1',
                                'CAPTURATANQUECONTADERO2',
                                'CAPTURATANQUELIMBO',
                                'CAPTURATANQUELAERA',
                                'CAPTURATANQUEAO8')"),            

            "histTanque" => array("vista" => "histTanque", "titulo" => "Historico Tanques", "vista_regreso" => "home", "vista_regreso_params" => 0, "permisos_requeridos"=>"(
                                'HISTORICOTANQUEAEROCLUB1',
                                'HISTORICOTANQUEAEROCLUB2',
                                'HISTORICOTANQUEAEROCLUB3',
                                'HISTORICOTANQUECARTERO',
                                'HISTORICOTANQUEPALOALTO',
                                'HISTORICOTANQUEZARAGOZA',
                                'HISTORICOTANQUEDOLORES',
                                'HISTORICOTANQUESTALUCIA1',
                                'HISTORICOTANQUESTALUCIA2',
                                'HISTORICOTANQUESTALUCIA3',
                                'HISTORICOTANQUESTALUCIA4',
                                'HISTORICOTANQUESTALUCIA5',
                                'HISTORICOTANQUEVILLAVERDUN',
                                'HISTORICOTANQUEAGUILAS2',
                                'HISTORICOTANQUEAGUILAS3',
                                'HISTORICOTANQUEAGUILAS4',
                                'HISTORICOTANQUEAGUILAS5',
                                'HISTORICOTANQUEAGUILAS6',
                                'HISTORICOTANQUEMIMOSA',
                                'HISTORICOTANQUELIENZO',
                                'HISTORICOTANQUEJUDIO',
                                'HISTORICOTANQUESANFRANCISCO',
                                'HISTORICOTANQUEPADIERNA',
                                'HISTORICOTANQUEPICACHO',
                                'HISTORICOTANQUEMADEDEROSII',
                                'HISTORICOTANQUEMADEDEROSIII',
                                'HISTORICOTANQUEMAPLE',
                                'HISTORICOTANQUEZAPOTE',
                                'HISTORICOTANQUEFABRIQUITA',
                                'HISTORICOTANQUECURVA',
                                'HISTORICOTANQUEROMPEDOR',
                                'HISTORICOTANQUEMERCEDGOMEZ',
                                'HISTORICOTANQUEYAQUI',
                                'HISTORICOTANQUECALVARIO',
                                'HISTORICOTANQUECONTADERO1',
                                'HISTORICOTANQUECONTADERO2',
                                'HISTORICOTANQUELIMBO',
                                'HISTORICOTANQUELAERA',
                                'HISTORICOTANQUEAO8')"),

            "reporteSistemas" => array("vista" => "reporteSistemas", "titulo" => "Informe de Sistemas", "vista_regreso" => "", "vista_regreso_params" => 0, "permisos_requeridos"=>"('INFORMESISTEMAS')"),

            "progsRiego" => array("vista" => "progsRiego", "titulo" => "Programas de Riego", "vista_regreso" => "", "vista_regreso_params" => 0, "permisos_requeridos"=>"SINPERMISO"),
            "progRiego" => array("vista" => "progRiego", "titulo" => "Programa de Riego", "vista_regreso" => "progsRiego", "vista_regreso_params" => 0, "permisos_requeridos"=>"SINPERMISO"),

            "regFuentes" => array("vista" => "regFuentes", "titulo" => "Registro de Fuentes", "vista_regreso" => "", "vista_regreso_params" => 0, "permisos_requeridos"=>"SINPERMISO"),
            "regFuente" => array("vista" => "regFuente", "titulo" => "Registro de Fuente", "vista_regreso" => "regFuentes", "vista_regreso_params" => 0, "permisos_requeridos"=>"SINPERMISO"),

            "controlAvance" => array("vista" => "controlAvance", "titulo" => "Control de Avances", "vista_regreso" => "", "vista_regreso_params" => 0, "permisos_requeridos"=>"SINPERMISO"),

            "mapa" => array("vista" => "mapa", "titulo" => "Mapa", "vista_regreso" => "mapa", "vista_regreso_params" => 0, "permisos_requeridos"=>""),
            "historicoSistemas" => array("vista" => "historicoSistemas", "titulo" => "Compendio Sistemas", "vista_regreso" => "", "vista_regreso_params" => 0, "permisos_requeridos"=>"")
        ];


        //Inicia siendo 404 la vista
        $contenido = array("vista" => "404", "titulo" => "", "vista_regreso" => "", "vista_regreso_params" => 0);

        foreach ($listaBlanca as $key => $value) {
            if ($key === $vistas) {
                if (is_file("./vistas/templates/" . $vistas . ".php")&&(($listaBlanca["$key"]["permisos_requeridos"]=="")||(isset($_SESSION[GUID]["rol_id"])?(mainModel::consulta_permisos_rol($listaBlanca["$key"]["permisos_requeridos"], mainModel::decryption($_SESSION[GUID]["rol_id"]))->rowCount() >= 1):false))) {

                    $contenido = $value;
                } else {
                    $contenido = array("vista" => "404", "titulo" => "", "vista_regreso" => "", "vista_regreso_params" => 0);
                }
            } elseif ($vistas == "login") {
                $contenido = array("vista" => "login", "titulo" => "", "vista_regreso" => "", "vista_regreso_params" => 0);
            } elseif ($vistas == "index") {
                $contenido = array("vista" => "login", "titulo" => "", "vista_regreso" => "", "vista_regreso_params" => 0);
            } elseif ($vistas == "") {

                $contenido = array("vista" => "404", "titulo" => "", "vista_regreso" => "", "vista_regreso_params" => 0);
            }
        }

        return $contenido;
    }
}
