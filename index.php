<?php

  //$user = $_GET["nombre_robot"];
  //$pass = $_GET["contraseña_robot"];

  /*Acceso a la información de la base de datos*/
  /*Información requerida para acceder a la BF:
  host: localhost
  nombreBD: checador
  usuario BD: checador
  password: checador2015
  */

  $servername = "localhost";
  $username = "checador";
  $password = "checador2015";
  $db = "checador";

  // Crear conexión a base de datos
  $conn = mysqli_connect ($servername,$username,$password,$db);

  // Checa el estado de la conexión

  if(!$conn){
    die("conección fallida:" . mysqli_connect_error());
  }
  if(isset($_GET['usuario'])) {
    /*Confirma si el uysuario ya ha proporcionado sus datos por medio del user*/
    $user = $_GET['usuario'];
    $pass = $_GET['pass'];

    /*Ahora tenemos que comparar las variables de $user y $pass con laos valores que están en la base de datos*/
    /*Entonces tenemos que consultar a la base de datos para ver si existe el usuario que está en la variable $user*/
    /*Instrucciones en lenguaje SQL para hacer la consultra para la BD de forma segura, sin permitir hackeo de la bd*/

    $sql = "SELECT usuario, password from Usuario where usuario = '$user' and password = '$pass'";
  /*echo $sql;*/

  /*Para ejecutar la consulta y lo resultado están en la variable $result*/
  $result = mysqli_query($conn, $sql);

  /*$numrws tiene el número de renglones regresados por la consulta del SELECT,* so es iguala 1, entonces el user y pass son válidos, si es 0 son inválido ya sea el user o el pass o ambos*/
  $numrows = mysqli_num_rows($result);

  /*Tareas a realizar  cuando el user y pass son válidos*/
  if($numrows == 1) {
    $fecha = date ("d/m/y");
    $fechadb = date ("Y/m/d");
    $hora = date ("h:i");
      /*Necesitamos guardar la información en la BD */

      /*Necesitamos saber si la hora y fecha son para entrada o salida*/
      $sql = "SELECT * FROM Registro WHERE usuario='$user' and hrSalida='00:00:00' order by id desc limit 1";
      $result=mysqli_query($conn, $sql);
        /*nrSalida : Tenemos el núnmeros de renglones del resultado de la consulta para saber si es hora de entrada o salida*/
        $nrSalida = mysqli_num_rows($result);
        // echo "Número de renglones hrSalida: " .$nrSalida;

        /* Si $nrSalida == 0 que la hora de registro es de entrada, si $nrSalida == 1 entonces el registro de salida */
        if($nrSalida == 0) {
            /*Esto es para hrEntrada*/
            $sql = "INSERT INTO checador.Registro (id, fecha, usuario, hrEntrada, hrSalida) VALUES (NULL,'$fechadb', '$user', '$hora', '')";
            $result=mysqli_query($conn, $sql);
         } else {
          /*Esto es para hrSalida*/
           $sql ="UPDATE checador.Registro SET hrSalida = '$hora' WHERE Registro.usuario='$user' and hrSalida='00:00:00'";
              $result = mysqli_query($conn, $sql);
            //echo $sql."<br/>";
            //echo "mi result =" .$result;
         }
       }
/*Se recomienda siempre cerrar la BD al final después de que ya no se usa */

  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
        <meta charset="utf-8" />
        <title>Registro de Robots</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/main2.css">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato:400,100,300,700,900" rel="stylesheet" type="text/css">

  </head>
        <body>
            <header><b>LET'S GO TO CODE</b></header>

          	<div class="contenedor">
              <?php
              /*Cuando se debe incluir login.html*/
              if(!isset($_GET['usuario'])){
                  /*Cuando se entra al sistema por primera vez entramos acá*/
                  include("login.html");
              } else {
              /*Acá hacemos algo cuando el usuario ya pasó del login */

              /*Definimos cuando mostrar entrada.html */
              if($numrows== 1) {
                /*Llegamos aquí cuando el usuario dio usar y password correctos */
                if($nrSalida==0){

                  /*Cuando se realiza una entrada*/
                  include("entrada.html");
                } else {
                  include ("salida.html");
                }
              } else {
                /*Llegamos aquí cuando el user y /o passwords son incorrectos*/
                include("login-invalido.html");
              }
            }


              ?>
            </div><!--Termina página-->

              <footer>
                 <p>&#128169;</p>
               </footer>
             </body>
</html>
