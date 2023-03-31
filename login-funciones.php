<?php
function conexion(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "epatin";
    
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
    $stmt = $conn->prepare("SELECT email,dni FROM eclientes
    WHERE email = :nombre ");

    $stmt -> bindParam(':nombre',$nombre);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    foreach($result as $dat){
        return $dat["dni"];
    }
}

function crearSession($dni){
    $_SESSION["usuario"]=$dni;
    $_SESSION["carrito"]="";
}