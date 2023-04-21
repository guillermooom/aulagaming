<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <title>Consulta Reservas - Aula Gaming </title>
 </head>
<style>
    .checkeable input {
  display: none;
}
.checkeable img {
  width: 100px;
  border: 5px solid transparent;
}
.checkeable input {
  display: none;
}
.checkeable input:checked  + img {
  content:url("img/pc-select.png");
}
</style>
<body>
<?php
    require("config/config.php");
    require("config/config-reserva.php");
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
  <a href="inicio.php">Inicio</a>
  <br><br>
  <a href="index.php">CERRAR SESION</a>
  
  <br><br>
      <h3>Seleccione un PC</h3>

            <label class="checkeable">
        <input type="radio" name="cap"/>
        <img class="pc" src="img/pc.png"/>
        </label>

        <label class="checkeable">
        <input type="radio" name="cap"/>
        <img class="pc" src="img/pc.png"/>
        </label>

        <label class="checkeable">
        <input type="radio" name="cap"/>
        <img class="pc" src="img/pc.png"/>
        </label>

        <label class="checkeable">
        <input type="radio" name="cap"/>
        <img class="pc" src="img/pc.png"/>
        </label>

        <label class="checkeable">
        <input type="radio" name="cap"/>
        <img class="pc" src="img/pc.png"/>
        </label>

</body>
</html>