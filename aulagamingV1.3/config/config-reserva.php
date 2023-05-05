<?php
function inicioUsuario($conn,$nombre){
    $stmt = $conn->prepare("SELECT nombre,apellido FROM usuarios
    WHERE email = :nombre ");

    $stmt -> bindParam(':nombre',$nombre);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    return $result;
}

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

function yaReservados($conn,$nombre){

    $stmt = $conn->prepare("SELECT id FROM reservar
    WHERE email = '$nombre' ");

    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $cont = 0;
    foreach($stmt->fetchAll() as $row) {
        $cont++;
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

function ordenadoresLibres($conn,$fec){

    $stmt = $conn->prepare("SELECT id FROM reservar
    WHERE fecha_reserva = '$fec' ");

    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $cont = 0;
    foreach($stmt->fetchAll() as $row) {
        $cont++;
    }
    if ($cont==0){
        echo "Todos los ordenadores están disponibles.";
    }else {
        if ($cont <= 10){
            echo "Varios ordenadores están disponibles.";
        }else {
            if ($cont <= 19){
                echo "Hay pocos ordenadores disponibles.";
            }else{
                if ($cont == 20){
                    echo "No hay ningún ordenador disponible para este día.";
                }
            }
        }
    }
    return $cont;
}

?>