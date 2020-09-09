<?php
//Cargamos la cabecera de la página web.
//Cargamos la funciones.
require_once 'funciones.inc.php';
require_once 'basico.php';

session_start();
date_default_timezone_set('Europe/Madrid');
$_SESSION['HoraConexion']=time();

$smarty->display('cabeceralogin.html');
$precargoLogin = "";
$precargoClave = "";
$errorLogin = "";
$errorClave = "";
$errorGeneral = "";

if (isset($_GET['gestionarmicuenta'])) {
    $errorLogin = validardatos(filter_input(INPUT_GET, recogerdato('login')), 'login');
    //Si viene de vuelta se comprueba que el login es válido
    $errorClave = validardatos(filter_input(INPUT_GET, recogerdato('clave')), 'clave');
    $precargoLogin = str_replace('+', ' ', precargarDato('login'));
    $precargoClave = precargarDato('clave');
    //Ha habido un error en la comprobación del usuario.
    $consulta = "select bloqueado from anunciantes where login=:login";

    $datos = [":login" => $_SESSION['login']];

    $resultado = accesoDB::mostrarConsulta($consulta, $datos);
    //Sino existe el usuario mostramos el error;
    if ($resultado == "1") {
        $errorGeneral = "Compruebe que el usuario y la clave son correctos";
    } else {
        foreach ($resultado as $valor) {
            if ($valor['bloqueado'] == 1) {
                //Si esta bloqueado mostramos el error de bloqueado
                $errorGeneral = "Usuario Bloqueado.<br/>Debe esperar que un administrador desbloquee la cuenta.";
                $_SESSION['Intentos'] = 0;
            } else {
                //Si no esta bloqueado mostramos el error de bloqueado
                $errorGeneral = "Compruebe que el usuario y la clave son correctos<br/>";
            }
        }
    }
}

$smarty->assign('precargoLogin', $precargoLogin);
$smarty->assign('precargoClave', $precargoClave);
$smarty->assign('errorLogin', $errorLogin);
$smarty->assign('errorClave', $errorClave);
$smarty->assign('errorGeneral', $errorGeneral);

$smarty->display('login.html');
$smarty->display('pie.html');
