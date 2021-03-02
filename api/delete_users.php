<?php
    include('../db_config.php');
    

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if($conn->connect_errno) {
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('error' => $conn->connect_error)));
    }

    parse_str(file_get_contents('php://input'), $_DELETE);
    $id = $_DELETE['id'];
    

    $query = "DELETE FROM datos_usuario WHERE id = $id";
    if($conn->query($query) === false){
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('error' => 'Fallo en la eliminación del dato')));
    }

    $conn->close();

    header('HTTP/1.1 204 No content');
?>