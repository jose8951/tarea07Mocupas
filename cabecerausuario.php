<?php
//Cargamos la funciones.
require_once 'funciones.inc.php';
//Recogemos los datos que vienes por post del login.
require_once 'basico.php';

!isset($_COOKIE['colorFondo']) ? $fondo = "while" : $fondo = $_COOKIE['colorFondo'];
!isset($_SESSION) ? session_start() : false;
$smarty->assign('login', $_SESSION['login']);
$smarty->assign('hora', date('H:i:s', $_SESSION['HoraConexion']));

//Solo si es el usuario dwes
if ($_SESSION['login'] == 'dwes') {
    $smarty->assign('login', 'dwes');
}
?>

<!DOCTYPE html>
<html lang="es" style="background-color: <?php $fondo ?>;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Tarea 7 dwes</title>
</head>

<body style="background-color: <?php $fondo ?>;">
    <?php
    $smarty->display('cabecerausuario.html');
    ?>

</body>

</html>