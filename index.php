<?php

//Cargamos la funciones.
require_once 'funciones.inc.php';
require_once 'anuncios.php';
require_once 'basico.php';
//iniciamos la session


session_start();
date_default_timezone_set('Europe/Madrid');
$titulo='Tarea 7 DWES';
$smarty->assign('titulo', $titulo);

!isset($_SESSION) ? session_start() : false;
$smarty->assign('login',"Invitado");
$smarty->assign('hora', date('H:i:s', time()));
//Se comprueba el login del usuario para mostrat una cabecera u otra
$smarty->display('cabecerainvitado.html');

//var_dump(Anuncios::todosLosAnuncios());
//$smarty->assign('resultado', Anuncios::todosLosAnuncios());
//$smarty->display('index.html');


//Cargamos el pie de la página web.
$smarty->display('pie.html');
