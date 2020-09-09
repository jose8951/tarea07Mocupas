<?php

require_once 'accesoDB.php';

/* Aquí vamos a encontrar todas las funciones que usan las distintas páginas web de la aplicación. */

/* Recibie un dato y pasar los filtros recomendados para evita sql injection.
 * Recibe un argumento:
 * $data: Es el dato que se le pasarán los filtros.
 * return: $data: Devuelve el dato filtrado. */

function recogerdato($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/* Valida el dato del formulario que se le pase por argumento 
 y devuelve el error o true si es correcto.  Recibe dos argumentos.
 * $valor: Valor que se comprueba si es válido.
 * $campo: Es el name del campo que se va comprobar. */

function validardatos($valor, $campo)
{
    switch ($campo) {
        case 'usuarioAdmin':
            //Si  $valor esta vacío o no esta definido.
            if (empty($valor) || !isset($valor) || $valor == "") {
                return "Debe introducir usuario correcto";
            } else {
                //Si  no cumple el patrón.
                if (!preg_match("/^[a-zA-Z0-9]*$/", $valor)) {
                    return "Debe introducir sole letras y números";
                } else {
                    //Si  si es igual daw.ç
                    if ($valor === "dwes") {
                    } else {
                        return "Debe introducir un usuario correcto";
                    }
                }
            }
            break;
        case 'claveAdmin':
            //Si  $valor esta vacío o no esta definido.
            if (empty($valor) || !isset($valor) || $valor == "") {
                return "<label class='error'>Debe introducir una clave correcta </label>";
            } else {
                //Si  no cumple el patrón.
                if (!preg_match("/^[a-zA-Z0-9.]*$/", $valor)) {
                    return "<label class='error'>Debe introducir solo letras</label>";
                } else {
                    //Si  si es igual daw.
                    if ($valor === 'abc123.') {
                        //vacio
                    } else {
                        return "<label class='error'>Debe introducir una clave correcta</lable>";
                    }
                }
            }
            break;

        case 'login':
            //Si  $valor esta vacío o no esta definido.
            if (empty($valor) || !isset($valor) || $valor == "") {
                return ("Debe introducir un login.");
            } else {
                //Si  no cumple el patrón.
                if (!preg_match("/^[a-zA-Z0-9 _-]{1,20}$/", $valor)) {
                    return ("Debe introducir un login correcto");
                } else {
                    //vacio
                }
            }
            break;

        case 'password':
            //Si  $valor esta vacío o no esta definido.
            if (empty($valor) || !isset($valor) || $valor == "") {
                return ("Debe introducir una clave correcta.");
            } else {
                //Si  no cumple el patrón.
                if (!preg_match("/^[a-zA-Z0-9._-]{1,128}$/", $valor)) {
                    return ("Debe introducir solo letras o . o - o _");
                } else {
                    //vacio
                }
            }
            break;
        case 'moroso':
            //Si  $valor esta vacío o no esta definido.
            if (empty($valor) || !isset($valor) || $valor == "") {
                return "Debe introducir un moroso.";
            } else {
                //Si  no cumple el patrón.
                if (!preg_match("/^[a-zA-Z0-9ÁÉÍÓÚáéíóú _-]{1,60}$/", $valor)) {
                    return "Debe introducir un moroso correcto";
                } else {
                    //vacio
                }
            }
            break;
        case 'localidad':
            //Si  $valor esta vacío o no esta definido.
            if (empty($valor) || !isset($valor) || $valor == "") {
                return "Debe introducir una localidad";
            } else {
                //Si  no cumple el patrón.
                if (!preg_match("/^[a-zA-Z0-9,ÁÉÍÓÚáéíóú, ]{1,60}$/", $valor)) {
                    return "debe introducir una localidad correcta";
                } else {
                    //vacio
                }
            }
            break;
        case 'descripcion':
            //Si  $valor esta vacío o no esta definido.
            if (empty($valor) || !isset($valor) || $valor = "") {
                return "Debe introducir una descripcion";
            } else {
                //Si  no cumple el patrón.
                if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ0-9€ ,.\"_-]{1,500}$/", $valor)) {
                    return "Debe introducir una descripcion correcta";
                } else {
                    //vacio
                }
            }
            break;
        case 'email':
            //Si  $valor esta vacío o no esta definido.
            if (empty($valor) || !isset($valor) || $valor == "") {
                return "Debe introducir un email";
            } else {
                //Si  no cumple el patrón.
                if (!preg_match("/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/", $valor)) {
                    return "email válido example@example.com";
                } else {
                    //vacio
                }
            }
            break;
        case 'nombre':
            //Si  $valor esta vacío o no esta definido.
            if (empty($valor) || !isset($valor) || $valor == "") {
                return "Debe introducir un nombre";
            } else {
                //Si  no cumple el patrón.
                if (!preg_match("/^[a-zA-Z ÁáÉéÍíÓoÚu]{1,30}$/", $valor)) {
                    return "Debe introducir un nombre correcto";
                } else {
                    //vacio
                }
            }
            break;
        case 'fecha':
            //Si  $valor esta vacío o no esta definido.
            if (empty($valor) || !isset($valor) || $valor == "") {
                return "<label class='error'>Debe introducir una fecha</label>";
            } else {
                if (!preg_match('(([0-9]{4})([-]{1})([0-9]{2})([-]{1})([0-9]{2}))', $valor)) {
                    return "Fecha válida 26/07/1984";
                } else {
                    //vacío
                }
            }
            break;

        default:
            break;
    }
}

/* Carga un dato de la url sin filtros  que se para por argumento. 
 * Se usa para cargar los datos desde la url seán válidos o no.
 *  Recibe un argumento.
 *  $dato: Es el name del campo que se va precargar. */
function precargarDato($dato)
{
    if (isset($_POST[$dato])) {
        return $_POST[$dato];
    }
    if (isset($_GET[$dato])) {
        return $_GET[$dato];
    }
}

/* Valida los datos el usuario a registrar.
 *  Recibe 4 argumentos.
 *  $validadologin: Si el login es válido. 
 *  $validadopPassword: Si el  password es válido.
 *  $validadopPassword2: Si el  password2 es válido.
 *  $validadopEmail: Si el  email es válido.

 *  return: Devuelve true si todos los datos son válidos.
 */
function validardatosUsuario($validadologin, $validadopPassword, $validadopPassword2, $validadopEmail)
{
    if ($validadologin == "" && $validadopPassword == "" && $validadopPassword2 == "" && $validadopEmail == "") {
        if (filter_input(INPUT_POST, recogerdato('password')) === filter_input(INPUT_POST, recogerdato('password2'))) {
            return true;
        } else {
            echo "<label class='error'>la contraseña debe coincidir<br></label>";
        }
    };
}

/* Comprueba si es valido el login y la contraseña introducida.
 *  Recibe 4 argumentos.
 * $login:Es  el login recogido.
 *  $password: Es el password recogido. 
 *  $usuarioAdmin: Es el usuario con el ejecutamos la consulta. 
 * $claveAdmin:Es la contraseña del usuario con el que ejecutamos la consulta.
 */
function comprobarAcceso($login, $password, $ajax)
{
    if ($login == 'dwes' && $password == 'abc123.') {
        if ($ajax != true) {
            require_once 'menuusuarioregistrado.php';
        } else {
            return "admin";
        }
    } else {

        $consulta = "SELECT login,password,bloqueado FROM anunciantes
    WHERE login=:login";

        $datos = [":login" => $login];
        //Comprobamos que existe el usuario en la bae de datos.

        if ((comprobarUsuario($consulta, $datos)) == 1) {

            if ($_SESSION['Intentos'] >= 3) {
                $consulta = "update anunciantes set bloqueado=true WHERE login=:login";
                $datos = [":login" => $login];
                accesoDB::ejecutarConsulta($consulta, $datos, "");
                if ($ajax != true) {
                    (header('location:index.php?login=' . filter_input(INPUT_POST, recogerdato('login')) . '&clave=' . filter_input(INPUT_POST, recogerdato('clave')) . '&bloqueado=bloqueado&gestionarmicuenta=Gestionar mi cuenta'));
                } else {
                    //      return "Usuario Bloqueado.<br/>Debe esperar que un administrador desbloquee la cuenta.";
                }
                $_SESSION['Intentos'] = 0;
            } else {
                //Sino existe se reenvia al login
                if ($ajax != true) {
                    (header('location:index.php?login=' .
                        filter_input(INPUT_POST, recogerdato('login')) . '&clave=' .
                        filter_input(INPUT_POST, recogerdato('clave')) . '&gestionarmicuenta=Gestionar mi cuenta'));
                } else {
                    return "No existe el usuario";
                }
            }
        } else {
            $resultado = accesoDB::mostrarConsulta($consulta, $datos);
            foreach ($resultado as $valor) {
                $passwordHash = $valor['password'];
                $bloqueado = $valor['bloqueado'];
            }

            if (password_verify($password, $passwordHash)) {
                if ($bloqueado) {
                    (header('location:index.php?login=' .
                        filter_input(INPUT_POST, recogerdato('login')) . '&clave=' .
                        filter_input(INPUT_POST, recogerdato('clave')) . '&bloqueado=bloqueado&gestionarmicuenta=Gestionar mi cuenta'));
                } else {
                    if ($ajax != true) {
                        require_once 'menuusuarioregistrado.php';
                    } else {
                        return true;
                    }
                    $_SESSION['login'] = $login;
                }
            } else {

                if ($ajax != true) {
                    $_SESSION['Intentos'] = $_SESSION['Intentos'] + 1;
                    if ($_SESSION['Intentos'] >= 3) {
                        $consulta = "update anunciantes set bloqueado=true WHERE login=:login";
                        $datos = [":login" => $login];
                        accesoDB::ejecutarConsulta($consulta, $datos, "");

                        (header('location:index.php?login=' .
                            filter_input(INPUT_POST, recogerdato('login')) . '&clave=' .
                            filter_input(INPUT_POST, recogerdato('clave')) . '&bloqueado=bloqueado&gestionarmicuenta=Gestionar mi cuenta'));
                        $_SESSION['Intentos'] = 0;
                    } else {
                    }
                } else {
                    //Sino existe se reenvia al login
                    if ($ajax != true) {
                        (header('location:index.php?login=' . 
                        filter_input(INPUT_POST, recogerdato('login')) . '&clave=' . 
                        filter_input(INPUT_POST, recogerdato('clave')) . '&gestionarmicuenta=Gestionar mi cuenta'));
                    } else {
                        return "Compruebe el usuario y contraseña";
                    }
                }
            }
        }
    }
}


/* Comprueba si existe el usuario.
 *  Recibe 4 argumentos.
 * $consulta:Es la consulta en string.
 *  $usuarioAdmin: Usuario con el ejecutamos la consulta. 
 *  $claveAdmin: Contraseña del usuario con el ejecutamos la consulta. 
 * $datos:Es el array de datos que pasamos los datos por parámetro.
 *  return: Devuelve true si no existe.
 */
function comprobarUsuario($consulta, $datos)
{
    $conexion = accesoDB::conectaDb();
    try {
        $result = $conexion->prepare($consulta);
        $result->execute($datos);
        if (!$result) {
            print "<p>Error en la consulta</p>";
        } else {
            if ($result->RowCount() > 0) {
                //vacío
            } else {
                return TRUE;
            }
        }
        //desconectamos de la bd
        $result = null;
        $conexion = null;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
