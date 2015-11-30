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
        <script>
          function validarDatosPOST(){
            var verificar=true;

            if(!document.validar_robot.nombre_robot.value){
              alert("Tu nombre, robot, ¡por favor!");
              document.validar_robot.nombre_robot.focus();
              verifica = false;
            } else if (!document.validar_robot.contraseña.value){
              alert("Tu contraseña, robot, Por favor.");
              document.validar_robot.contaseña.focus();
              verificar = false;
            }
            if(verificar){
              document.validar_robot.submit();
            }
          }

          window.onload = function (){
              document.getElementById("ingresar").onclick = validarDatosPOST;
          }
        </script>
  </head>
        <body>
            <header><b>LET'S GO TO CODE</b></header>

          	<div id="contenedor">
                <h1>BUENOS DÍAS</h1>
                <div id="formulario"><!--Aquí va el formulario-->
                  <form name="validar_robot" action="validar-datos.php" method="post"
                  enctype="application/x-www-form-urlencoded">
                    <div class="input">
                      <input type="text" name="nombre_robot" placeholder="Usuario" />
                    </div>
                    <div class="input">
                      <input type="password" name="contraseña" placeholder="Contraseña"   />
                    </div>
                    <!--div id=msj-->
                  <div id="mensaje">Pérame</div>
                    <!--Termina id msj-->
                    <input type="hidden" name="enviar_hdn" value="post" />
                  <button id="ingresar" name="enviar_btn" type="submit"><h2>¡Listo!</h2></button>
                  <!--<div id="form-footer">Gracia</div>-->
                  <a id="boton" href="http://www.google.com.mx">Nuevo registro</a>
              </div>
                </form>

              </div>

              <footer>
                 <p>&#128169;</p>
               </footer>

      </body>
</html>
