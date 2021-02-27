<?php
    include('../db_config.php');

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
    $password = $_POST['password'];

    $query = "INSERT INTO datos_usuario (nombre, apellido, contraseña, edad) 
                VALUES ('$nombre', '$apellido', '$password', $edad)";

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