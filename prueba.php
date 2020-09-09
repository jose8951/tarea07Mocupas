<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<?php

$fechaActual = new DateTime(date("d-m-y", time()));
/*$fecha = $valor['fecha'];
$fechaAnuncio = new DateTime($fecha);
$interval = $fechaAnuncio->diff($fechaActual);
$dias = $interval->format('%d');
$mes = $interval->format('%m');
$año = $interval->format('%y');*/



$fecha="05-09-2020";

$fechaAnuncio = new DateTime($fecha);
$interval = $fechaAnuncio->diff($fechaActual);

echo $interval->format('%d');
echo '<br>';


$dias=$interval->format('%d');
//$mes=$interval->format('%m');
//$año=$interval->format('%y');
echo $dias;
echo ' ';
//echo $mes;
echo ' ';
//echo $año;

echo '<hr>';
$login ='nuevo';
$arrayName=[];
array_push($arrayName, "_".$login);
array_push($arrayName, "_".'datos');
array_push($arrayName, "_".'mas datos');

foreach($arrayName as $valor){
    echo $valor;
    echo '<br>';
}



echo '<hr>';
//si existe la session se va al index
$_SESSION['login'] = 'pepe';
   !isset($_SESSION['login']) ? header('location:index.php') : false;

$b= '+d++Jese+';
 $moroso = str_replace('+','', $b);

 echo "dato".$moroso."marca";

?>

    <script>
        let hola = "hola mundo";
        let pass = "123";
        datos("uno", {
            'login': 'usu1',
            'moroso': 'moros pepe'
        });

        function datos(nombre, datos) {
            switch (nombre) {
                case 'uno':
                    //muestra Object { login: "hola mundo", pass: "123" }
                   
                    let login1 = datos['login'];
                    let moroso1= datos['moroso'];
                    console.log(login1);
                    console.log(moroso1);
                    break;
                case 'dos':
                    let moroso2=datos['moroso'];
                    console.log(moroso2);
                    break;
            }
        }
    </script>
</body>
</html>