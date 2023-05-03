<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <script src="https://code.jquery.com/jquery.js"></script>
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
    <a href="inicio.php">Inicio</a>
    <h1>ANULAR RESERVA</h1>
  
  <br><br>
      <h3>Reservas Activas</h3>
  <?php

    $hoy=date("Y-m-d");

    $nb=$_SESSION['usuario'];
        $datos=consultaReserva($conn,$nb,$hoy);
        if($datos==null)
          echo "Todavia no has realizado reserva<br>Si deseas reservar visita <a href='reserva.php'>Reservar PC</a>";
        else{
          foreach($datos as $dat){
            if($dat["fecha_reserva"]>$hoy){
              echo "Dia: ".$dat["fecha_reserva"]." --- Ordenador: ".$dat["id"]." --- Turno: ".$dat["turno"]."
              <form id='formu' name='formu' method='post'>
              <input type='hidden' name='fecha' value='".$dat["fecha_reserva"]."'><br>
              <input type='submit'  name='submit' value='Cancelar' >
            </form><br> ";
            }
          }
        }
        if(!empty($_POST)){
          $nb=$_SESSION['usuario'];
          $dia=$_POST["fecha"];
          echo "<script>alert('Reserva Cancelada');</script>";
          borrarReserva($conn,$nb,$dia);

        }
?>

</body>
</html>