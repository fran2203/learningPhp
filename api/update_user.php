<?php
    include('../db_config.php');
    include('../classes/userClass.php');

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if($conn->connect_errno) {
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('error' => $conn->connect_error)));
    }
    
    //* Asigna el valor de file_get_contents a una variable _PUT
    parse_str(file_get_contents('php://input'), $_PUT);
    $nombre = $_PUT['nombre'];
    $apellido = $_PUT['apellido'];
    $edad = $_PUT['edad'];
    $password = $_PUT['password'];

    $updatedUser = new User($nombre, $apellido, $edad, $password);

    if($updatedUser->emptyNullVerification() === 400) {
        $conn->close();

        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('error' => 'No envió toda la información necesaria')));
    }
    if($updatedUser->whiteSpaceVerification() === 422 || $updatedUser->typeVerification() === 422) {
        $conn->close();
            
        header('HTTP/1.1 422 Unprocessable Entity');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('error' => 'La información fue enviada incorrectamente')));
    }

    header('HTTP/1.1 200 Ok');
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode(array('message' => 'Dato actualizado correctamente'));
?>