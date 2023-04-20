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

function consultaPC($conn,$nombre,$inicio,$fin){
    $stmt = $conn->prepare("SELECT email,id,fecha_reserva,turno FROM reservar
    WHERE email = :nombre AND fecha_reserva >= :inicio AND fecha_reserva <= :fin ORDER BY fecha_reserva");

    $stmt -> bindParam(':nombre',$nombre);
    $stmt -> bindParam(':inicio',$inicio);
    $stmt -> bindParam(':fin',$fin);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    return $result;
}