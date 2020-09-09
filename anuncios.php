<?php

/* Incluimos otras clases y ficheros necesarios */
require_once 'accesoDB.php';

/*
 * Clase que gestiona todo lo referente a los anuncios.
 */
class Anuncios
{
    protected $id_anuncio;
    protected $autor;
    protected $moroso;
    protected $localidad;
    protected $descripcion;
    protected $fecha;

    /* Constructor de la clase */
    public function __construct($id_anuncio, $autor, $moroso, $localidad, $descripcion, $fecha)
    {
        $this->id_anuncio = $id_anuncio;
        $this->autor = $autor;
        $this->moroso = $moroso;
        $this->localidad = $localidad;
        $this->descripcion = $descripcion;
        $this->fecha = $fecha;
    }

    /* Gettes and Setter */

    public function getId_anuncio()
    {
        return $this->id_anuncio;
    }

    public function setid_anuncio($nuevoId_anuncio)
    {
        if (empty($nuevoid_anuncio) || !isset($nuevoId_anuncio) || $nuevoId_anuncio == "") {
            return ("<label class='error'>Debe introducir identificador de anuncio</label>");
        } else {
            //Si  no cumple el patrón.
            if ($nuevoId_anuncio < 0) {
                return ("<label class='error'>Debe introducir identificador de anuncio</label>");
            } else {
                $this->id_anuncio = $nuevoId_anuncio;
            }
        }
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function setAutor($nuevoAutor)
    {
        if (empty($nuevoAutor) || !isset($nuevoAutor) || $nuevoAutor == "") {
            return ("<label class='error'>Debe introducir un autor.</label>");
        } else {
            if (!preg_match("/^[a-zA-Z aéíóúÁÉÍÓÚÑñ0-9_-]{1,20}$/", $nuevoAutor)) {
                return ("<label class='error'>Debe introducir un autor correcto.</label>");
            } else {
                $this->autor = $nuevoAutor;
            }
        }
    }


    public function getMoroso()
    {
        return $this->moroso;
    }

    public function setMoroso($nuevaMoroso)
    {
        if (empty($nuevaMoroso) || !isset($nuevaMoroso) || $nuevaMoroso == "") {
            return ("<label class='error'>Debe introducir un moroso</label>");
        } else {
            //Si  no cumple el patrón.
            if (!preg_match("/^[a-zA-Z0-9ÁÉÍÓÚáéíóú _-]{1,60}$/", $nuevaMoroso)) {
                return ("<label class='error'>Debe introducir un moroso correcto</label>");
            } else {
                $this->moroso = $nuevaMoroso;
            }
        }
    }



    public function getLocalidad()
    {
        return $this->localidad;
    }

    public function setLocalidad($nuevoLocalidad)
    {
        if (empty($nuevoLocalidad) || !isset($nuevoLocalidad) || $nuevoLocalidad = "") {
            return ("<label class='error'>Debe introducir una localidad.</label>");
        } else {
            if (!preg_match("/^[a-zA-Z0-9ÁÉÍÓÚáéíóú, ]{1,60}$/", $nuevoLocalidad)) {
                return ("<label class='error'>Debe introducir una localidad.</label>");
            } else {
                $this->localidad = $nuevoLocalidad;
            }
        }
    }



    public function getDescripcion()
    {
        return $this->descripcion;
    }


    public function setDescripcion($nuevaDescripcion)
    {
        //Si  $valor esta vacío o no esta definido.
        if (empty($nuevaDescripcion) || !isset($nuevaDescripcion) || $nuevaDescripcion = "") {
            return ("<label class='error'>Debe introducir una descripción</label>");
        } else {
            if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ0-9€ ,.\"_-]{1,500}$/", $nuevaDescripcion)) {
                return ("<label class='error'>Debe introducir una descripción correcta.</label>");
            } else {
                $this->descripcion = $nuevaDescripcion;
            }
        }
    }

    public function getFecha()
    {
        return $this->fecha;
    }


    public function setfecha($nuevoFecha)
    {
        if (empty($nuevoFecha) || !isset($nuevoFecha) || $nuevoFecha = "") {
            return ("<label class='error'>Debe introducir una fecha.</label>");
        } else {
            if (!preg_match('(([0-9]{4})([-]{1})([0-9]{2})([-]{1})([0-9]{2}))', $nuevoFecha)) {
                return ("<label class='error'>Fecha Válida:26/07/1984</label>");
            } else {
                $this->fecha = $nuevoFecha;
            }
        }
    }


    /* Valida los datos del anuncio.
     *  Recibe 4 argumentos.
     *  $validadopFecha: Si la fecha es válido.. 
     *  $validadopMoroso: Si nombre del moroso es válido.. 
     *  $validadopLocalidad: Si la localidad es válido.. 
     *  $validadopDescripcion: Si la descripción es válido.. 

     *  return: Devuelve true si todos los datos son válidos.
     */

    public static function validarDatosAnuncio($validadopFecha, $validadopMoroso, $validadopLocalidad, $validadopDescripcion)
    {
        if ($validadopFecha == "" && $validadopMoroso == "" && $validadopLocalidad == "" && $validadopDescripcion == "") {
            return true;
        }
    }


    /* Muestras todos los anuncios y genera la tabla y formulario.
     *  return: un result con los datos del usuario o true si no existe.
     */
    public static function todosLosAnuncios()
    {
        try {
            $arrayanuncios = [];
            $fechaActual = new DateTime(date("d-m-y", time()));
            $consulta = "SELECT id_anuncio,autor,moroso,localidad,descripcion,fecha FROM anuncios ORDER BY fecha DESC";
            $datos = [];
            $resultado = accesoDB::mostrarConsulta($consulta, $datos);

            if ($resultado == '1') {
                return 1;
            } else {
                foreach ($resultado as $valor) {
                    $id_anuncio = $valor['id_anuncio'];
                    $autor = $valor['autor'];
                    $moroso = $valor['moroso'];
                    $localidad = $valor['localidad'];
                    $descripcion = $valor['descripcion'];
                    $fecha = $valor['fecha'];
                    $fechaAnuncio = new DateTime($fecha);
                    $interval = $fechaAnuncio->diff($fechaActual);
                    $dias = $interval->format('%d');
                    $mes = $interval->format('%m');
                    $año = $interval->format('%y');
                    $anuncios = new Anuncios($id_anuncio, $autor, $moroso, $localidad, $descripcion, $fechaAnuncio->format('d-m-Y'));
                    array_push($arrayanuncios, [$anuncios, $dias, $mes, $año]);
                }
                echo "</div>";
                return $arrayanuncios;
                $resultado = null;
                $conexion = null;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }


    /* Función estática que encarga de guardar el anuncio.
     * Parámetros:
     * $anuncio: El objeto del anuncio creado.
     * $stock: La cantidad del producto a actualizar.
     */

    public static function guardaAnuncio(Anuncios $anuncio)
    {

        $consulta = "INSERT INTO anuncios values(:id_anuncio,:autor,:moroso,:localidad,:descripcion,:fecha)";
        $datos = [
            ":id_anuncio" => $anuncio->getId_anuncio(),
            ":autor" => $anuncio->getAutor(),
            ":moroso" => $anuncio->getMoroso(),
            ":localidad" => $anuncio->getLocalidad(),
            ":descripcion" => $anuncio->getDescripcion(),
            ":fecha" => $anuncio->getFecha()
        ];
        accesoDB::ejecutarConsulta($consulta, $datos, "");
    }





    /* Función estática que encarga de actualizar el anuncio.
     * Parámetros:
     * $anuncio: El objeto del anuncio creado.     
     */
    public static function actualizarAnuncio(Anuncios $anuncio)
    {
        $consulta = "update anuncios set moroso=:moroso,localidad=:localidad,descripcion=:descripcion,fecha=:fecha where id_anuncio=:id_anuncio";

        $datos = [
            ":moroso" => $anuncio->getMoroso(),
            ":localidad" => $anuncio->getLocalidad(),
            ":descripcion" => $anuncio->getDescripcion(),
            ":fecha" => $anuncio->getFecha(),
            ":id_anuncio" => $anuncio->getId_anuncio()
        ];

        accesoDB::ejecutarConsulta($consulta, $datos, "");
    }






    /* Función estática que se en carga de eliminar el anuncio.
     * Parámetros:
     * $id_anuncio: El identificador del anuncio
     */
    public static function eliminarAnuncio($id_anuncio)
    {
        $consulta = "DELETE FROM anuncios WHERE id_anuncio=:id_anuncio";
        $datos = [':id_anuncio' => $id_anuncio];
        accesoDB::ejecutarConsulta($consulta, $datos, "");
    }
}
