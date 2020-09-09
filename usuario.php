<?php
//cargamos las funciones
require_once 'funciones.inc.php';

!isset($_SESSION) ? session_start():false;
//Se valida que tanto el usuario y contraseña del administrador es correcta. Además del el login y contraseña del usuario.

if(validardatos(filter_input(INPUT_POST, recogerdato('usuarioAdmin')), 'usuarioAdmin') == "" && validardatos(filter_input(INPUT_POST, recogerdato('claveAdmin')), 'claveAdmin') == "" && validardatos(filter_input(INPUT_POST, recogerdato('login')), 'login') == "" && validardatos(filter_input(INPUT_POST, recogerdato('clave')), 'password') == "") {   
    $usuarioAdmin =filter_input(INPUT_POST, recogerdato('usuarioAdmin'));

   $usuarioAdmin=filter_input(INPUT_POST, recogerdato('usuarioAdmin'));
   $claveAdmin= filter_input(INPUT_POST, recogerdato('claveAdmin'));
   $login = filter_input(INPUT_POST, recogerdato('login'));
   $password=filter_input(INPUT_POST,recogerdato('clave'));
   $_SESSION['login']=$login;

   comprobarAcceso($login, $password, true);
}else{
     //Se suman un intento
     $_SESSION['Intentos']=$_SESSION['Intentos']+1;
     //Si supera los tres intentos
     if($_SESSION['Intentos'] >=3){
         $consulta="UPDATE anunciantes SET bloqueado=true WHERE login=:login";
         $datos=[":login"=>$login];
         accesoDB::ejecutarConsulta($consulta, $datos, "");
          //Sino son válidos los datos se reenvía al login bloqueando al usuario.
          (header('location:index.php?login=' . filter_input(INPUT_POST, recogerdato('login')) . '&clave=' . filter_input(INPUT_POST, recogerdato('clave')) . '&bloqueado=bloqueado&gestionarmicuenta=Gestionar mi cuenta'));
          $_SESSION['Intentos']=0;

     }else{
         //Sino existe se reenvia al login
         (header('location:index.php?login=' . filter_input(INPUT_POST, recogerdato('login')) . '&clave=' . filter_input(INPUT_POST, recogerdato('clave')) . '&gestionarmicuenta=Gestionar mi cuenta'));
     }
}


//Cargamos el pie de la página web.
$smarty->display('pie.html');
