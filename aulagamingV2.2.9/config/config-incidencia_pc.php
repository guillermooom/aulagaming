<?php
function consultaPC($conn, $nombre, $hoy)
{
    $stmt = $conn->prepare("SELECT id FROM reservar
    WHERE email = :nombre AND fecha_reserva = :hoy");

    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':hoy', $hoy);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    return $result;
}

function registraIncidencia($conn, $fech, $texto)
{

    $stmt = $conn->prepare("UPDATE reservar SET incidencia = :reser WHERE fecha_reserva = :fecha");
    $stmt->bindParam(':reser', $texto);
    $stmt->bindParam(':fecha', $fech);

    $stmt->execute();
}

function consultaIncidencia($conn, $hoy, $email)
{
    $stmt = $conn->prepare("SELECT incidencia FROM reservar
    WHERE fecha_reserva = :dia AND email = :email");

    $stmt->bindParam(':dia', $hoy);
    $stmt->bindParam(':email', $email);

    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    foreach ($result as $dato) {
        return $dato["incidencia"];
    }
}
