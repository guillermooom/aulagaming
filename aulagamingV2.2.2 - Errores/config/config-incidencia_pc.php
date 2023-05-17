<?php
function consultaPC($conn,$nombre,$hoy){
    $stmt = $conn->prepare("SELECT email,id,fecha_reserva,turno FROM reservar
    WHERE email = :nombre AND fecha_reserva = :hoy");

    $stmt -> bindParam(':nombre',$nombre);
    $stmt -> bindParam(':hoy',$hoy);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    return $result;
}

function registraInciden($conn,$fech,$texto){

    $stmt = $conn->prepare("UPDATE reservar SET incidencia = :reser WHERE fecha_reserva = :fecha");
			$stmt->bindParam(':reser', $texto);
			$stmt->bindParam(':fecha', $fech);

            $stmt->execute();
            echo "Incidencia registrada";
}

function consultaInciden($conn,$hoy){
    $stmt = $conn->prepare("SELECT incidencia FROM reservar
    WHERE fecha_reserva = :dia");
    $stmt->bindParam(':dia', $hoy);
    
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    foreach($result as $dato){
        return $dato["incidencia"];
    }
}
?>