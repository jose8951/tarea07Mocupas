<?php


//Cargamos la cabecera de la página web.
require_once 'claseAnunciantes.php';
require_once 'funciones.inc.php';
require_once 'basico.php';

$precargoLogin = "";
$precargoPassword = "";
$precargoPassword2 = "";
$precargoEmail = "";
$errorLogin = "";
$errorPassword = "";
$errorPassword2 = "";
$errorEmail= "";
$errorGeneral= "";

if(isset($_POST['guardar'])){
    $precargoLogin = (str_replace('+', ' ', precargarDato('login')));
    $errorLogin = validardatos(filter_input(INPUT_POST, recogerdato('login')), 'login');
    $validadologin = validardatos(filter_input(INPUT_POST, recogerdato('login')), 'login');
    $precargoPassword = (str_replace('+', ' ', precargarDato('password')));
    $errorPassword = validardatos(filter_input(INPUT_POST, recogerdato('password')), 'password');
    $validadopPassword = validardatos(filter_input(INPUT_POST, recogerdato('password')), 'password');

    $precargoPassword2 = (str_replace('+', ' ', precargarDato('password2')));
    $errorPassword2 = validardatos(filter_input(INPUT_POST, recogerdato('password2')), 'password2');
    $validadopPassword2 = validardatos(filter_input(INPUT_POST, recogerdato('password')), 'password');

    $precargoEmail = (str_replace('+', ' ', precargarDato('email')));
    $errorEmail = validardatos(filter_input(INPUT_POST, recogerdato('email')), 'email');
    $validadopEmail = validardatos(filter_input(INPUT_POST, recogerdato('email')), 'email');

     //Si todos los datos son correctos
     if(Anunciantes::validarDatosUsuarios($validadologin, $validadopPassword, $validadopPassword2, $validadopEmail)===true){
        $login = filter_input(INPUT_POST, recogerdato('login'));
        $password = filter_input(INPUT_POST, recogerdato('password'));
        $email = filter_input(INPUT_POST, recogerdato('email'));

        $consulta="SELECT login FROM anunciantes WHERE login=:login";
        $datos=[":login"=>$login];

         //Se comprueba si existe el usuario
         if(comprobarUsuario($consulta, $datos)=='1'){
             $consulta="INSERT INTO  anunciantes values(:login,:password,:email,true)";
             $password=password_hash($password, PASSWORD_BCRYPT,['cost'=>4]);
             try {
                $anunciante=new Anunciantes($login,$password,$email,'true');
                $anunciante->guardarAnunciantes($anunciante);
             } catch (Exception $e) {
                 echo $e->getMessage();
             }
         }else{
            $errorGeneral="Ya existe el login<br/>";
         }
     }else{
         $errorGeneral=Anunciantes::validarDatosUsuarios($validadologin,$validadopPassword,$validadopPassword2,$validadopEmail);
      }
}


$smarty->assign('precargoLogin', $precargoLogin);
$smarty->assign('precargoPassword', $precargoPassword);
$smarty->assign('precargoPassword2', $precargoPassword2);
$smarty->assign('precargoEmail', $precargoEmail);
$smarty->assign('errorLogin', $errorLogin);
$smarty->assign('errorPassword',$errorPassword);
$smarty->assign('errorPassword2', $errorPassword2);
$smarty->assign('errorEmail', $errorEmail);
$smarty->assign('errorGeneral', $errorGeneral);


$smarty->display('registro.tpl');
$smarty->display('pie.tpl');
