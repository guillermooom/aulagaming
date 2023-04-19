<?php

//eregistrarse:

 function registerl($email,$nombre,$apellido,$contraseña) {
													
		/*Inserción en tabla Prepared Statement- mysql PDO*/
		try {
			$conn = connecttoDB();
	
			// prepare sql and bind parameters
			$stmt = $conn->prepare("INSERT INTO usuarios(email,nombre,apellido,contraseña,fecha_alta,vetado,pc_resevados) VALUES (:email,:nombre,:apellido,:contraseña,:fecha_alta,:vetado,:pc_reservados)");
			$stmt->bindParam(':email', $ema);
			$stmt->bindParam(':nombre', $nomb);
			$stmt->bindParam(':apellido', $ape);
			$stmt->bindParam(':contraseña', $con);
			$stmt->bindParam(':fecha_alta', $fec);
            $stmt->bindParam(':vetado', $vet);
            $stmt->bindParam(':pc_reservados', $pres);

			//Para saber la fecha de alta.

			$f_alta = date('Y-m-j h:i:s');

			// insert a row
			$ema = $email;
			$nomb = $nombre;
			$ape = $apellido;
			$con = $contraseña;
			$fec = $f_alta;
            $vet = NULL;
            $pres = 0;
			$stmt->execute();

			}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;	
 }
  
 function comprobarregister($email,$nombre,$apellido,$contraseña){
	
	$error = false;

	$testemail = "/^[a-záéíóúüñA-ZÁÉÍÓÚÜÑ0-9_.-ç]{2,34}@educamadrid.com$/";				
	
	if ($email == "") {
		echo "Tienes que añadir un usuario"."<br>";
		$error = true;
	}else{
		if (!preg_match_all($testemail,$email)) {
			echo "El usuario es erroneo, no está bien escrito."."<br>";
			$error = true;
		}
		$usucomp = usureg();
		for ($i=0; $i <= count($usucomp)-1; $i++){
			if ($email == $usucomp[$i]){
				echo "El usuario ya fue registrado anteriormente."."<br>";
				$error = true;
			}
		}
	}

	if ($nombre == "") {
		echo "Tienes que añadir tu nombre."."<br>";
		$error = true;
	}

	if ($apellido == "") {
		echo "Tienes que añadir tu apellido."."<br>";
		$error = true;
	}

	$testcontraseña = "/^[a-záéíóúüñA-ZÁÉÍÓÚÜÑ0-9?!.,]{6,10}$/";

	if ($contraseña == "") {
		echo "Tienes que añadir una contraseña de entre 6 a 10 carácteres."."<br>";
		$error = true;
	}else{
		if (!preg_match_all($testcontraseña,$contraseña)) {
			echo "La contraseña es errónea, no está bien escrita o no tiene entre 6 a 10 carácteres."."<br>";
			$error = true;
		}
	}					
				
	return $error;
							
}

function usureg(){

	try {
		$conn = connecttoDB();
		
		$stmt = $conn->prepare("SELECT email FROM usuarios");
		$stmt->execute();

		// set the resulting array to associative
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$usuariocomp = [];
		$cont = 0;
		foreach($stmt->fetchAll() as $row) {
			$usuariocomp[$cont] = $row["email"];
			$cont++;
		}
		return $usuariocomp;
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$conn = null;
}

?>