<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="img/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/particle.css">
    <link rel="stylesheet" type="text/css" href="css/reserva.css">
    <link rel="stylesheet" type="text/css" href="css/formulario.css">
    <script type="text/javascript" src="js/particles.min.js"></script>
    <script type="text/javascript" src="js/particles.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Consulta Reservas - Aula Gaming </title>
 </head>
 <body onload="iniciarParticulas()" >
 <div id="particles-js"></div>
 <?php
  error_reporting(0);
  require("config/config.php");
  require("config/config-reserva.php");
  $conn = conexion();
  if (isset($_COOKIE["reserva"])) {
    $reserva = $_COOKIE["reserva"];
    list($anio, $mes, $dia) = explode("-", $reserva);
    $f_reserva=$anio."-".$mes."-".$dia;
    session_start();
    if(isset( $_SESSION['usuario'])){
		$nb=$_SESSION['usuario'];
    }else{
       header("location: index.php");
       exit();
    }
  
  ?>
    <br/><br/>
    <?php
    echo "<a href='inicio.php'>Inicio</a><br><br>";
		$datos =inicioUsuario($conn,$nb);
		foreach($datos as $reco){
			$nom=$reco["nombre"];
			$ape=$reco["apellido"];
		}
			echo "<B>Bienvenido/a:</B> ".$nom." ".$ape
	?>
    <h1>RESERVAR ORDENADOR</h1>
 
  <br>
  <h3>Seleccione un PC para el día <?php echo $dia."/".$mes."/".$anio ?> </h3>

  <form name="formu" method="post">
        <table>
          <tr>
            <td> 
              <?php
              $pri=0;
              $seg=1;
              $rpti=0;
              $rseg=1;
              $rot=ordenadorMal($conn);
              $or=ordenadoresHoy($conn,$_COOKIE["reserva"],$_COOKIE["turno"]);
              foreach($or as $row) {
                $ord= $ord.strval ($row["id"]);
              }
              foreach($rot as $row) {
                $roto= $roto.$row["id"];
              }
              for($i=1;$i<11;$i++){
                if(substr($roto,$rpri,$rseg)==$i){
                  echo "<label class='checkeable'>
                  <input type='radio' name='cap' value=$i disabled=true/>";
                    if ($i % 2 == 0){
                      echo "<img class='pc' src='img/pc-roto.png'/>";
                    }else{
                      echo "<img class='pc' src='img/pc-roto2.png'/>";
                    }
                  echo "</label>";
                  if($rpri==$rseg){
                    $rpri++;
                    $rseg++;
                  }else{
                    $rpri++;
                  }
                }else if(substr($ord,$pri,$seg)==$i){
                echo "<label class='checkeable'>
                <input type='radio' name='cap' value=$i disabled=true/>
                <img class='pc' src='img/pc-cogido.png'/>
                </label>";
                if($pri==$seg){
                  $pri++;
                  $seg++;
                }else{
                  $pri++;
                }
                }
                else{
                  echo "<label class='checkeable'>
                  <input type='radio' name='cap' value=$i/>
                  <img class='pc' src='img/pc.png'/>
                  </label>";
              }
                if($i==5){
                  echo"</tr><tr>";
                }
              }
              ?>        
      </table>
      
      <br><br>
    
      <input type="submit"  name="submit" value="Reservar" >
  </form>
    <br/>
<?php

if(!empty($_POST)){
  $turno=$_COOKIE["turno"];
  $pc=$_POST["cap"];
  if($pc==""){
    echo "<script>
                 Swal.fire({
                   icon: 'error',
                   title: 'Error',
                   text: 'No has selecionado ningun pc.',  
                   });
         </script>";
    echo "Selecciona un ordenador";
  }else{
 
    $comprobaciones = true;
    $diahoy = date("j"); 
    $meshoy = date("n"); 
    $aniohoy = date("Y"); 
    $yareservados=yaReservados($conn,$nb,$f_reserva);
    echo $yareservados;
    $yareservadodia=yaReservadoDia($conn,$nb,$f_reserva);
    $ordPillado=ordenadorPillado($conn,$f_reserva,$pc,$turno);
    if ($yareservados == 3) {
      echo "<script>
                 Swal.fire({
                   icon: 'error',
                   title: 'Error',
                   text: 'No puedes reservar más de 3 ordenadores a la vez por usuario.',  
                   });
         </script>";
      $comprobaciones = false;
    }
    if ($yareservadodia == true) {
      echo "<script>
                 Swal.fire({
                   icon: 'error',
                   title: 'Error',
                   text: 'No puedes reservar más de un ordenador por día.',  
                   });
         </script>";
      $comprobaciones = false;
    }
    if ($anio==0000 || $mes==00 || $dia==00){
      echo "<script>
                 Swal.fire({
                   icon: 'warning',
                   title: 'Opss..',
                   text: 'Ha habido un problema, porfavor vuelva a la página de inicio.',  
                   });
         </script>";
      $comprobaciones = false;
    }
    if ($meshoy > $mes || $aniohoy != $anio) {
      echo "<script>
                 Swal.fire({
                   icon: 'error',
                   title: 'Error',
                   text: 'No puedes reservar un mes anterior al día de hoy.',  
                   });
         </script>";
      $comprobaciones = false;
    }else{
      if ($diahoy > $dia && $meshoy == $mes){
        echo "<script>
                 Swal.fire({
                   icon: 'error',
                   title: 'Error',
                   text: 'No puedes reservar un día anterior al día de hoy.',  
                   });
         </script>";
        $comprobaciones = false;
      }
    }
    if ($diahoy < $dia && $meshoy+1 <= $mes) {
      echo "<script>
                 Swal.fire({
                   icon: 'warning',
                   title: 'Opss..',
                   text: 'No puedes reservar ordenadores a un plazo superior de un mes del día actual.',  
                   });
         </script>";
      $comprobaciones = false;
    }
    if ($ordPillado == true) {
      echo "<script>
                 Swal.fire({
                   icon: 'warning',
                   title: 'Opss..',
                   text: 'No puedes reservar ese ordenador porque ya está reservado por otra persona.',  
                   });
         </script>";
      $comprobaciones = false;
    }
    if ($comprobaciones == true) {
      setcookie("reserva", "$dia-$mes-$anio", time() - 60); // Eliminar Cookie
      reservar($nb,$pc,$f_reserva,$turno);
      $pc=substr($pc,0,1);
      echo "<script>
                 Swal.fire({
                   icon: 'success',
                   title: 'Enhorabuena',
                   text: 'El ordenador número $pc se ha reservado correctamente.',  
                   });
         </script>";
      header( "refresh:3; url=inicio.php" );	
      exit();
    }
  }
}
}else{
  echo "<script>
                 Swal.fire({
                   icon: 'error',
                   title: 'Error',
                   text: 'No se ha reservado ningún día o el tiempo ha pasado 1 hora desde la última selección en el calendario.',  
                   });
        </script>";
  header( "refresh:3; url=inicio.php" );
}
?>
</body>
</html>