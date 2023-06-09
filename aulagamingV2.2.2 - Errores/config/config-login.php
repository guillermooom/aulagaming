<?php
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