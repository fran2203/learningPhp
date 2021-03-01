<?php
    include('../db_config.php');
    include('../classes/userClass.php');

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if($conn->connect_errno) {
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('error' => $conn->connect_error)));
    }

    $conn->set_charset('utf8');

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];

    $user = new User($nombre, $apellido, $edad, $password);
    
    if($user->emptyNullVerification() === 400) {
        $conn->close();

        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('error' => 'No envió toda la información necesaria')));
    }
    if($user->whiteSpaceVerification() === 422 || $user->typeVerification() === 422) {
        $conn->close();
            
        header('HTTP/1.1 422 Unprocessable Entity');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('error' => 'La información fue enviada incorrectamente')));
    }

    $query = "INSERT INTO datos_usuario (nombre, apellido, edad) 
                VALUES ('$nombre', '$apellido', $edad)";

    if($conn->query($query) === false){
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('error' => 'Fallo en la creación del dato')));
    }

    $conn->close();

    header('HTTP/1.1 201 Created');
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode(array('message' => 'Dato creado correctamente'));
?>