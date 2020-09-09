<?php
//Cargamos la cabecera de la página web.
require_once 'cabecerausuario.php';
require_once 'anuncios.php';
require_once 'basico.php';
require_once 'funciones.inc.php';

$login = "";
$fecha = "";
$moroso = "";
$localidad = "";
$descripcion = "";
$errorFecha = "";
$errorMoroso = "";
$errorLocalidad = "";
$errorDescripcion = "";

$consulta = "SELECT `AUTO_INCREMENT` as id_anuncio FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'morosos' AND   TABLE_NAME   = 'anuncios';";
!isset($_SESSION) ? session_start() : false;
!isset($_SESSION['login']) ? header('location:index.php') : false;

$smarty->assign('login', $_SESSION['login']);
$datos = [];
//Se ejecuta la consulta ver si hay anuncios.
$resultado = accesoDB::mostrarConsulta($consulta, $datos);
$id_anuncio = 0;
//$datos = [":login" => $_SESSION['login']];

if (!$resultado == '1') {
    foreach ($resultado as $valor) {
        //recogemos el nuevo código de anuncio
        $id_anuncio = $valor['id_anuncio'];
    }
}

if (isset($_POST['guardar'])) {
    $fecha = str_replace('+', '', precargarDato('fecha'));
    $errorFecha = validardatos(filter_input(INPUT_POST, recogerdato('fecha')), 'fecha');
    $validadopFecha = validardatos(filter_input(INPUT_POST, recogerdato('fecha')), 'fecha');


    //remplaza cuando encuentra un + por un espacio en  blanco +pe+pe por pepe 
    $moroso = str_replace('+', '', precargarDato('moroso'));
    $errorMoroso = validardatos(filter_input(INPUT_POST, recogerdato('moroso')), 'moroso');
    $validadopMoroso = validardatos(filter_input(INPUT_POST, recogerdato('moroso')), 'moroso');

    $localidad = str_replace('+', ' ', precargarDato('localidad'));
    $errorLocalidad = validardatos(filter_input(INPUT_POST, recogerdato('localidad')), 'localidad');
    $validadopLocalidad = validardatos(filter_input(INPUT_POST, recogerdato('localidad')), 'localidad');

    $descripcion = str_replace('+', ' ', precargarDato('descripcion'));
    $errorDescripcion = validardatos(filter_input(INPUT_POST, recogerdato('descripcion')), 'descripcion');
    $validadopDescripcion = validardatos(filter_input(INPUT_POST, recogerdato('descripcion')), 'descripcion');

    if (Anuncios::validarDatosAnuncio($validadopFecha, $validadopMoroso, $validadopLocalidad, $validadopDescripcion) === true) {
        $fecha = filter_input(INPUT_POST, recogerdato('fecha'));
        $moroso = filter_input(INPUT_POST, recogerdato('moroso'));
        $localidad = filter_input(INPUT_POST, recogerdato('localidad'));
        $descripcion = filter_input(INPUT_POST, recogerdato('descripcion'));

        $autor = $_SESSION['login'];
        $anuncio = new Anuncios($id_anuncio, $autor, $moroso, $localidad, $descripcion, $fecha);
        $anuncio->guardaAnuncio($anuncio);
    }
} else {
    $fecha = date('Y-m-d', $_SESSION['HoraConexion']);
}

$smarty->assign('boton', "guardar");
$smarty->assign('login', $login);
$smarty->assign('precargoFecha', $fecha);
$smarty->assign('precargoMoroso', $moroso);
$smarty->assign('precargoLocalidad', $localidad);
$smarty->assign('precargoDescripcion', $descripcion);
$smarty->assign('errorFecha', $errorFecha);
$smarty->assign('errorMoroso', $errorMoroso);
$smarty->assign('errorLocalidad', $errorLocalidad);
$smarty->assign('errorDescripcion', $errorDescripcion);

$smarty->display('crearanuncio.html');
//Cargamos el pie de la página web.
$smarty->display('pie.html');
