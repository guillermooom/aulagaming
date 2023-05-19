<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="img/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/particle.css">
    <link rel="stylesheet" type="text/css" href="css/formulario.css">
    <script type="text/javascript" src="js/particles.min.js"></script>
    <script type="text/javascript" src="js/particles.js"></script>
    <title>Consultar Incidencias - Aula Gaming </title>
    <style>
        ::selection {
            background-color: #9712FF;
        }
        ::-moz-selection {
            background-color: #9712FF;
        }
    </style>
 </head>
 <body onload="iniciarParticulas()">
<div id="particles-js"></div>
<?php
    require("config/config.php");
    require("config/config-consultarincidencias.php");
    $conn = conexion();
    session_start();
    if(isset( $_SESSION['usuario'])){
		$nb=$_SESSION['usuario'];
    }else{
        header("location: index.php");
       
    }
    echo "<a href='inicio.php'>Inicio</a>";
?>
    <h1>Consultar Incidencias - AULA GAMING</h1>
    <?php
		$datos =inicioUsuario($conn,$nb);
		foreach($datos as $reco){
			$nom=$reco["nombre"];
			$ape=$reco["apellido"];
		}
			echo "<B>Usuario:</B> ".$nom." ".$ape;
	?>
  <br><br>
  
  <p>Selecciona el usuario u ordenador para ver sus incidencias</p>
    <form id="formu" name="formu" method="post">
            Usuario: <select id="nomb" name="nomb" require>
							<?php
								//mostrarUsuarios($conn);
							?>
            </select>
            <br><br>
            PC: <select id="nomb" name="nomb" require>
							<?php
								//mostrarUsuarios($conn);
							?>
            </select>
            <br><br>
        <input type="submit"  name="submit" value="Ver Incidencias">
    </form>
<?php
  /*if(!empty($_POST)){
    $nbvetado=$_POST["nomb"];
    $fecha=$_POST["fecha"];
    $info=$_POST["info"];
    agregarVetado($conn,$nbvetado,$fecha,$info);
    echo "<script>alert('Usuario vetado');</script>";
  }*/
?>

</body>
</html>