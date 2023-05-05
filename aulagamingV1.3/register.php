<?php
require "config/config.php";
require "config/config-register.php";
?>
<html>
<head>
	<title>Registro</title>
	<meta charset="UTF-8">
	<a href="inicio.php">Inicio</a>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="icon" type="image/png" href="img/favicon.png"/>
	<link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/particle.css">
	<link rel="stylesheet" type="text/css" href="css/formulario.css">
    <script type="text/javascript" src="js/particles.min.js"></script>
    <script type="text/javascript" src="js/particles.js"></script>
</head>
<body onload="iniciarParticulas()">
<div id="particles-js"></div>
	<div class="container">
		<h1>Registro</h1>
		<form id="" name="" action="" method="post">
			<label for="email">Usuario:</label>
			<input type="text" id="email" name="email" size="40" required>
			<br><br>
			<label for="nombre">Nombre:</label>
			<input type="text" id="nombre" name="nombre" required>
			<br><br>
			<label for="apellido">Apellido:</label>
			<input type="text" id="apellido" name="apellido" required>
			<br><br>
			<label for="contraseña">Contraseña:</label>
			<input type="password" id="contraseña" name="contraseña" required>
			<br><br>
			<a href="normativa.php">Normativa:</a>
			<input type="checkbox" id="myCheckbox" name="normativa" required>
			<label id="check" for="myCheckbox"></label>
			<br><br>
			<input type="submit" value="Registrarse">
		</form>
		<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
					
			// defino variables
						
			$email = "";
			$nombre = "";
			$apellido = "";
			$contraseña = "";

			//Recojo las variables del formulario

			$email = $_POST["email"];
			$nombre = $_POST["nombre"];
			$apellido = $_POST["apellido"];
			$contraseña = $_POST["contraseña"];
					
			//Limpiamos el valor del nif.
						
			$email = test_input($_POST["email"]);
			$nombre = test_input($_POST["nombre"]);
			$apellido = test_input($_POST["apellido"]);
			$contraseña = test_input($_POST["contraseña"]);
						
			//Miramos los errores:
			$compreg = comprobarregister($email,$nombre,$apellido,$contraseña);
							 
			if ($compreg == true) {
				echo "Corrige los errores.";
			}else {
						  
			//Lamamos a la función indicada.
			registerl($email,$nombre,$apellido,$contraseña);
			echo "Usuario registrado correctamente.";
			header( "refresh:2; url=index.php" );	
			}	
		}
		?>
	</div>
</body>
</html>
