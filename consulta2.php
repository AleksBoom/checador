<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Control de Asistencias</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,100,300,700,900" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
    <div id="fondo">
        <script>
            var trans = ['trans20','trans40','trans60','trans80','trans100'];
            for(i=0;i<500;i++) {
            ri = Math.floor(Math.random()*5);
            line = '<div id="c'+i+'" class="cuadros '+trans[ri]+'"></div>';
            document.write(line);

    } /* preguntar al prof de donde sale : ri = Math.floor(Math.random()*5);
            line = '<div id="c'+i+'" class="cuadros '+trans[ri]+'"></div>';
            document.write(line) */

        </script>

    </div> <!--termina cuadros-->

    <div id="pagina">
    <header>
        <h1> <strong>VIRTUAL NET</strong></h1>
        <p>Internet, Papeleria, Mantenimiento, Copias, Diseño y Asesoría.</p>
    </header>

    <section id="contenedor">
      <?php
        if(isset($_GET['usuario'])){
          $user= $_GET['usuario'];
        }else{
          $user="";
        }
        ?>
      <h1>Historial: <?php echo $user; ?></h1>
      <?php
      $servername = "localhost";
      $username = "checador";
      $password = "checador2015";
      $db = "checador";
      $hrRetardo= "10:15:00";
      $hrExtra = "14:15:00";
      $conn = mysqli_connect($servername, $username, $password, $db);

      if (!$conn) {
          die("Conección fallida: " . mysqli_connect_error());
      }
        $sql="SELECT *
        FROM Registro
        WHERE usuario= '$user' and fecha >='01-11-2015' AND fecha <='30-11-2015'";
        $result = mysqli_query($conn, $sql);
        $numrows = mysqli_num_rows($result);
      ?>
      <table>
        <tr><th>Fecha</th>
        <th>HrEntrada</th>
        <th>HrSalida</th>
        <th>Retardo</th>
        <th>MinExtra<th>
        </tr>
        <?php
        if($numrows>0){
          $numRetardos = 0;
          while($row=mysqli_fetch_assoc($result)){
              if($row["hrEntrada"] > $hrRetardo){
                $esRetardo = "Si";
                $numRetardos = $numRetardos + 1;
              }else{
                $esRetardo = "No";
              }
              if($row["hrSalida"]>$hrExtra){
                $minExtra = date("H:i:s", strtotime("00:00:00") +
                 strtotime($row["hrSalida"]) - strtotime($hrExtra));
              }else {
                $minExtra ="00:00:00";
              }
              echo "<tr>";
                echo "   <td>". $row[fecha] . "</td>";
                echo "   <td>". $row[hrEntrada] . "</td>";
                echo "   <td>". $row[hrSalida] . "</td>";
                echo "   <td>". $esRetardo . "</td>";
                echo "   <td>". $minExtra . "</td>";
              echo "</tr>";
              }
          }

          ?>
      </table>
      <p>
        <strong>Retardos en el mes actual</strong> <br/>
        <strong>Cantidad de hrs extra:</strong><br/>
        <a href="index.php">Inicio</a>
    </section>

    <footer>
        <p>www.virtual.com</p>
    </footer>

</div> <!--termina div id="pagina" -->
</body>
</html>
