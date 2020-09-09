<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-01 13:03:02
  from 'C:\xampp\htdocs\tarea7Martinez\Smarty\templates\pie.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f4e2a66624bd3_38498519',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7ac87b5760055eb6ad2109ea99e45ca4e15bc85a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tarea7Martinez\\Smarty\\templates\\pie.html',
      1 => 1598958179,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f4e2a66624bd3_38498519 (Smarty_Internal_Template $_smarty_tpl) {
?><!--Generamos la capa "piedepagina". -->
<div id="piedepagina">
    <!--Mostramos el pie de página.-->
    <p>
        <h3>tarea 7 dwec</h3>
    </p>
    <!--Cerramos la capa "piedepagina" -->
</div>

 <!-- Se cargan los script-->
 <?php echo '<script'; ?>
 type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyAWnnnTQb-zAgy46lJKtoo-1xwU4ZZVhws"><?php echo '</script'; ?>
>

 <?php echo '<script'; ?>
 src="./include/libs/leaflet/leaflet.js"><?php echo '</script'; ?>
>
 <?php echo '<script'; ?>
 src="./include/libs/jquery-3.5.0.js"><?php echo '</script'; ?>
>
 <?php echo '<script'; ?>
 src="./funciones.js"><?php echo '</script'; ?>
>
 <!--Cerramos la etiqueta body. -->
 </body>    
 <!--Cerramos la etiqueta html.-->
 </html><?php }
}
