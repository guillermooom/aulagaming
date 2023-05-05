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
    <a href="inicio.php">Inicio</a>
    <h1>RESERVAR ORDENADOR</h1>
 
  <br>
  <h3>Seleccione un PC para el día <?php echo $dia."/".$mes."/".$anio ?> </h3>

      <form name="formu" method="post">
        <table>
          <tr>
            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="1"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>
            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="2"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>
            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="3"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>
            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="4"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>
            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="5"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>
          </tr>
          <tr>
            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="6"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>
            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="7"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>
            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="8"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>
            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="9"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>
            <td>
              <label class="checkeable">
                <input type="radio" name="cap" value="10"/>
                <img class="pc" src="img/pc.png"/>
              </label>
            </td>
          </tr>
      </table>
      <br><br>
      Turno: 
      <select name="turno">
        <option value="mañana">Mañana</option>
        <option value="tarde">Tarde</option>
      </select>
      <input style="margin-left: 50px" type="submit"  name="submit" value="Reservar" >
  </form>
  <?php
    $restantes=20-$cont;
    echo "Quedan ".$restantes." ordenadores disponibles entre la mañana y la tarde.";
  ?>
    <br/>
<?php
if(!empty($_POST)){
  $turno=$_POST["turno"];
  $pc=$_POST["cap"];
  if($pc==""){
    echo "<p id='err'>ERROR: No has seleccionado ningun PC</p>";
  }else{
    $comprobaciones = true;
    $diahoy = date("j"); 
    $meshoy = date("n"); 
    $aniohoy = date("Y"); 
    $yareservados=yaReservados($conn,$nb);
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