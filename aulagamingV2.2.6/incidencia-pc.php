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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Registrar Incidencia De Un Ordenador - Aula Gaming </title>
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
    require("config/config-incidencia_pc.php");
    $conn = conexion();
    session_start();
    if(isset( $_SESSION['usuario'])){
		$nb=$_SESSION['usuario'];
    }else{
        header("location: index.php");
       
    }
    echo "<a href='inicio.php'>Inicio</a>";
?>
    <h1>Incidencia Ordenador - AULA GAMING</h1>
    <?php
		$datos =inicioUsuario($conn,$nb);
		foreach($datos as $reco){
			$nom=$reco["nombre"];
			$ape=$reco["apellido"];
		}
			echo "<B>Usuario:</B> ".$nom." ".$ape;
	?>
  <br><br>
  
  <form id="formu" name="formu" method="post">
   Explica brevemente que le pasa al ordenador<br> <textarea type="text" name="exp" maxlength="250" placeholder="Máximo 250 carácteres" ></textarea><br><br>
    <input type="submit"  name="submit" value="Enviar" >
  </form>
       
  <?php
  $rea=true;
  $hoy = date("Y-n-j");
  $datos=consultaPC($conn,$nb,$hoy);
  if($datos==null){
    echo "Sin reserva para este día no puedes registrar una incidencia";
    $continua=false;
    }else{
      foreach($datos as $dat){
        $pc=$dat["id"];
      }
      $continua=true;
  }
  if(consultaInciden($conn,$hoy,$nb)!=null){
    echo "<script>
    Swal.fire({
      icon: 'warning',
      title: 'Opps...',
      text: 'Ya has registrado una incidencia el dia de hoy',  
      }).then((xd) => {
       if(xd){
           window.location= 'inicio.php';
       }
      });
     
</script>";
    $rea=false;
  }
if(!empty($_POST)){
    if($rea && $continua){
        $text=$_POST["exp"];
        registraInciden($conn,$hoy,$text);
        ordenadorRoto($conn,$pc);
        echo "<script>
                 Swal.fire({
                   icon: 'success',
                   title: 'Enhorabuena',
                   text: 'Tu incidencia ha sido registrada',  
                   }).then((xd) => {
                    if(xd){
                        window.location= 'inicio.php';
                    }
                   });
                  
         </script>";
    }else{
      echo "<script>
                 Swal.fire({
                   icon: 'error',
                   title: 'Error',
                   text: 'Para poder registar una incidencia debes tener una reserva',  
                   }).then((xd) => {
                    if(xd){
                        window.location= 'incidencia-pc.php';
                    }
                   });
                  
         </script>";
    }
}
?>

</body>
</html>