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
    $permisos = permisos($conn,$nb);
    $responsable = responsable($conn,$nb);
    }else{
        header("location: index.php");
       
    }
    echo "<a href='index.php'>CERRAR SESIÓN</a>";
?>
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
        <?php
          if ($permisos == null){ //Usuarios normales
        ?>
        <li><a href="calendar.php">Reservar Ordenador</a></li><br>
        <li><a href="anulareserva.php">Anular Reserva</a></li><br>
        <li><a href="consultareserva.php">Consultar Reservas</a></li><br>
        <li><a href="incidencia-pc.php">Registrar Incidencia De Un Ordenador</a></li><br>
        <?php
          if ($responsable == 1){
        ?>
        <li><a href="incidencia.php">Registrar Incidencia</a></li><br>
        <?php 
        }
        ?>
        <?php 
        } if ($permisos == 1){ //Usuarios administradores
        ?>
        
        <li><a href="calendar.php">Reservar Ordenador</a></li><br>
        <li><a href="anulareserva.php">Anular Reserva</a></li><br>
        <li><a href="consultareserva.php">Consultar Reservas</a></li><br>
        <li><a href="incidencia-pc.php">Registrar Incidencia De Un Ordenador</a></li><br>
        <?php
          if ($responsable == 1){ 
        ?>
        <li><a href="incidencia.php">Registrar Incidencia</a></li><br>
        <?php 
        }
        ?>
        <li><a href="consultavetados.php">Consultar Vetados</a></li><br>
        <li><a href="consultarincidencias.php">Consultar Incidencias</a></li><br>
        <?php 
        } if ($permisos == 2){  //Usuarios administradores superiores
        ?>
        <li><a href="Avetados.php">Administrar Vetados</a></li><br>
        <li><a href="consultarincidencias.php">Consultar Incidencias</a></li><br>
        <li><a href="Ausuarios.php">Administrar Usuarios</a></li><br>
        <li><a href="Aconsultas.php">Administrar Consultas</a></li><br>
        <li><a href="Aadmin.php">Añadir Administrador</a></li><br>
        <?php 
        }
        ?>
		  </ul>
    <?php
      if ($responsable == 1){
        echo "<h3 style='color: lightblue' >Eres responsable el día de hoy</h3>";
      }
    ?>
</body>
</html>