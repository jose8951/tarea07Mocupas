<?php
/* Smarty version 3.1.34-dev-7, created on 2020-08-31 18:49:37
  from 'C:\xampp\htdocs\tarea7Martinez\Smarty\templates\cabecerausuario.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f4d2a216206c2_38238297',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '35dd1796bd7b015d6f024f5371f800c03c2cb567' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tarea7Martinez\\Smarty\\templates\\cabecerausuario.html',
      1 => 1598868112,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f4d2a216206c2_38238297 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="navCabeceraUsuario">
    <!-- Generamos la tabla que contiene los enlaces de la cabecera-->
    <table id="menuCabecera">
        <tr>
            <td>
                <!-- Se genera el botón "Crear anuncio" y se envia el usuario y contraseña del administrador.-->
                <form action="crearanuncio.php" method="post">
                    <input type="submit" id="botonCrearAnuncionUsuario" name="anuncio" value="Crear anuncio"
                        class="botonCabecera">
                    <!-- Se cierra el formulario-->
                </form>
            </td>
            <td>
                <!-- Se genera el botón "Listado de anuncios" y se envia el usuario y contraseña del administrador.-->
                <form action="escaparate.php" method="post">
                    <input type="submit" id="botonListadoDeAnuncios" name="listadoDeAnuncios"
                        value="Listado de anuncios" class="botonCabecera">
                </form>
            </td>
            <td>
                <!-- Se genera el botón "Preferencias" y se envia el usuario y contraseña del administrador.-->
                <form action="preferencias.php" method="post">
                    <input type="submit" id="botonPreferencias" name="preferencias" value="preferencias"
                        class="botonCabecera">
                    <!-- Se cierra el formulario-->
                </form>
            </td>
            <?php ob_start();
echo $_smarty_tpl->tpl_vars['login']->value;
$_prefixVariable1 = ob_get_clean();
if ($_prefixVariable1 == "dwes") {?>
            <td>
                <form action="desbloquear.php" method="post">
                    <input type="submit" id="botonDesbloquear" name="desbloquear" value="Desbloquear usuario"
                        class="botonCabecera">
                </form>
            </td>
            <?php }?>
            <td>
                <!-- Se genera el botón "Salir"-->
                <form action="cerrar.php" method="post">
                    <input type="submit" name="Salir" value="Salir" class="botonCabecera">
                    <!-- Se cierra el formulario-->
                </form>
            </td>
        </tr>
    </table>
</div>
<?php ob_start();
echo $_smarty_tpl->tpl_vars['login']->value == "invitado";
$_prefixVariable2 = ob_get_clean();
if ($_prefixVariable2) {?>
<!-- Generamos la capa "datosSesion"-->
<div id="datosSesion">
    <span class="login" name='login'><?php echo $_smarty_tpl->tpl_vars['login']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['hora']->value;?>
</span>
</div>
<?php }
}
}
