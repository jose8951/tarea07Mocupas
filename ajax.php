<?php
require_once 'accesoDB.php';
require_once 'funciones.inc.php';
require_once 'Anuncios.php';
require_once 'claseAnunciantes.php';
require_once 'basico.php';
$respuesta = "";
$intentosFallidos = 0;
$loginAntiguo = "";
session_start();



/* Comprobamos que nos viene una opción por Ajax */
if (isset($_POST['opcion'])) {
    // $opcion = $_POST['opcion'];

    switch (recogerdato($_POST['opcion'])) {
        case "mostrar":
            if (isset($_POST["texto"])) {
                $login = filter_input(INPUT_POST, recogerdato('texto'));
                //var_dump($login);
                $smarty->assign('login', $login);
            }
            $smarty->assign('resultado', Anuncios::todosLosAnuncios());
            $respuesta = $smarty->fetch('index.html');
            break;

        case "mostrarLogin":
            $respuesta = "";
            $precargoLogin = "";
            $precargoClave = "";
            $errorLogin = "";
            $errorClave = "";
            $errorGeneral = "";
            $login = "Invitado";

            $smarty->assign('login', $login);
            $smarty->assign('precargoLogin', $precargoLogin);
            $smarty->assign('precargoClave', $precargoClave);
            $smarty->assign('errorLogin', $errorLogin);
            $smarty->assign('errorClave', $errorClave);
            $smarty->assign('errorGeneral', $errorGeneral);

            $respuesta = $smarty->fetch("login.html");
            break;

        case "mostrarRegistrarse":
            $respuesta = "";
            $precargoLogin = "";
            $precargoPassword = "";
            $precargoPassword2 = "";
            $precargoEmail = "";
            $errorLogin = "";
            $errorPassword = "";
            $errorPassword2 = "";
            $errorEmail = "";
            $errorGeneral = "";
            $login = "Invitado";

            $smarty->assign('precargoLogin', $precargoLogin);
            $smarty->assign('precargoPassword', $precargoPassword);
            $smarty->assign('precargoPassword2', $precargoPassword2);
            $smarty->assign('precargoEmail', $precargoEmail);
            $smarty->assign('errorLogin', $errorLogin);
            $smarty->assign('errorPassword', $errorPassword);
            $smarty->assign('errorPassword2', $errorPassword2);
            $smarty->assign('errorEmail', $errorEmail);
            $smarty->assign('errorGeneral', $errorGeneral);

            $respuesta = $smarty->fetch("registro.html");
            break;
            /* Valida los datos del registro del usuario */
        case "validarRegistro":
            $respuesta = "";
            $precargoLogin = "";
            $precargoPassword = "";
            $precargoPassword2 = "";
            $precargoEmail = "";
            $errorLogin = "";
            $errorPassword = "";
            $errorPassword2 = "";
            $errorEmail = "";
            $errorGeneral = "";
            $password = "";
            $password2 = "";
            $email = "";
            $login = "";

            /* Se comprueba validan los datos */
            if (validardatos(filter_input(INPUT_POST, recogerdato('login')), 'login') != "") {
                $errorLogin = validardatos(filter_input(INPUT_POST, recogerdato('login')), 'login');
                $precargoLogin = filter_input(INPUT_POST, recogerdato('login'));
            } else {
                $login = filter_input(INPUT_POST, recogerdato('login'));
                $precargoLogin = filter_input(INPUT_POST, recogerdato('login'));
            }

            if (validardatos(filter_input(INPUT_POST, recogerdato('clave')), 'password') != "") {
                $errorPassword = validardatos(filter_input(INPUT_POST, recogerdato('clave')), 'password');
                $precargoPassword = filter_input(INPUT_POST, recogerdato('clave'));
            } else {
                $precargoPassword = filter_input(INPUT_POST, recogerdato('clave'));
                $password = filter_input(INPUT_POST, recogerdato('clave'));
            }

            if (validardatos(filter_input(INPUT_POST, recogerdato('clave2')), 'password') != "") {
                $errorPassword2 = validardatos(filter_input(INPUT_POST, recogerdato('clave2')), 'password');
                $precargoPassword2 = filter_input(INPUT_POST, recogerdato('clave2'));
            } else {
                $precargoPassword2 = filter_input(INPUT_POST, recogerdato('clave2'));
                $password2 = filter_input(INPUT_POST, recogerdato('clave2'));
            }
            if (validardatos(filter_input(INPUT_POST, recogerdato('email')), 'email') != "") {
                $errorEmail = validardatos(filter_input(INPUT_POST, recogerdato('email')), 'email');
                $precargoEmail = filter_input(INPUT_POST, recogerdato('email'));
            } else {
                $precargoEmail = filter_input(INPUT_POST, recogerdato('email'));
                $email = filter_input(INPUT_POST, recogerdato('email'));
            }
            /* Si no están vaciós */

            if ($login != "" && $password != "" && $password2 != "" && $email != "") {
                $respuesta = $password;
                /* Si coinciden las contraseñas */
                if ($password === $password2) {
                    $consulta = "SELECT login FROM anunciantes WHERE login=:login";
                    $datos = [':login' => $login];
                    //Se comprueba si existe el usuario
                    if (comprobarUsuario($consulta, $datos) == '1') {
                        $consulta = "INSERT INTO anunciantes VALUES(:login,:password,:email,true)";
                        $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
                        try {
                            /* Se guarda el usuario */
                            $anunciante = new Anunciantes($login, $password, $email, "true");
                            $anunciante->guardarAnunciantes($anunciante);
                            $respuesta = "correcto";
                        } catch (Exception $ex) {
                            echo $ex->getMessage();
                        }
                    } else {
                        $errorGeneral = "Ya existe el login";
                    }
                } else {
                    $errorGeneral = "La contraseña debe coincidir";
                }
            } else {
                $errorGeneral = "DEbe comprobar los datos";
            }

            $smarty->assign('precargoLogin', $precargoLogin);
            $smarty->assign('precargoPassword', $precargoPassword);
            $smarty->assign('precargoPassword2', $precargoPassword2);
            $smarty->assign('precargoEmail', $precargoEmail);
            $smarty->assign('errorLogin', $errorLogin);
            $smarty->assign('errorPassword', $errorPassword);
            $smarty->assign('errorPassword2', $errorPassword2);
            $smarty->assign('errorEmail', $errorEmail);
            $smarty->assign('errorGeneral', $errorGeneral);

            if ($errorGeneral != "") {
                $respuesta = $smarty->fetch("registro.html");
            }
            break;

        case "validarLogin":
            $respuesta = "";
            //Recuperamos la sesión
            $precargoLogin = "";
            $precargoClave = "";
            $errorLogin = "";
            $errorClave = "";
            $errorGeneral = "";
            $login = "Invitado";
            /* Se comprueba que son validos el login y la contraseña */
            if (validardatos(filter_input(INPUT_POST, recogerdato('login')), 'login') == "" && validardatos(filter_input(INPUT_POST, recogerdato('clave')), 'password') == "") {

                $intentos = filter_input(INPUT_POST, recogerdato('intentos'));
                $login = filter_input(INPUT_POST, recogerdato('login'));
                $password = filter_input(INPUT_POST, recogerdato('clave'));
                $consulta = "select bloqueado from anunciantes where login=:login";
                $datos = [":login" => $login];
                if ($login == "dwes" && $password == "abc123.") {
                    $errorGeneral = "admin";
                } else {



                    if ($intentos === 1) {
                        $loginAntiguo = $login;
                    }


                    $resultado = accesoDB::mostrarConsulta($consulta, $datos);
                    //Sino existe el usuario mostramos el error;
                    if ($resultado == "1") {
                        $errorGeneral = "No existe el usuario.";
                    } else {

                        foreach ($resultado as $valor) {

                            if ($valor['bloqueado'] == 1) {
                                //Si esta bloqueado mostramos el error de bloqueado
                                $errorGeneral = "Usuario Bloqueado.<br/>Debe esperar que un administrador desbloquee la cuenta.";
                            } else {
                                $errorGeneral = comprobarAcceso($login, $password, true);
                            }
                        }
                    }
                };
            } else {
                //Si supera los tres intentos
                if ($intentos >= 3) {
                    $consulta = "update anunciantes set bloqueado=true WHERE login=:login";
                    $datos = [":login" => $login];
                    accesoDB::ejecutarConsulta($consulta, $datos, "");
                    //Sino son válidos los datos se reenvía al login bloqueando al usuario.
                    $errorGeneral = "Usuario Bloqueado.";
                } else {
                    $errorGeneral = "Usuario Bloqueado.";
                }
            }
            if ($intentos >= 3) {
                $consulta = "update anunciantes set bloqueado=true WHERE login=:login";
                $datos = [":login" => $login];
                accesoDB::ejecutarConsulta($consulta, $datos, "");
                //Sino son válidos los datos se reenvía al login bloqueando al usuario.
            }
            if ($errorGeneral == 1) {
                $errorGeneral = "";
            }


            $smarty->assign('precargoLogin', $login);
            $smarty->assign('precargoClave', $password);
            $smarty->assign('errorLogin', $errorLogin);
            $smarty->assign('errorClave', $errorClave);
            $smarty->assign('errorGeneral', $errorGeneral);
            $respuesta = $smarty->fetch("login.html");


            break;

        case "mostrarCabeceraUsuario":
            /* Muestra la cabecera del usuario logeado */
            $respuesta = "";
            if (isset($_POST['login'])) {
                $login = filter_input(INPUT_POST, recogerdato('login'));
            } else {
                $login = 'Invitado';
            }
            date_default_timezone_set('Europe/Madrid');
            $smarty->assign('hora', date('H:i:s', time()));
            $smarty->assign('login', $login);
            $respuesta = $smarty->fetch("cabecerausuario.html");
            break;

        case "mostrarAgregarAnuncio":
            /* Muestra el formulario de anuncios */
            $respuesta = "";
            //recuperamos el login usu1
            $login = filter_input(INPUT_POST, recogerdato('login'));
            $fecha = date('Y-m-d', time());
            $moroso = "";
            $localidad = "";
            $descripcion = "";
            $errorFecha = "";
            $errorMoroso = "";
            $errorLocalidad = "";
            $errorDescripcion = "";
            $boton = "guardar";

            //si existe el id 88
            if (isset($_POST['id_anuncio'])) {
                $consulta = "SELECT autor,fecha,moroso,localidad,descripcion FROM anuncios WHERE id_anuncio=:id_anuncio";
                $datos = [":id_anuncio" => filter_input(INPUT_POST, recogerdato('id_anuncio'))];
                // $datos = filter_input(INPUT_POST, recogerdato('id_anuncio'));
                // $datos = [':id_anuncio' => $datos];
                $resultado = accesoDB::mostrarConsulta($consulta, $datos);
                $boton = 'modificar';
                if ($resultado != "1") {
                    foreach ($resultado as $valor) {
                        $login = $valor['autor'];
                        $fecha = $valor['fecha'];
                        $moroso = $valor['moroso'];
                        $localidad = $valor['localidad'];
                        $descripcion = $valor['descripcion'];
                    }
                }
            }
            $smarty->assign('boton', $boton);
            $smarty->assign('login', $login);
            $smarty->assign('precargoFecha', $fecha);
            $smarty->assign('precargoMoroso', $moroso);
            $smarty->assign('precargoLocalidad', $localidad);
            $smarty->assign('precargoDescripcion', $descripcion);
            $smarty->assign('errorFecha', $errorFecha);
            $smarty->assign('errorMoroso', $errorMoroso);
            $smarty->assign('errorLocalidad', $errorLocalidad);
            $smarty->assign('errorDescripcion', $errorDescripcion);

            $respuesta = $smarty->fetch('crearanuncio.html');
            break;

        case "mostrarModificarAnuncio":

            /* Muestra el formulario de anuncios con los datos cargados del mismo */
            $respuesta = "";
            //Recuperamos la sesión

            $login = filter_input(INPUT_POST, recogerdato('login'));
            $fecha = "";
            $moroso = "";
            $localidad = "";
            $descripcion = "";
            $errorFecha = "";
            $errorMoroso = "";
            $errorLocalidad = "";
            $errorDescripcion = "";

            if (isset($_POST["id_anuncio"])) {
                $consulta = "select autor,fecha,moroso,localidad,descripcion from anuncios where id_anuncio=:id_anuncio";
                $datos = [":id_anuncio" => filter_input(INPUT_POST, recogerdato('id_anuncio'))];
                $resultado = accesoDB::mostrarConsulta($consulta, $datos);
                $boton = "modificar";
                if ($resultado != "1") {
                    foreach ($resultado as $valor) {
                        $login = $valor["autor"];
                        $fecha = $valor["fecha"];
                        $moroso = $valor["moroso"];
                        $localidad = $valor["localidad"];
                        $descripcion = $valor["descripcion"];
                    }
                }
                if (isset($_POST["eliminar"])) {
                    $boton = "eliminar";
                }
            }
            $smarty->assign('boton', $boton);
            $smarty->assign('login', $login);
            $smarty->assign('precargoFecha', $fecha);
            $smarty->assign('precargoMoroso', $moroso);
            $smarty->assign('precargoLocalidad', $localidad);
            $smarty->assign('precargoDescripcion', $descripcion);
            $smarty->assign('errorFecha', $errorFecha);
            $smarty->assign('errorMoroso', $errorMoroso);
            $smarty->assign('errorLocalidad', $errorLocalidad);
            $smarty->assign('errorDescripcion', $errorDescripcion);

            $respuesta = $smarty->fetch("crearanuncio.html");


            break;

        case "crearAnuncio":
            /* Crea o modifica un anuncio */
            $consulta = "SELECT `AUTO_INCREMENT` as id_anuncio FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'morosos' AND TABLE_NAME   = 'anuncios';";
            $datos = [];
            //Se ejecuta la consulta ver si hay anuncios.
            $resultado = accesoDB::mostrarConsulta($consulta, $datos);
            $id_anuncio = 0;
            if (!$resultado == '1') {
                foreach ($resultado as $valor) {
                    //recogemos el nuevo código de anuncio
                    $id_anuncio = $valor['id_anuncio'];
                }
            }
            $respuesta = "";
            $login = filter_input(INPUT_POST, recogerdato('login'));
            $fecha = "";
            $moroso = "";
            $localidad = "";
            $descripcion = "";
            $boton = "guardar";
            $errorFecha = "";
            $errorMoroso = "";
            $errorLocalidad = "";
            $errorDescripcion = "";
            //Se validan los datos
            if (!validardatos(filter_input(INPUT_POST, recogerdato('fecha')), 'fecha') == "") {
                $errorFecha = validardatos(filter_input(INPUT_POST, recogerdato('fecha')), 'fecha');
                $fecha = filter_input(INPUT_POST, recogerdato('fecha'));
            } else {
                $fecha = filter_input(INPUT_POST, recogerdato('fecha'));
            }
            if (!validardatos(filter_input(INPUT_POST, recogerdato('moroso')), 'moroso') == "") {
                $errorMoroso = validardatos(filter_input(INPUT_POST, recogerdato('moroso')), 'moroso');
                $moroso = filter_input(INPUT_POST, recogerdato('moroso'));
            } else {
                $moroso = filter_input(INPUT_POST, recogerdato('moroso'));
            }
            if (!validardatos(filter_input(INPUT_POST, recogerdato('localidad')), 'localidad') == "") {
                $errorLocalidad = validardatos(filter_input(INPUT_POST, recogerdato('localidad')), 'localidad');
                $localidad = filter_input(INPUT_POST, recogerdato('localidad'));
            } else {
                $localidad = filter_input(INPUT_POST, recogerdato('localidad'));
            }
            if (!validardatos(filter_input(INPUT_POST, recogerdato('descripcion')), 'descripcion') == "") {
                $errorDescripcion = validardatos(filter_input(INPUT_POST, recogerdato('descripcion')), 'descripcion');
                $descripcion = filter_input(INPUT_POST, recogerdato('descripcion'));
            } else {
                $descripcion = filter_input(INPUT_POST, recogerdato('descripcion'));
            }
            if (isset($_POST["id_anuncio"])) {
                $smarty->assign('boton', "modificar");
            }

            $smarty->assign('boton', $boton);
            $smarty->assign('login', $login);
            $smarty->assign('precargoFecha', $fecha);
            $smarty->assign('precargoMoroso', $moroso);
            $smarty->assign('precargoLocalidad', $localidad);
            $smarty->assign('precargoDescripcion', $descripcion);
            $smarty->assign('errorFecha', $errorFecha);
            $smarty->assign('errorMoroso', $errorMoroso);
            $smarty->assign('errorLocalidad', $errorLocalidad);
            $smarty->assign('errorDescripcion', $errorDescripcion);
            //Si los datos no están vacios.
            if ($fecha != "" && $moroso != "" && $localidad != "" && $descripcion != "" && $login != "") {
                /* Si es modificar se modifica el anuncio */
                if (isset($_POST["id_anuncio"])) {
                    $id_anuncio = filter_input(INPUT_POST, recogerdato('id_anuncio'));
                    $anuncio = new Anuncios($id_anuncio, $login, $moroso, $localidad, $descripcion, $fecha);
                    Anuncios::actualizarAnuncio($anuncio);
                    $respuesta = "correcto";
                } else {
                    /* Se crea un anuncio nuevo */
                    $respuesta = "correcto";
                    $anuncio = new Anuncios($id_anuncio, $login, $moroso, $localidad, $descripcion, $fecha);
                    Anuncios::guardaAnuncio($anuncio);
                }
            } else {
                $respuesta = $smarty->fetch("crearanuncio.html");
            }
            /* Se elimina el anuncio */
            if (isset($_POST["eliminar"])) {
                $id_anuncio = filter_input(INPUT_POST, recogerdato('id_anuncio'));
                $respuesta = "correcto";
                Anuncios::eliminarAnuncio($id_anuncio);
            }

            break;

        case "mostrarPreferencias":
            if (isset($_POST['guardar'])) {
                setcookie('colorFondo', filter_input(INPUT_POST, recogerdato('color')), time() + 3600);
            }
            //Si se ha restablecido el fondo se borra la cookie y resfrescamos la página.
            if (isset($_POST['restablecer'])) {
                setcookie('colorFondo', recogerdato('color'), time() - 2);
            }
            //Cargamos la cabecera de la página web.    
            if (isset($_POST['colorFondo'])) {
                $fondo = filter_input(INPUT_POST, recogerdato('colorFondo'));
            }
            $smarty->assign('fondo', $fondo);
            //Cargamos el pie de la página web.
            $respuesta = $smarty->fetch("preferencias.html");
            break;

        case "mostrarDesbloquear":
            //Muestra el formulario de desbloquear.
            $consulta = "SELECT login FROM anunciantes WHERE bloqueado =1 order by login ASC";
            //Se prepara los datos para introducirlos por array.
            $datos = [];
            //Se llama a función mostrarconsulta.
            $resultado = accesoDB::mostrarConsulta($consulta, $datos);
            $smarty->assign('resultado', $resultado);
            //Cargamos el pie de la página web.
            $respuesta = $smarty->fetch("desbloquear.html");
            break;

        case "desbloquear":
            //Se desbloquea el login
            if (isset($_POST['login'])) {
                $login = filter_input(INPUT_POST, recogerdato('login'));

                $consulta = "UPDATE anunciantes SET bloqueado=0 WHERE login=:login";
                $datos = [':login' => $login];
                accesoDB::ejecutarConsulta($consulta, $datos, "");
            }
            $respuesta = "correcto";
            break;
    }
}

/* Se devuelve la respuesta al cliente por Ajax */
echo $respuesta;
