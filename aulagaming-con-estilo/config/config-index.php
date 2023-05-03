<?php
function inicioUsuario($conn,$nombre){
    $stmt = $conn->prepare("SELECT nombre,apellido,saldo FROM eclientes
    WHERE dni = :nombre ");

    $stmt -> bindParam(':nombre',$nombre);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    return $result;
}