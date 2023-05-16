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
    <title>Consulta Reservas - Aula Gaming </title>
 </head>
 <?php
  error_reporting(0);
  require("config/config.php");
  require("config/config-reserva.php");
  $conn = conexion();
  if (isset($_COOKIE["reserva"])) {
    $reserva = $_COOKIE["reserva"];
    list($dia, $mes, $anio) = explode("-", $reserva);
    $f_reserva=$anio."-".$mes."-".$dia;
    $cont=ordenadoresLibres($conn,$f_reserva);
  if ($cont == 20){
    header( "refresh:3; url=calendar.php" );
  }else{

  ?>
 <body onload="iniciarParticulas()" >
 <div id="particles-js"></div>
  <?php
    session_start();
    if(isset( $_SESSION['usuario'])){
		$nb=$_SESSION['usuario'];
    }else{
        header("location: index.php");
       
    }
  
  ?>
    <br/><br/>
    <a href="inicio.php">Inicio</a><br><br>
    <?php
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
              $ord=ordenadoresHoy($conn,$_COOKIE["reserva"],$_COOKIE["turno"]);
              for($i=1;$i<11;$i++){
                if(substr($ord,$pri,$seg)==$i){
                echo "<label class='checkeable'>
                <input type='radio' name='cap' value=$i disabled=true/>
                <img class='pc' src='img/pc-cogido.png'/>
                </label>";
                $pri++;
                $seg++;
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
  <?php
    $restantes=20-$cont;
    echo "Quedan ".$restantes." ordenadores disponibles entre la mañana y la tarde.";

  ?>
    <br/>
<?php



if(!empty($_POST)){
  $turno=$_COOKIE["turno"];
  $pc=$_POST["cap"];
  if($pc==""){
    echo "<p id='err'>ERROR: No has seleccionado ningun PC</p>";
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
      echo "No puedes reservar más de 3 ordenadores a la vez por usuario.";
      $comprobaciones = false;
    }
    if ($yareservadodia == true) {
      echo "No puedes reservar más de un ordenador por día.";
      $comprobaciones = false;
    }
    if ($anio==0000 || $mes==00 || $dia==00){
      echo "Ha habido un problema, porfavor vuelva a la página de inicio.";
      $comprobaciones = false;
    }
    if ($meshoy > $mes || $aniohoy != $anio) {
      echo "No puedes reservar un mes anterior al día de hoy.";
      $comprobaciones = false;
    }else{
      if ($diahoy > $dia){
        echo "No puedes reservar un día anterior al día de hoy.";
        $comprobaciones = false;
      }
    }
    if ($diahoy < $dia && $meshoy+1 <= $mes) {
      echo "No puedes reservar ordenadores a un plazo superior de un mes del día actual.";
      $comprobaciones = false;
    }
    if ($ordPillado == true) {
      echo "No puedes reservar ese ordenador porque ya está reservado por otra persona.";
      $comprobaciones = false;
    }
    if ($comprobaciones == true) {
      setcookie("reserva", "$dia-$mes-$anio", time() - 60); // Eliminar Cookie
      reservar($nb,$pc,$f_reserva,$turno);
      echo "El ordenador número ".$pc." se ha reservado correctamente.";
      header( "refresh:3; url=inicio.php" );	
    }
  }

}
}
}else{
  echo "No se ha reservado ningún día o el tiempo ha pasado 1 hora desde la última selección en el calendario.";
}
?>
</body>
</html>