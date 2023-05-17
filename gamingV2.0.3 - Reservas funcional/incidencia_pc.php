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
    <title>Registrar Incidencia - Aula Gaming </title>
 </head>

 <body onload="iniciarParticulas()">
<div id="particles-js"></div>
<?php
    require("config/config.php");
    require("config/config-incidencia_pc.php");
    $conn = conexion();
    session_start();
    if(isset( $_SESSION['usuario'])){
		$nb=$_SESSION['usuario'];
    }else{
        header("location: index.php");
       
    }
?>
    <a href="inicio.php">Inicio</a>
    <h1>Incidencia - AULA GAMING</h1>
    <?php
		$datos =inicioUsuario($conn,$nb);
		foreach($datos as $reco){
			$nom=$reco["nombre"];
			$ape=$reco["apellido"];
		}
			echo "<B>Bienvenido/a:</B> ".$nom." ".$ape;

        
	?>
  <br><br>
  

  <form id="formu" name="formu" method="post">
   Explicacion<br> <textarea type="text" name="exp" maxlength="250"></textarea><br><br>
    <input type="submit"  name="submit" value="Registrar" >
  </form>
       
  <?php
  $rea=true;
  $hoy = date("Y-n-j");
  $datos=consultaPC($conn,$nb,$hoy);
  if($datos==null){
    echo "Sin reserva para este dia no puedes registrar una incidencia";
    $continua=false;
    }else{
      $continua=true;
  }
  if(consultaInciden($conn,$hoy)!=null){
    echo "ya registraste una incidencia hoy";
    $rea=false;
  }
if(!empty($_POST)){
    if($rea){
        $text=$_POST["exp"];
        registraInciden($conn,$hoy,$text);
    }
}
?>

</body>
</html>