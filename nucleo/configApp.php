<?php
//#######Constantes de conexion BD###################
    const SERVER="";
    const BD="";
    const USER="";
    const PASS="";


     const SERVER_MS="";
     const BD_MS="VfiTag";
     const USER_MS="Analisis";
     const PASS_MS="SacmexAnalisis1";
     
     const WS_SERVER="186.96.55.148:8084/reservedws";
     
    const SGBD = "mysql:host=" . SERVER . ";dbname=" . BD . ";charset=utf8";
    const SGBD_MS = "sqlsrv:Server=" . SERVER_MS . ";Database=" . BD_MS;
    const SGBD_MSSQL = "dblib:host=10.11.25.6\SQLEXPRESS;dbname=Vfitag;charset=utf8";
    const METHOD = "AES-256-CBC";
    const SECRET_KEY = '$JR@2020';
    const SECRET_IV = '171119';

//#################Mensajeria####################
//Telegram
const APIKEYBOT = '1087800001:AAGX6JkGPXm3ZR0XdCgjDS42Rv95680DzeE';
const GROUPID = '-365609298';

//#################Configuraciones adicionales####################
//Horas hacia atras captura lumbreras
const PERIODO_LUMBRERAS=24;

const DEPLOY = true;//Cambiar para mostrar sistema inactivo, se utiliza en combinacion de $_GET["dev"]
