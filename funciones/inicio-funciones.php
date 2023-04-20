<?php
function conexion(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gaming";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        echo "<h1>ERROR CODE</h1>".$error=$e->getCode();
    }
    return $conn; 
}

function inicioUsuario($conn,$nombre){
    $stmt = $conn->prepare("SELECT nombre,apellido FROM usuarios
    WHERE email = :nombre ");

    $stmt -> bindParam(':nombre',$nombre);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    return $result;
}