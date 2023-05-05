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
    <title>Consulta Reservas - Aula Gaming </title>
 </head>

 <body onload="iniciarParticulas()">
<div id="particles-js"></div>
<?php
    require("config/config.php");
    require("config/config-consultareserva.php");
    $conn = conexion();
    session_start();
    if(isset( $_SESSION['usuario'])){
		$nb=$_SESSION['usuario'];
    }else{
        header("location: index.php");
       
    }
?>
    <a href="inicio.php">Inicio</a>
    <h1>RESERVA - AULA GAMING</h1>
  <br><br>
  

  <form id="formu" name="formu" method="post">
    Fecha Desde: <input type="date" name="inicio"><br><br>
    Fecha Hasta: <input type="date" name="fin"><br><br>
    <input type="submit"  name="submit" value="Consultar" >
  </form>
       
  <?php
if(!empty($_POST)){
  $hoy=date("Y-m-d");
    $realizar=true;
    $inicio=$_POST["inicio"];
    $fin=$_POST["fin"];
    if($inicio==""){
        $inicio="1900-01-01";
    }
    if($fin==""){
      $fin="3000-01-01";
  }
    if($_POST["fin"]<$_POST["inicio"]){
      echo "<p id='err'>ERROR: La fecha de fin es mayor a la de inicio</p>";
        $realizar=false;
    }
    if($realizar){
      
        $nb=$_SESSION['usuario'];
        $datos=consultaPC($conn,$nb,$inicio,$fin);
        if($datos==null)
          echo "Todavia no has realizado reserva";
        else{
          foreach($datos as $dat){
            if($dat["fecha_reserva"]>$hoy){
              echo "Dia: ".$dat["fecha_reserva"]." --- Ordenador: ".$dat["id"]." --- Turno: ".$dat["turno"]."<br><br> <a href='anulareserva.php'>Cancela Reserva</a><br>";
            }else{
              echo "Dia: ".$dat["fecha_reserva"]." --- Ordenador: ".$dat["id"]." --- Turno: ".$dat["turno"]."<br><br>";
            }
          }
        }
    }
}
?>

</body>
</html>