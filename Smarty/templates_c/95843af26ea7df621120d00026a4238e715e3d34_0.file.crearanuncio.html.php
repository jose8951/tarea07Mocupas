<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-06 18:42:43
  from 'C:\xampp\htdocs\tarea7Martinez\Smarty\templates\crearanuncio.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f5511833c9513_89071857',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '95843af26ea7df621120d00026a4238e715e3d34' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tarea7Martinez\\Smarty\\templates\\crearanuncio.html',
      1 => 1599410492,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f5511833c9513_89071857 (Smarty_Internal_Template $_smarty_tpl) {
?><!--Se genera el formulario-->
<form id="formularioAnuncio" action="crearanuncio.php" method="post">


        <!--Se genera la etiqueta "Autor" y precargamos el dato desde php. -->
        <label class="textForm">Autor: <?php echo $_smarty_tpl->tpl_vars['login']->value;?>
 </label>
    
        </br>
    
        <!--Generamos la etiqueta "Fecha" y precargamos la fecha desde php. -->
        <label class="textForm">Fecha:<input id="inputFechaAnuncio"name='fecha' type='date' placeholde="1984-07-27"  autofocus='true' required title='Debe introducir una fecha.' value='<?php ob_start();
echo $_smarty_tpl->tpl_vars['precargoFecha']->value;
$_prefixVariable1 = ob_get_clean();
if (isset($_prefixVariable1)) {
echo $_smarty_tpl->tpl_vars['precargoFecha']->value;
}?>'>
        </label><br />
    
        <?php ob_start();
echo $_smarty_tpl->tpl_vars['errorFecha']->value;
$_prefixVariable2 = ob_get_clean();
if ($_prefixVariable2 != '') {?><label class='error'><?php echo $_smarty_tpl->tpl_vars['errorFecha']->value;?>
<br/></label><?php }?>
    
        <!--Se genera la etiqueta "Moroso" y precargamos el dato desde php. -->
        <label class="textForm">Moroso:<input id="inputAnuncioMoroso" name='moroso' type='text' placeholder="Nombre del moroso" required pattern='[a-zA-ZÁÉÍÓÚáéíóú0-9 ]{1,60}'  title='Debe introducir un moroso. ' value='<?php ob_start();
echo $_smarty_tpl->tpl_vars['precargoMoroso']->value;
$_prefixVariable3 = ob_get_clean();
if (isset($_prefixVariable3)) {
echo $_smarty_tpl->tpl_vars['precargoMoroso']->value;
}?>'></label>
        <?php ob_start();
echo $_smarty_tpl->tpl_vars['errorMoroso']->value;
$_prefixVariable4 = ob_get_clean();
if ($_prefixVariable4 != '') {?><label class="error"><?php echo $_smarty_tpl->tpl_vars['errorMoroso']->value;?>
<br/></label><?php }?> </br>
        <!--Se genera la etiqueta "Localidad" y precargamos el dato desde php. -->
        <label class="textForm">Localidad:<input id="inputAnuncioLocalidad" name="localidad" type="textarea"  required name="localidad" size="50" type="text" placeholder="calle número, localidad, provincia, país"  title="Debe introducir calle número, localidad, provincia, país" pattern="[a-zA-Z0-9ñÑÁÉÍÓÚáéíóú ,]{1,60}"  value='<?php ob_start();
echo $_smarty_tpl->tpl_vars['precargoLocalidad']->value;
$_prefixVariable5 = ob_get_clean();
if (isset($_prefixVariable5)) {
echo $_smarty_tpl->tpl_vars['precargoLocalidad']->value;
}?>'></label>
        <?php ob_start();
echo $_smarty_tpl->tpl_vars['errorLocalidad']->value;
$_prefixVariable6 = ob_get_clean();
if ($_prefixVariable6 != '') {?><label class="error"><?php echo $_smarty_tpl->tpl_vars['errorLocalidad']->value;?>
<br/></label><?php }?> </br> </br>
        <!--Se genera la etiqueta "Descripción" y precargamos el dato desde php. -->
        <label class="textForm"> Descripción:<textarea id="inputAnuncioDescripcion" name="inputAnuncioDescripcion" cols="50" rows="4" minlength="1" maxlength="500" width="50%;" required pattern='[a-zA-ZáéíóúÁÉÍÓÚ0-9€ ,.\"_-]{1,500}'  placeholder="Descripción del anuncio." title="Debe introducir una descripcion." required><?php ob_start();
echo $_smarty_tpl->tpl_vars['precargoDescripcion']->value;
$_prefixVariable7 = ob_get_clean();
if (isset($_prefixVariable7)) {
echo $_smarty_tpl->tpl_vars['precargoDescripcion']->value;
}?></textarea></label>
        <?php ob_start();
echo $_smarty_tpl->tpl_vars['errorDescripcion']->value;
$_prefixVariable8 = ob_get_clean();
if ($_prefixVariable8 != '') {?><label class="error"><?php echo $_smarty_tpl->tpl_vars['errorLocalidad']->value;?>
<br/></label><?php }?> </br> </br> </br>
    
        <!-- Se genera el botón "Guardar"o "Modificar"-->
        <?php ob_start();
echo $_smarty_tpl->tpl_vars['boton']->value;
$_prefixVariable9 = ob_get_clean();
if ($_prefixVariable9 == "guardar") {?>
        <input type="submit" class="botonFormulario" id="botonGuardarAnuncio" name="guardar" value="Guardar" ><br/>
        <?php } else { ?>
        <input type="submit" class="botonFormulario" id="botonModificarAnuncio" name="botonModificarAnuncio" value="Modificar" ><br/>
        <?php }?>
    
    </form><?php }
}
