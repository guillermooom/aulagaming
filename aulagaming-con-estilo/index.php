<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <title>Inicio - Aula Gaming</title>
 </head>

<body>
<?php
    require("config/config.php");
    require("config/config-index.php");
    $conn = conexion();
    setcookie("PHPSESSID","",time()-3600,"/");       
    
?>
    <h1>AULA GAMING LEONARDO</h1>
	<br>
    <a href="register.php">Registrarse</a>
    <br><br>
    <a href="login.php">Iniciar Sesion</a>
    
</body>
</html>