<?php

function mostrarUsuarios($conn){

    try {
        
        $stmt = $conn->prepare("SELECT email FROM usuarios where vetado IS NULL AND permisos IS NULL ");
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $row) {
            echo "<option>".$row["email"]."</option>"."<br>";
        }
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}

function agregarVetado($conn,$nombre,$fecha,$info){
    $stmt = $conn->prepare("UPDATE usuarios SET vetado = :fecha, info_vetado = :info WHERE email = :nombre;");

    $stmt -> bindParam(':nombre',$nombre);
    $stmt -> bindParam(':fecha',$fecha);
    $stmt -> bindParam(':info',$info);
    $stmt->execute();
    header( "refresh:1; url=Avetados.php" );	
    exit();
}

?>