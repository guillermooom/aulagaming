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
    <title>Consultar Vetados - Aula Gaming </title>
 </head>
 <body onload="iniciarParticulas()">
<div id="particles-js"></div>
<?php
    require("config/config.php");
    require("config/config-Avetados.php");
    $conn = conexion();
    session_start();
    if(isset( $_SESSION['usuario'])){
		$nb=$_SESSION['usuario'];
    }else{
        header("location: index.php");
       
    }
    echo "<a href='inicio.php'>Inicio</a>";
?>
    <h1>Consultar Vetados - AULA GAMING</h1>
    <?php
		$datos =inicioUsuario($conn,$nb);
		foreach($datos as $reco){
			$nom=$reco["nombre"];
			$ape=$reco["apellido"];
		}
			echo "<B>Bienvenido/a:</B> ".$nom." ".$ape;
	?>
  <br><br>
  
<?php
    $vetados = consultaVetado($conn);
    if ($vetados == NULL){
      echo "No hay usuarios vetados";
    }else {
      echo "Usuarios vetados: <br/><br/>";
      foreach($vetados as $dat){
          echo "Nombre: ".$dat["nombre"]." Apellido: ".$dat["apellido"]."<br/>";
          echo "Vetado el día: ".$dat["vetado"]." --- Motivo del vetado: ".$dat["info_vetado"]."
        </form><br> ";
      }
    }
?>

</body>
</html>