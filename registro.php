<!DOCTYPE html>
<?php
  /*1- Presentar formulario cuando es llamado por 1era vez
  http://localhost/checador-copia/registro.php
  2.- Determinar si el formulario es llamado con información
    http://localhost/checador/registro.php?usuario=rector&nombre=Ricardo&apPaterno=....
    Para saber si existe o no una variable se usa la función isset(nombre_variable). Ejemplo: isset($_GET['usuario'])
    Se elige la variable que tenga que ver con el campo llabe de la tabla en la BD
    Usuario:
      -usuario*(Cambo llave)
      -nombre
      -apPaterno
      -apMaterno
      -email
      -sexo

      PHP---
      if (isset($_GET['usuario'])){
        //Ejecuta instrucciones cuando la condición es true...

      } else {
        //Ejecuta Instruccionescuando la conidic´pn s false.
      }

  3.- Si no hay información entonces: (PHP: if)
    4.- Presentar formulario punto 1
    5.- De lo contrario (PHP: else):
      Tenemos información del usuario
    6.- Buscar el usuario en la BD (SQL: SELECT)
    7.- Si el usuario existe en la BD (PHP: if)
      8.-Mostrar página con mensaje de que el usuario ya existe con opcion a reintentar
    9.- De lo contrario (PHP:else)
      10. Agrenar el usuario a la BD (SQL: INSERT)
      11. Mostrar página con mensaje de usauario registrado con opción a Acceder al sistema

    */
?>
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
        <header><a href="index.php"><b>BUENOS DÍAS ROBOT</b></a></header>
          	<div class="contenedor">

            <?php
                  if (isset($_GET['usuario'])){
                    /* Aquí vamos si tenemos info */
                    $user = $_GET['usuario'];
                    $nombre = $_GET['nombre'];
                    $apPat = $_GET['apPaterno'];
                    $apMat = $_GET['apMaterno'];
                    $pass = $_GET['password'];
                    $email = $_GET['email'];
                    $sexo = $_GET['sexo'];

                    /*realizar la conexión a la BD*/
                    $servername= "localhost";
                    $username = "checador";
                    $password = "checador2015";
                    $db = "checador";

                  $conn = mysqli_connect($servername, $username, $password, $db);

                  //Checa el estado de la conexión.
                  if(!$conn){
                      die("Conexión fallida: " . mysqli_connect_error());
                    }


                  /*Consulta la BD para saber si existe o no el $user*/
                  $sql ="SELECT usuario FROM Usuario WHERE usuario = '$user'";
                  $result = mysqli_query($conn,$sql);
                  $numrows = mysqli_num_rows($result);

                  if($numrows == 1) {
                    echo "El usuario ya existe<br /><br /><a class='boton' href='registro.php'>Reintenta el registro</a>";

                    } else {
                    /*Agregando el nuevo usuario a la BD*/
                    $sql = "INSERT INTO checador.Usuario (usuario, nombre, apPaterno, apMaterno, email, password, sexo) VALUES('$user', '$nombre', '$apPat', '$apMat', '$email', '$pass', '$sexo')";

                    $result=mysqli_query($conn, $sql);

                  if(!$result){
                      /*So el insert termina en error nos vamos por aquí*/
                      echo "Algo pasó. El registro no fue guardado";

                  } else {
                      echo "El registro fue realizado <br /><br /><a class='boton' href='index.php'>Inicio</a><br/><br />";
                  }
                }
              } else {
                    /*Acá vamos i NO hay info*/
                    include("registro.html");
                  }
            ?>
            </div>

              <footer>
                 <p>&#128169;</p>
               </footer>


      </body>
</html>
