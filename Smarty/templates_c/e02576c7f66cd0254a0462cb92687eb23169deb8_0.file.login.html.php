<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-08 18:58:59
  from 'C:\xampp\htdocs\tarea7Mocupas\Smarty\templates\login.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f57b853581b66_43996925',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e02576c7f66cd0254a0462cb92687eb23169deb8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tarea7Mocupas\\Smarty\\templates\\login.html',
      1 => 1598462216,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f57b853581b66_43996925 (Smarty_Internal_Template $_smarty_tpl) {
?><!--Se genera la capa-->
<div id="formularioLogin" class="oculto">
    <form action="usuario.php" id="formularioLoginUsuario" method="post">
        <!--Generamos la etiqueta "Usuario" y precargamos el dato desde php. -->
        <label class="login">Usuario:<br /><input id="inputLogin" name='login' class="inputLogin" type='text'
                placeholder='Tu usuario' required pattern='[a-zA-Z0-9_-]+' autofocus='true'
                title='Debe introducir letras y números. '
                value='<?php ob_start();
echo $_smarty_tpl->tpl_vars['precargoLogin']->value;
$_prefixVariable1 = ob_get_clean();
if (isset($_prefixVariable1)) {
echo $_smarty_tpl->tpl_vars['precargoLogin']->value;
}?>'></label>
        <span class='error'><?php echo $_smarty_tpl->tpl_vars['errorLogin']->value;?>
</span><br></span>
        <!--Generamos la etiqueta "Clave" y precargamos el dato desde php. -->
        <br>
        <br /><label class="login">Clave:<br /><input name='clave' id="inputClave" class="inputLogin" type='password'
                placeholder="Tu clave" required pattern="[a-zA-Z0-9-_.]+" title='Debe introducir un clave válida.'
                value='<?php ob_start();
echo $_smarty_tpl->tpl_vars['precargoClave']->value;
$_prefixVariable2 = ob_get_clean();
if (isset($_prefixVariable2)) {
echo $_smarty_tpl->tpl_vars['precargoClave']->value;
}?>'></label>
        <span class="error"><?php echo $_smarty_tpl->tpl_vars['errorClave']->value;?>
<br></span>

        <br><br>
        <span id="errorGeneralLogin" class="error"><?php echo $_smarty_tpl->tpl_vars['errorGeneral']->value;?>
<br></span>
        <br>
        <!--Se genera el botón "Gestionar mi cuenta".-->
        <input type="submit" id="gestionarmicuenta" class="botonFormularioLogin" name="gestionarmicuenta"
            value="Gestionar mi cuenta" width="200px">

    </form>

      <!-- Formulario del botón "Registrarse"-->
      <form action="registro.php" id="formularioRegistrase" method="post">
          <input type="submit" id="registrarse" class="botonFormularioLogin" name="registrarse" value="Registrarse">
      </form>
</div><?php }
}
