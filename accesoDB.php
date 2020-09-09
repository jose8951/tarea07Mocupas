<?php

/*
 * Clase que se encarga de gestionar todo lo relacionado con la 
 * base de datos. 
 */

class accesoDB
{
    /* Método que se conecta a la base de datos.
     * return: Devuelve la conexión o el error po defecto.
     */
    public static function conectaDb()
    {
        try {
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_EMULATE_PREPARES, false);
            $dwes = new PDO('mysql:host=localhost;dbname=morosos', 'dwes', 'abc123.', $opciones);
            return $dwes;
        } catch (PDOException $e) {
            print "    <p>Error: No puede conectarse con la base de datos.</p>\n";
            print "\n";
            print "    <p>Error: " . $e->getMessage() . "</p>\n";
            exit();
        }
    }

    /* Método que comprueba si hay datos en la tabla y si hay datos los devuelve.
     * Parámetros:
     * $consulta: Consulta SQL a ejecutar.
     * $datos: Parámetros de la consulta.
     * return: True si esta vació y si hay datos el array.
     */

    public static function mostrarConsulta($consulta, $datos)
    {
        $conexion = self::conectaDb();
        try {
            $result = $conexion->prepare($consulta);
            $result->execute($datos);
          
            if (!$result) {
                print "<p>Error en la consulta</p>\n";
            } else {
                //si encuentra algo devuelve 1
                if ($result->rowCount() > 0) {
                    return $result;
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

     /*  Ejecuta cualquier consulta que no devuelva datos.
     *  Recibe 3 argumentos.
     * $consulta:Consulta en formato de texto.
     * $datos:Array de parámetros a pasar a la consulta.
     * $mensaje:Mensaje a mostrar si ha ido todo correcto.
     */
    public static function ejecutarConsulta($consulta,$datos,$mensaje){
     
       // var_dump($datos);

        try {
            $result=self::conectaDb()->prepare($consulta);
            $result->execute($datos);
            if(!$result){
                echo "Error en la consulta";
            }else{
                 //  echo $mensaje;
            }
             //desconectamos de la bd
             $result=null;
             $conexion=null;
        } catch (Exception $ex) {
          echo $ex->getMessage();
        }
    }

}
