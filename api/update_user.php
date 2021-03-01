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


    header('HTTP/1.1 200 Ok');
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode(array('message' => 'Dato actualizado correctamente'));
?>