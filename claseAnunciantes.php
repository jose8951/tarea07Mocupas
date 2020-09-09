<?php
/* Incluimos otras clases y ficheros necesarios */
require_once 'accesoDB.php';
/*
 * Clase que gestiona todo lo referente a los anunciantes.
 */
class Anunciantes
{
    protected $login;
    protected $password;
    protected $email;
    protected $bloqueado;

    /* Constructor de la clase */
    public function __construct($login, $password, $email, $bloqueado)
    {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->bloqueado = $bloqueado;
    }
    /* Gettes and Setter */
    public function getlogin()
    {
        return $this->login;
    }

    public function setLogin($nuevoLogin)
    {
        if (empty($nuevologin) || !isset($nuevoLogin) || $nuevoLogin == "") {
            return ("<label class='error'>Debe introducir un login</label>");
        } else {
            //Si  no cumple el patrón.
            if (!preg_match("/^[a-zA-Z0-9 _-]{1,20}$/", $nuevoLogin)) {
                return ("<label class='error'>Debe introducir un login correcto</label>");
            } else {
                $this->login = $nuevoLogin;
            }
        }
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($nuevoPassword)
    {
        //Si  $valor esta vacío o no esta definido.
        if (empty($nuevoPassword) || !isset($nuevoPassword) || $nuevoPassword == "") {
            return ("<label class='error'>Debe introducir una clave correcta</label>");
        } else {
            if (!preg_match("/^[a-zA-Z0-9._-]{1,128}$/", $nuevoPassword)) {
                return ("<label class='error'>Debe introducir solo letras o . o - o _</label>");
            } else {
                $this->password = $nuevoPassword;
            }
        }
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($nuevaEmail)
    {
        //Si  $valor esta vacío o no esta definido.
        if (empty($nuevaEmail) || !isset($nuevaEmail) || $nuevaEmail == "") {
            return ("<label class='error'>debe introducir un email</label>");
        } else {
            if (!preg_match("/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/", $nuevaEmail)) {
                return ("<label class='error'>Email válido:  example@example.com</label>");
            } else {
                $this->password = $nuevaEmail;
            }
        }
    }
    public function getBloqueado()
    {
        return $this->bloqueado;
    }

    public function setBloqueado($nuevoBloqueado)
    {
        if (empty($nuevoBloqueado) || !isset($nuevoBloqueado) || $nuevoBloqueado == "") {
            return ("<label class='error'>no esa bloqueado</label>");
        } else {
            $this->bloqueado = $nuevoBloqueado;
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

    public static function validarDatosUsuarios($validadologin, $validadopPassword, $validadopPassword2, $validadopEmail)
    {
        if ($validadologin == "" && $validadopPassword == "" && $validadopPassword2 == "" && $validadopPassword2 == "" && $validadopEmail == "") {
            if (filter_input(INPUT_POST, recogerdato('password')) === filter_input(INPUT_POST, recogerdato('password2'))) {
                return true;
            } else {
                return "La contraseñas debe coincidir<br/>";
            }
        }
    }

    /* Función estática que guarda un anunciante en la base de datos.
     * Parámetros:
     * $anunciante: Objeto de la clase Anunciantes.
     */
    public static function guardarAnunciantes(Anunciantes $anunciante)
    {
        $consulta = "INSERT INTO anunciantes values (:login,:password,:email,true)";
        $datos = [":login" => $anunciante->getLogin(),  ":password" => $anunciante->getPassword(), ":email" => $anunciante->getEmail()];
        accesoDB::ejecutarConsulta($consulta,$datos, "");
    }
}
