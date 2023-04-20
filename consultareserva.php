<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consulta Reservas - Aula Gaming </title>
 </head>

<body>
<?php
    require("funciones/consultareserva-funciones.php");
    $conn = conexion();
    session_start();
    if(isset( $_SESSION['usuario'])){
		$nb=$_SESSION['usuario'];
    }else{
        header("location: index.php");
       
    }
?>
    <h1>RESERVA - AULA GAMING</h1>
		
    <?php
		$datos =inicioUsuario($conn,$nb);
		foreach($datos as $reco){
			$nom=$reco["nombre"];
			$ape=$reco["apellido"];
		}
			echo "<B>Bienvenido/a:</B> ".$nom." ".$ape
	?>
  <br><br>
  <a href="index.php">CERRAR SESION</a>
  <br><br>
  <form id="formu" name="formu" method="post">
    Fecha Desde: <input type="date" name="inicio"><br><br>
    Fecha Hasta: <input type="date" name="fin"><br><br>
    <input type="submit"  name="submit" value="Consultar" >
  </form>
       
  <?php
if(!empty($_POST)){
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
        foreach($datos as $dat){
          echo "Dia: ".$dat["fecha_reserva"]." --- Ordenador: ".$dat["id"]." --- Turno: ".$dat["turno"]."<br>";
        }
    }
}
?>

</body>
</html>