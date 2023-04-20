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

function login($conn,$nombre){
    $stmt = $conn->prepare("SELECT email,contra FROM usuarios
    WHERE email = :nombre");

    $stmt -> bindParam(':nombre',$nombre);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    foreach($result as $dat){
        return $dat["contra"];
    }
}

function crearSession($mail){
    $_SESSION["usuario"]=$mail;
}