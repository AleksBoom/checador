<?php
  $user= $_POST["nombre_robot"];
  $password = $_POST["contraseña"];
  $loginok=false;
  $uservalidok=false;
  $passok=false;

  $usuarios=array ("zuave", "pamela");
  $passwords=array ("chocolate1986", "coneja1988");

  for ($i=0; $i<=2; $i+=1){
    if ($usuarios[$i]==$user){
      if($passwords[$i]==$pass){
        $loginok=true;
        $uservalidok=true;
        $passok=true;
        break;
      }else {
        $loginok=false;
        $passok=false;
      }
    }else {
      $loginok=false;
      $uservalidok=false;
    }
  }

  if(!loginok){
    echo "Lo siento Robot, no estás autorizado";
  } else{
  ?>

  <!DOCTYPE html>
  <html>
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

                	<div id="contenedor">
                      <h1>LO LOGRASTE.</h1>
                  </div>
                  <footer>
                     <p>&#128169;</p>
                   </footer>
                </body>
</html>
<?php
  }
?>
