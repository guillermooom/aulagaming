<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <title>Consulta Reservas - Aula Gaming </title>
 </head>

<body>
<?php
    require("config/config.php");
    require("config/config-anulareserva.php");
    $conn = conexion();
    session_start();
    if(isset( $_SESSION['usuario'])){
		$nb=$_SESSION['usuario'];
    }else{
        header("location: index.php");
       
    }
?>
    <h1>ANULAR RESERVA - AULA GAMING</h1>
		
    <?php
		$datos =inicioUsuario($conn,$nb);
		foreach($datos as $reco){
			$nom=$reco["nombre"];
			$ape=$reco["apellido"];
		}
			echo "<B>Bienvenido/a:</B> ".$nom." ".$ape
	?>
  <br><br>
  <a href="inicio.php">Inicio</a>
  <br><br>
  <a href="index.php">CERRAR SESION</a>
  
  <br><br>
      <h3>Reservas Activas</h3>
  <?php

    $hoy=date("Y-m-d");

    $nb=$_SESSION['usuario'];
        $datos=consultaReserva($conn,$nb,$hoy);
        if($datos==null)
          echo "Todavia no has realizado reserva<br>Si deseas reservar visita <a href='../reserva.php'>Reservar PC</a>";
        else{
          foreach($datos as $dat){
            if($dat["fecha_reserva"]>$hoy){
              echo "Dia: ".$dat["fecha_reserva"]." --- Ordenador: ".$dat["id"]." --- Turno: ".$dat["turno"]."
              <form id='formu' name='formu' method='post'>
              <input type='hidden' name='fecha' value='".$dat["fecha_reserva"]."'>
              <input type='submit'  name='submit' value='Cancelar' >
            </form><br> ";
            }
          }
        }
        if(!empty($_POST)){
          $nb=$_SESSION['usuario'];
          $dia=$_POST["fecha"];
          borrarReserva($conn,$nb,$dia);

        }
  /*
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
              echo "Dia: ".$dat["fecha_reserva"]." --- Ordenador: ".$dat["id"]." --- Turno: ".$dat["turno"]." <a href='google.com'>Cancela Reserva</a><br>";
            }else{
              echo "Dia: ".$dat["fecha_reserva"]." --- Ordenador: ".$dat["id"]." --- Turno: ".$dat["turno"]."<br>";
            }
          }
        }
    }
}*/
?>

</body>
</html>
