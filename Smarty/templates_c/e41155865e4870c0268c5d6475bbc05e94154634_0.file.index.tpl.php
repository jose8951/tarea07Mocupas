<?php
/* Smarty version 3.1.34-dev-7, created on 2020-08-26 12:27:48
  from 'C:\xampp\htdocs\tarea7Martinez\Smarty\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f4639244b8254_06912728',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e41155865e4870c0268c5d6475bbc05e94154634' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tarea7Martinez\\Smarty\\templates\\index.tpl',
      1 => 1598437661,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f4639244b8254_06912728 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- Si no hay anuncios-->
<!-- Si no hay anuncios-->


<?php ob_start();
echo $_smarty_tpl->tpl_vars['resultado']->value;
$_prefixVariable1 = ob_get_clean();
if ($_prefixVariable1 == 1) {?>
<div id="sinAnuncios">
    <h1>No hay ningún anuncio.</h1><br />
</div>
<?php } else { ?>

<!-- Anuncios de la última semana-->
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['resultado']->value, 'valor');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['valor']->value) {
ob_start();
echo $_smarty_tpl->tpl_vars['valor']->value[1];
$_prefixVariable2 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['valor']->value[2];
$_prefixVariable3 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['valor']->value[3];
$_prefixVariable4 = ob_get_clean();
if ($_prefixVariable2 <= 7 && $_prefixVariable3 == 0 && $_prefixVariable4 == 0) {?>

<div class='anuncio semanaAnterior'>
    <div id='<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
' class='filaAnuncio'>

        <span id="textoAnuncioAutor<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
" class='textForm'>Autor:&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getAutor();?>
</span>
        <span  id="textoAnuncioFecha<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
" class='textForm'>Fecha:&nbsp;<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getFecha();?>
</span><span id="textoAnuncioMoroso<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
" class='textForm'>Moroso:&nbsp;<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getMoroso();?>
</span><br/>
        <span id="textoAnuncioDescripción<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
" class='textForm'>Descripción:&nbsp;<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getDescripcion();?>
</span><br/><br/>
        <form action="index.php" method="post">
            <input id='mapa<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
' class="botonMapa" type="submit" value="Mapa">
        </form>

        <?php ob_start();
echo $_smarty_tpl->tpl_vars['login']->value;
$_prefixVariable5 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['valor']->value[0]->getAutor();
$_prefixVariable6 = ob_get_clean();
if ($_prefixVariable5 == $_prefixVariable6) {?>
        <form action="index.php" method="post">
            <input id="botonModificar<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
"  class="botonModificar" type="submit" value="Modificar">
        </form>
        <form action="index.php" method="POST">
            <input id="botonEliminar<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
"  class="botonEliminar" type="submit" value="Eliminar">
        </form>
        <?php }?>

    </div>

    <div class="mapa">
        <div id='mapid<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
' class='mapa oculto'><?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getLocalidad();?>


        </div>
        <div class="nuevoOrigen">
            <form id='formNuevoOrigen<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
' class="oculto">
                <label for="nuevoOrigen<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
" class="textForm">Nuevo origen:</label><input id='nuevoOrigen<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
' name="localidad" type="textarea" placeholder="calle número, localidad ,provincia, país" pattern="[a-zA-Z0-9ñÑÁÉÍÓÚáéíóú ,]{1,60}" size="58" title='Debe introducir letras y números. ' />
                <input id='botonNuevoOrigen<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
' class="botonNuevoOrigen textForm" type="submit" value="Cambiar" />
            </form>
        </div>
    </div>

</div>

<?php } else { ?>
<!-- Anuncios de más de una semana-->
<div class='anuncio otrosAnuncios'>

    

    <div id='<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
' class='filaAnuncio'>
        <span id="textoAnuncioAutor<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
" class='textForm'>AutorR:&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getAutor();?>
</span>
        <span  id="textoAnuncioFecha<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
" class='textForm'>Fecha:&nbsp;<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getFecha();?>
</span><span id="textoAnuncioMoroso<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
" class='textForm'>Moroso:&nbsp;<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getMoroso();?>
</span><br/>
        <span id="textoAnuncioDescripción<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
" class='textForm'>Descripción:&nbsp;<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getDescripcion();?>
</span><br/><br/>
        <form action="index.php" method="POST">
            <input id='mapa<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
' class="botonMapa" type="submit" value="Mapa">
        </form>

        <?php ob_start();
echo $_smarty_tpl->tpl_vars['login']->value;
$_prefixVariable7 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['valor']->value[0]->getAutor();
$_prefixVariable8 = ob_get_clean();
if ($_prefixVariable7 == $_prefixVariable8) {?>
        <form action="index.php" method="POST">
            <input id="botonModificar<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
"  class="botonModificar"type="submit" value="Modificar">
        </form>
        <form action="index.php" method="POST">
            <input id="botonEliminar<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
"  class="botonEliminar" type="submit" value="Eliminar">
        </form>
        <?php }?>
    </div>
    <div class="mapa">
        <div id='mapid<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
' class='mapa oculto' ><?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getLocalidad();?>


        </div>
        <div class="nuevoOrigen">
            <form id='formNuevoOrigen<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
' class="oculto">
                <label for="nuevoOrigen<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
" class="textForm">Nuevo origen:</label><input id='nuevoOrigen<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
' name="localidad" type="textarea" placeholder="calle número, localidad ,provincia, país" pattern="[a-zA-Z0-9ñÑÁÉÍÓÚáéíóú ,]{1,60}" size="58" title='Debe introducir letras y números. ' />
                <input id='botonNuevoOrigen<?php echo $_smarty_tpl->tpl_vars['valor']->value[0]->getId_anuncio();?>
' class="botonNuevoOrigen " type="submit" value="cambiar" />
            </form>
        </div>
    </div>
</div>
<?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
}
