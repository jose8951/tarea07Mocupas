<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-03 12:51:31
  from 'C:\xampp\htdocs\tarea7Martinez\Smarty\templates\registro.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f50cab37cf9e8_67409177',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5e7da31862ae3c4f91e06ba1a6f7d85790cbf58b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tarea7Martinez\\Smarty\\templates\\registro.html',
      1 => 1599130283,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f50cab37cf9e8_67409177 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!--Se genera el formulario-->
<form id="formularioRegistro" action="registro.php" method="post">


    <!--Se genera la etiqueta "Login" y precargamos el dato desde php. -->
    <label class="login">Usuario:<input id='inputLoginRegistro' name='login' class="inputLogin" type='text' placeholder='Tu usuario' required pattern='[a-zA-Z0-9_-]+' autofocus='true' title='Debe introducir letras y números. ' value='<?php ob_start();
echo $_smarty_tpl->tpl_vars['precargoLogin']->value;
$_prefixVariable1 = ob_get_clean();
if (isset($_prefixVariable1)) {
echo $_smarty_tpl->tpl_vars['precargoLogin']->value;
}?>'></label>
    <?php if ($_smarty_tpl->tpl_vars['errorLogin']->value != '') {?><label class='error'><?php echo $_smarty_tpl->tpl_vars['errorLogin']->value;?>
<br/></label><?php }?>
    </br>
    <!--Se genera la etiqueta "Password" y precargamos el dato desde php. -->
    <label class="textForm">Password:<input id='inputPassword1Registro' name='password' type='password' placeholder='Tu contraseña' required pattern="[a-zA-Z0-9.-_]{1,128}"  title='Debe introducir letras y números. ' value='<?php ob_start();
echo $_smarty_tpl->tpl_vars['precargoPassword']->value;
$_prefixVariable2 = ob_get_clean();
if (isset($_prefixVariable2)) {
echo $_smarty_tpl->tpl_vars['precargoPassword']->value;
}?>'></label>
    <?php if ($_smarty_tpl->tpl_vars['errorPassword']->value != '') {?><label class='error'><?php echo $_smarty_tpl->tpl_vars['errorPassword']->value;?>
<br/></label><?php }?>
    </br>
    <!--Se genera la etiqueta "Password" y precargamos el dato desde php. -->
    <label class="textForm">Password<input id="inputPassword2Registro" name='password2' type='password' placeholder="Repetir contraseña" required pattern='[a-zA-Z0-9.-_]{1,128}'  title='Debe introducir letras y números. ' value='<?php ob_start();
echo $_smarty_tpl->tpl_vars['precargoPassword2']->value;
$_prefixVariable3 = ob_get_clean();
if (isset($_prefixVariable3)) {
echo $_smarty_tpl->tpl_vars['precargoPassword2']->value;
}?>'></label>
    <?php if ($_smarty_tpl->tpl_vars['errorPassword']->value != '') {?><label class='error'><?php echo $_smarty_tpl->tpl_vars['errorPassword2']->value;?>
<br/></label><?php }?> </br>
    <!--Generamos la etiqueta "Email" y precargamos el email desde php. -->


    <label class="textForm">Email:<input name='email' id="inputEmailRegistro" type='email' placeholder="example@exmaple.es" required
	pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" 
	title='Debe introducir un email válido.' value='<?php ob_start();
echo $_smarty_tpl->tpl_vars['precargoEmail']->value;
$_prefixVariable4 = ob_get_clean();
if (isset($_prefixVariable4)) {
echo $_smarty_tpl->tpl_vars['precargoEmail']->value;
}?>'></label>
    <?php if ($_smarty_tpl->tpl_vars['errorEmail']->value != '') {?><label class='error'><?php echo $_smarty_tpl->tpl_vars['errorEmail']->value;?>
<br/></label><?php }?> </br> </br>
    <?php if ($_smarty_tpl->tpl_vars['errorGeneral']->value != '') {?><label id="errorGeneralRegistro" class='error'><?php echo $_smarty_tpl->tpl_vars['errorGeneral']->value;?>
<br/></label><?php }?> </br>

    <!-- Se genera el botón "Registrarse"-->

    <input type="submit" class="botonFormulario" id="registrarse" name="registrarse" value="Registrarse" ><br/>

   
    </form>
<?php }
}
