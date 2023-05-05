<?php
//Conectar con la base de datos.
  function conexion(){

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
?>