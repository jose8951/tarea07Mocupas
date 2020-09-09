<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-08 18:58:53
  from 'C:\xampp\htdocs\tarea7Mocupas\Smarty\templates\cabecerainvitado.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f57b84dc68fb4_13361211',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f7eedfdcf20d6a7ad6384977051433edc5fe3a94' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tarea7Mocupas\\Smarty\\templates\\cabecerainvitado.html',
      1 => 1599304298,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f57b84dc68fb4_13361211 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- Se genera el documento HTML-->
<!DOCTYPE html>
<!-- Indicamos el idioma del la página Web-->
<html lang="es">

<head>
    <!-- Se genera el head de la página web-->
    <META http-equiv=Content-Type content="text/html; UTF-8">
    <!-- Indicamos el estilo de la página web-->
    <link rel="stylesheet" type="text/css" href="estilo.css" />
    <link rel="stylesheet" type="text/css" href="./include/libs/leaflet/leaflet.css" />
    <!-- Indicamos el título de la página web-->
    <title>Tarea 7 DWES cabecerainvitado.html</title>
    <!-- Se cierra el head de la página web-->
</head>
<!-- Se genera el body de la página web-->

<body>
    <h1>Aplicación WEB Morosos</h1>
    <!-- Generamos la capa "navCabecera"-->
    <div id="navCabecera">
        <!-- Generamos la capa "invitado"-->
        <div id="invitado">
            <form action="login.php" method="post" class="inicio">
                <input type="submit" id="botonCrearAnuncioInvitado" name='botonCrearAnuncioInvitado'
                    value="Nuevo anuncio" class="botonCabecera">
                <!-- Se cierra el formulario-->
            </form>
            <?php ob_start();
echo $_smarty_tpl->tpl_vars['login']->value;
$_prefixVariable1 = ob_get_clean();
if ($_prefixVariable1 == "Invitado") {?>
            <form action="login.php" method="post" class="inicio">
                <input id="botonLogin" type="submit" name='botonLogin' value="Login" class="botonCabecera">

            </form>
            <?php }?>

        </div>
        <!-- Se cierra la capa-->
    </div>
    <!-- Se cierra la capa-->
    <!-- Generamos la capa "datosSesion"-->
    <div id='datosSesion'>
        <span id="textoLogin" class="login"><?php echo $_smarty_tpl->tpl_vars['login']->value;?>
</span><span class="login"> <?php echo $_smarty_tpl->tpl_vars['hora']->value;?>
</span>

        <!-- Se cierra la capa-->
    </div>
    <!-- Generamos la capa "capaLogin"-->

    <div id='capaLogin'></div>
    <!-- Generamos la capa "formularioCrearAnuncio"-->
    <div id="formularioCrearAnuncio" class="oculto"></div>
    <!-- Generamos la capa "capaAnuncios"-->
    <div id='capaAnuncios'>
    </div><?php }
}
