<?php
//reservar:

function reservar($email,$id,$f_reserva,$turno) {
													
    try {
        $conn = conexion();

        $stmt = $conn->prepare("INSERT INTO reservar(email,id,fecha_reserva,turno,incidencia)
        VALUES (:email,:id,:fecha_reserva,:turno,NULL)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':fecha_reserva', $f_reserva);
        $stmt->bindParam(':turno', $turno);

        $stmt->execute();

        }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;	
}

function yaReservados($conn,$nombre,$fecha){

    $stmt = $conn->prepare("SELECT COUNT(id) FROM reservar
    WHERE email = '$nombre' AND fecha_reserva >= '$fecha'");

    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $cont;
    foreach($result as $row) {
        $cont=$row["COUNT(id)"];
    }
    return $cont;
    
}

function yaReservadoDia($conn,$nombre,$fec){

    $stmt = $conn->prepare("SELECT fecha_reserva FROM reservar
    WHERE email = '$nombre' and fecha_reserva = '$fec' ");

    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $cont = false;
    foreach($stmt->fetchAll() as $row) {
        $cont = true;
    }
    return $cont;
    
}

function ordenadorPillado($conn,$fec,$id,$turno){

    $stmt = $conn->prepare("SELECT id FROM reservar
    WHERE fecha_reserva = '$fec' 
    and id = '$id' and turno = '$turno' ");

    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $cont = false;
    foreach($stmt->fetchAll() as $row) {
        $cont = true;
    }
    return $cont;
    
}

function ordenadoresHoy($conn,$fecha,$turno){

    $stmt = $conn->prepare("SELECT id FROM reservar WHERE fecha_reserva='$fecha' AND turno='$turno' ORDER BY id ASC");

    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    return $result;
    
}

function ordenadorMal($conn){

    $stmt = $conn->prepare("SELECT id FROM pc WHERE estado = 'roto' ORDER BY id ASC");

    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    return $result;
    
}
?>