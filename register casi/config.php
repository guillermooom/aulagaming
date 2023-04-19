<?php
//Conectar con la base de datos.
  function connecttoDB(){

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "gaming";
	
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $conn;
}	
  
//Limpiar variables.
 
  function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}	

//elogin:
  
  function comprobarlogin($email,$password){
	
	$error = true;
	$emailv = false;
	$passwordv = false;
	$emailary = emailary();
	$passwordem = passwordem($email);
	$bajacli = bajacli($email);
							
	if ($email == "") {
		echo "Tienes que añadir un correo"."<br>";
		$error = true;
	}else{
		if ($password == "") {
			echo "Tienes que añadir tu clave."."<br>";
			$error = true;
		}else{
			for ($i=0; $i <= count($emailary)-1; $i++){
			if ($email == $emailary[$i]){
				$emailv = true;
			}
		}
		}
	}
	
	if ($emailv == true) {
			if ($password == $passwordem){
				echo "La clave es correcta."."<br>";
				$error = false;
				$passwordv = true;
			}
	}else{
		echo "Email erróneo."."<br>";
		$error = true;
	}
	
	if ($passwordv == false){
		echo "Clave no válida."."<br>";
	}
	
	if ($bajacli != null){
		echo "El cliente está dado de baja el día: ".$bajacli."<br>";
		$error = true;
	}
				
	return $error;
							
}

function emailary(){
	/*SELECTs - mysql PDO*/

	try {
		$conn = connecttoDB();
								
		$stmt = $conn->prepare("SELECT email FROM eclientes");
		$stmt->execute();

		// set the resulting array to associative
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$emailary = [];
		$cont = 0;
		foreach($stmt->fetchAll() as $row) {
			$emailary[$cont] = $row["email"];
			$cont++;
		}
		return $emailary;
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$conn = null;
}

function passwordem($email){
	/*SELECTs - mysql PDO*/

	try {
		$conn = connecttoDB();
								
		$stmt = $conn->prepare("SELECT dni FROM eclientes WHERE email = '$email' ");
		$stmt->execute();

		// set the resulting array to associative
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$passwordem = "";
		foreach($stmt->fetchAll() as $row) {
			$passwordem = ($row["dni"]);
		}
		return $passwordem;
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$conn = null;
}
  
function bajacli($email){
	/*SELECTs - mysql PDO*/

	try {
		$conn = connecttoDB();
								
		$stmt = $conn->prepare("SELECT fecha_baja FROM eclientes WHERE email = '$email' ");
		$stmt->execute();

		// set the resulting array to associative
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$bajacli = "";
		foreach($stmt->fetchAll() as $row) {
			$bajacli = ($row["fecha_baja"]);
		}
		return $bajacli;
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$conn = null;
}
  
function sesionl($email){
	
	$_SESSION['email']=$email;
	echo "Has iniciado sesión."."<br>";
	echo "Cargando...";
	header( "refresh:2; url=einicio.php" );
	
}

//einicio

function mostrarnombape($email) {

	try {
		$conn = connecttoDB();
								
		$stmt = $conn->prepare("SELECT nombre,apellido FROM eclientes WHERE email = '$email' ");
		$stmt->execute();

		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		foreach($stmt->fetchAll() as $row) {
		echo $row["nombre"]." ".$row["apellido"];
		}
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$conn = null;					
}

function mostrarsaldo($email) {
	
	try {
		$conn = connecttoDB();
								
		$stmt = $conn->prepare("SELECT saldo FROM eclientes WHERE email = '$email' ");
		$stmt->execute();

		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		foreach($stmt->fetchAll() as $row) {
		echo $saldo = $row["saldo"];
		}
		return $saldo;
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$conn = null;
}

//ealquilar:

function mostrarfechor() {
	echo date('j-m-Y h:i:s');
}

function mostrarpatinetes() {
	
	try {
		$conn = connecttoDB();
								
		$stmt = $conn->prepare("SELECT matricula FROM epatines WHERE disponible = 'S' ");
		$stmt->execute();

		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		foreach($stmt->fetchAll() as $row) {
			echo "<option>".$row["matricula"]."</option>"."<br>";
		}
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$conn = null;
}

function añadircesta($matricula,$email){

	$namecesta = "cesta_".$email;
	$repetido = false;
	//unset($_SESSION[$namecesta]);
	if(!isset($_SESSION[$namecesta])) {
	
		$valorcesta=array($matricula);

		$_SESSION[$namecesta] = $valorcesta;
		echo "Cesta creada."."<br>";
		
		//var_dump($_SESSION[$namecesta]);
		header( "refresh:1; url=ealquilar.php" );
	} else {
		echo "Ya hay un patín seleccionado.";
	}
}

function mostrarcesta($email) {
	
	$namecesta = "cesta_".$email;
	
	if(isset($_SESSION[$namecesta])) {
		$cesta = $_SESSION[$namecesta];
	for($i=0; $i<=count($cesta)-1; $i++)
      {
      //saco el valor de cada elemento
	  $matricula = $cesta[$i];
	  echo " - Matrícula: ".$matricula."<br>";
	  }
	}

}

function realizaralquiler($matricula,$email) {
	
	$namecesta = "cesta_".$email;
	
	if(isset($_SESSION[$namecesta])) {
		$cesta = $_SESSION[$namecesta];
	for($i=0; $i<=count($cesta)-1; $i++)
      {
      //saco el valor de cada elemento
	  $matricula = $cesta[$i];
	  patinnodisp($matricula);
	  patinalquilado($matricula,$email);
	  echo "Alquiler realizado";
	  }
	}
}

function patinnodisp($matricula){
	
	$no = "N";
	
	/*Inserción en tabla Prepared Statement- mysql PDO*/
	try {
		$conn = connecttoDB();
		// prepare sql and bind parameters
		
		$stmt = $conn->prepare("UPDATE epatines SET disponible = '$no' WHERE matricula = '$matricula' ");
										
		$stmt->bindParam('$no', $disponible);
		$stmt->bindParam('$matricula', $matricula);
		$stmt->execute();
		
		}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
	$conn = null;	

	
}

function patinalquilado($matricula,$email){
													
	/*Inserción en tabla Prepared Statement- mysql PDO*/
	try {
		$conn = connecttoDB();

		// prepare sql and bind parameters
		$stmt = $conn->prepare("INSERT INTO ealquileres (dni,matricula,fecha_alquiler,fecha_devolucion,preciototal) VALUES (:dni,:matricula,:fecha_alquiler,:fecha_devolucion,:preciototal)");
		$stmt->bindParam(':dni', $dn);
		$stmt->bindParam(':matricula', $mat);
		$stmt->bindParam(':fecha_alquiler', $fa);
		$stmt->bindParam(':fecha_devolucion', $fd);
		$stmt->bindParam(':preciototal', $pt);

		//Para saber la fecha de la compra
		$dni = dni($email);
		$matricula = $matricula;
		$fec_inicio = date('Y-m-j h:i:s');
		$fec_dev = null;
		$preciototal = null;	
		
		// insert a row
		$dn = $dni;
		$mat = $matricula;
		$fa = $fec_inicio;
		$fd = $fec_dev;
		$pt = $preciototal;
		$stmt->execute();
		
		}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
	$conn = null;	
}

function dni($email){

	try {
		$conn = connecttoDB();
								
		$stmt = $conn->prepare("SELECT dni FROM eclientes WHERE email = '$email' ");
		$stmt->execute();

		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		foreach($stmt->fetchAll() as $row) {
		$dni = $row["dni"];
		}
		return $dni;
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$conn = null;					
}

?>