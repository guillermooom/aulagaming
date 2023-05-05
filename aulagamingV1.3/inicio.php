<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="img/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/particle.css">
    <script type="text/javascript" src="js/particles.min.js"></script>
    <script type="text/javascript" src="js/particles.js"></script>
    <title>Inicio - Aula Gaming </title>
 </head>

<body onload="iniciarParticulas()">
<div id="particles-js"></div>
<?php
    require("config/config.php");
    require("config/config-inicio.php");
    $conn = conexion();
    session_start();
    if(isset( $_SESSION['usuario'])){
		$nb=$_SESSION['usuario'];
    }else{
        header("location: index.php");
       
    }
?>
<a href="index.php">CERRAR SESIÓN</a>
    <h1>INICIO AULA GAMING</h1>
		
    <?php
		$datos =inicioUsuario($conn,$nb);
		foreach($datos as $reco){
			$nom=$reco["nombre"];
			$ape=$reco["apellido"];
		}
			echo "<B>Bienvenido/a:</B> ".$nom." ".$ape
	?>
  <br><br>
  
  <br>
      <ul>
        <li><a href="calendar.php">Reservar Ordenador</a></li><br>
        <li><a href="anulareserva.php">Anular Reserva</a></li><br>
        <li><a href="consultareserva.php">Consultar Reservas</a></li><br>
		  </ul>
</body>
</html>