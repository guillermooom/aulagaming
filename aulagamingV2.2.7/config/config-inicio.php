<?php
function permisos($conn,$nombre){
    $stmt = $conn->prepare("SELECT permisos FROM usuarios
    WHERE email = :nombre");

    $stmt -> bindParam(':nombre',$nombre);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    foreach($result as $dat){
        return $dat["permisos"];
    }
}

function responsable($conn,$nombre){
    $hoy = date('Y-m-d');

    $stmt = $conn->prepare("SELECT responsable FROM reservar
    WHERE email = :nombre AND fecha_reserva = :hoy ");

    $stmt -> bindParam(':nombre',$nombre);
    $stmt -> bindParam(':hoy',$hoy);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    foreach($result as $dat){
        return $dat["responsable"];
    }
}

function crearSession($mail){
    $_SESSION["usuario"]=$mail;
}