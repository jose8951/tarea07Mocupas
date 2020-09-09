<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-08 18:58:54
  from 'C:\xampp\htdocs\tarea7Mocupas\Smarty\templates\pie.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f57b84e2bae72_07260979',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4bb6ac28b3fefcca68cc33e598ea491c61aef87d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tarea7Mocupas\\Smarty\\templates\\pie.html',
      1 => 1598958179,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f57b84e2bae72_07260979 (Smarty_Internal_Template $_smarty_tpl) {
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
