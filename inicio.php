<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio - Aula Gaming </title>
 </head>

<body>
<?php
    require("inicio-funciones.php");
    $conn = conexion();
    session_start();
    if(isset( $_SESSION['usuario'])){
		$nb=$_SESSION['usuario'];
    }else{
        session_destroy();
        setcookie("PHPSESSID","",time()-3600,"/");
        header("location: elogin.php");
       
    }
?>
    <h1>INICIO AULA GAMING</h1>
		
    <?php
		$datos =inicioUsuario($conn,$nb);
		foreach($datos as $reco){
			$nom=$reco["nombre"];
			$ape=$reco["apellido"];
			$saldo=$reco["saldo"];
		}
			echo "<B>Bienvenido/a:</B> ".$nom." ".$ape
	?>

        <ul>
			<li><a href="">Reservar Ordenador</a></li>
			<!-- <li><a href="">Anular Reserva</a></li> -->
			<li><a href="">Consultar Reservas</a></li> 		 
			<li><a href="">Ver Torneos</a></li>  		 
		</ul>

</body>
</html>