<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-01 13:39:18
  from 'C:\xampp\htdocs\tarea7Martinez\Smarty\templates\preferencias.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f4e32e6a571d3_34790077',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a4b60963922c64043f70898ab7d1d61ef4e1ea20' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tarea7Martinez\\Smarty\\templates\\preferencias.html',
      1 => 1598959902,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f4e32e6a571d3_34790077 (Smarty_Internal_Template $_smarty_tpl) {
?><!--Se genera el formulario-->
<form action="preferencias.php" id="formularioPreferencias" method="post">
    <!--Generamos la etiqueta "Color de fondo" y precargamo el color de fondo. -->
    <label class="textForm">Color de fondo:<input autofocus id="colorFondo" name="color" type="color"
            value="<?php ob_start();
echo $_smarty_tpl->tpl_vars['fondo']->value;
$_prefixVariable1 = ob_get_clean();
if (isset($_prefixVariable1)) {?> <?php echo $_smarty_tpl->tpl_vars['fondo']->value;
}?>"></label><br>

    <input type="submit" class="botonFormulario" id="botonGuardarPreferencias" name="guardar" value="Guardar"><br>

</form>

<form action="preferencias.php" id="formularioPreferenciasRestablecer" method="post">
    <!-- Se genera el botón "Restablecer Fondo"-->
    <input type="submit" class="botonFormulario" id="botonRestablecerPreferencias" name="restablecer"
        value="Restablecer fondo"><br>

</form><?php }
}
