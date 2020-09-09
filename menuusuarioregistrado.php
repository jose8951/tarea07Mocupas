<?php
//Cargamos la funciones.
require_once 'funciones.inc.php';
//Cargamos la cabecera de la página web.
require_once 'cabecerausuario.php';
//Recogemos los datos pasados por el formulario anterior.
$usuarioAdmin = filter_input(INPUT_POST, recogerdato('usuarioAdmin'));
$claveAdmin = filter_input(INPUT_POST, recogerdato('claveAdmin'));



//Cargamos el pie de la página web.
$smarty->display('pie.tpl');
