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

function registraIncidencia($conn, $email, $fecha, $texto)
{
    try {
        $stmt = $conn->prepare("INSERT INTO incidencia(email,fecha_incidencia,incidencia)
        VALUES (:email,:fecha_incidencia,:incidencia)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':fecha_incidencia', $fecha);
        $stmt->bindParam(':incidencia', $texto);

        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function consultaIncidencia($conn, $hoy, $email)
{
    $stmt = $conn->prepare("SELECT incidencia FROM incidencia
    WHERE fecha_incidencia = :dia AND email = :email");
    $stmt->bindParam(':dia', $hoy);
    $stmt->bindParam(':email', $email);

    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    foreach ($result as $dato) {
        return $dato["incidencia"];
    }
}
