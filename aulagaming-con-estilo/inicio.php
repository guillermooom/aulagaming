<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <title>Inicio - Aula Gaming </title>
 </head>

<body>
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
<a href="index.php">CERRAR SESION</a>
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
        <li><a href="reserva.php">Reservar Ordenador</a></li><br>
        <li><a href="anulareserva.php">Anular Reserva</a></li><br>
        <li><a href="consultareserva.php">Consultar Reservas</a></li><br>
		  </ul>

</body>
</html>