<?php
//Cargamos la funciones.
require_once 'funciones.inc.php';
require_once 'accesoDB.php';
//Cargamos la cabecera de la página web.
require_once 'cabecerausuario.php';
require_once 'basico.php';

!isset($_SESSION) ? session_start() : false;
!isset($_SESSION['login']) ? header('location:index.php') : false;

//Recogemos los datos pasados por el formulario anterior.

//Se genera la consulta para carga los datos de los movimientos.
$consulta = "SELECT login FROM anunciantes WHERE bloqueado=1 order by login asc";
//Se prepara los datos para introducirlos por array.
$datos = [];
//Se llama a función mostrarconsulta.
$resultado = accesoDB::mostrarConsulta($consulta, $datos);

if ($resultado == '1') {
    //Si nos devuelve true quiere decir que el resultado esta vacío.
} else {
    if (isset($_POST['desbloquear'])) {
        $resultado = accesoDB::mostrarConsulta($consulta, $datos);
        //Se genera la tabla donde se mostrarán los usuarios bloqueados.
        foreach ($resultado as $value) {
            $login = $value['login'];
            /* Se recoge el login y se comprueba el estado del check con ese identificador, 
              si es  si esta en on se ejecuta la consulta para borrarlo. */
            if (filter_input(INPUT_POST, recogerdato("_" . $login)) === 'on') {
                $consulta = "UPDATE anunciantes SET bloqueado=0  where login=:login";
                $datos = [':login' => $login];

                accesoDB::ejecutarConsulta($consulta, $datos, "");
                $contador = 0;
            }
        }

        //Se genera el formulario donde se carga los usuarios bloqueados.
        $arrayName = [];
        $contador = 0;
        $consulta = "SELECT login FROM anunciantes WHERE bloqueado=1 ORDER BY login ASC";
        $datos = [];
        //Se ejecuta la consulta para mostrar los anunciantes bloqueados.
        $resultado = accesoDB::mostrarConsulta($consulta, $datos);
        if ($resultado == '1') {
            foreach ($resultado as $valor) {
                $login = $valor['login'];
                array_push($arrayName, "_" . $login);
            }
        } else {
            foreach ($resultado as $valor) {
                $login = $valor['login'];
                array_push($arrayName, "_" . $login);
            }
        }
    }else{
        $arrayName=[];
        $contador=0;
        $consulta="SELECT login FROM anunciantes WHERE bloqueado =1 ORDER BY login ASC";
        $datos=[];
        $resultado=accesoDB::mostrarConsulta($consulta,$datos);

        foreach($resultado as $valor){
            $login=$valor['login'];
            array_push($arrayName, "_".$login);
        }

        $smarty->assign('resultado',$resultado);
        $smarty->display('desbloquear.html');
    }
}
