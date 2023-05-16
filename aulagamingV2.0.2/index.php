<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="img/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/particle.css">
    <script type="text/javascript" src="js/particles.min.js"></script>
    <script type="text/javascript" src="js/particles.js"></script>
    <title>Inicio - Aula Gaming</title>
 </head>

<body onload="iniciarParticulas()">
<div id="particles-js"></div>
<?php
    require("config/config.php");
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