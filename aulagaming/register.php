<?php
require "config/config.php";
require "config/config-register.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
	<a href="inicio.php">Inicio</a>
	<link rel="stylesheet" type="text/css" href="">
	<link rel="stylesheet" type="text/css" href="css/base.css">
</head>
<body>
	<div class="container">
		<h1>Registro</h1>
		<form id="" name="" action="" method="post">
			<label for="email">Usuario:</label>
			<input type="text" id="email" name="email" required>

			<label for="nombre">Nombre:</label>
			<input type="text" id="nombre" name="nombre" required>

			<label for="apellido">Apellido:</label>
			<input type="text" id="apellido" name="apellido" required>

			<label for="contraseña">Contraseña:</label>
			<input type="contraseña" id="contraseña" name="contraseña" required>

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
			//header( "refresh:2; url=login.php" );	
			}	
		}
		?>
	</div>
</body>
</html>