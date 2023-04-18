<?php
require "config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
	<link rel="stylesheet" type="text/css" href="">
</head>
<body>
	<div class="container">
		<h1>Registro</h1>
		<form id="" name="" action="" method="post">
			<label for="usuario">Usuario:</label>
			<input type="text" id="usuario" name="usuario" required>

			<label for="nombre">Nombre:</label>
			<input type="text" id="nombre" name="nombre" required>

			<label for="apellido">Apellido:</label>
			<input type="text" id="apellido" name="apellido" required>

			<label for="curso">Curso:</label>
			<input type="curso" id="curso" name="curso" required>

			<input type="submit" value="Registrarse">
		</form>
		<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
					
			// defino variables
						
			$usuario = "";
			$nombre = "";
			$apellido = "";
			$curso = "";

			//Recojo las variables del formulario

			$usuario = $_POST["usuario"];
			$nombre = $_POST["nombre"];
			$apellido = $_POST["apellido"];
			$curso = $_POST["curso"];
					
			//Limpiamos el valor del nif.
						
			$usuario = test_input($_POST["usuario"]);
			$nombre = test_input($_POST["nombre"]);
			$apellido = test_input($_POST["apellido"]);
			$curso = test_input($_POST["curso"]);
						
			//Miramos los errores:
			$compreg = comprobarregister($usuario,$nombre,$apellido,$curso);
							 
			if ($compreg == true) {
				echo "Corrige los errores.";
			}else {
						  
			//Lamamos a la función indicada.
 		
			registerl($usuario,$nombre,$apellido,$curso);
			header( "refresh:2; url=login.php" );	
			}	
		}
		?>
	</div>
</body>
</html>