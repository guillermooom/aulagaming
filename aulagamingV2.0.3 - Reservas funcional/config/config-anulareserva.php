<?php
function consultaReserva($conn,$nombre,$hoy){
    $stmt = $conn->prepare("SELECT email,id,fecha_reserva,turno FROM reservar
    WHERE email = :nombre AND fecha_reserva >= :hoy ORDER BY fecha_reserva");

    $stmt -> bindParam(':nombre',$nombre);
    $stmt -> bindParam(':hoy',$hoy);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    return $result;
}

function borrarReserva($conn,$nombre,$dia){
    $stmt = $conn->prepare("DELETE FROM reservar WHERE email = :nombre AND fecha_reserva = :dia");

    $stmt -> bindParam(':nombre',$nombre);
    $stmt -> bindParam(':dia',$dia);
    $stmt->execute();
    header("Refresh:0");
}
