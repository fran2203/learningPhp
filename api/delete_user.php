<?php
    include('../db_config.php');
    include('../classes/deleteUserClass.php');

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if($conn->connect_errno) {
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('error' => $conn->connect_error)));
    }

    parse_str(file_get_contents('php://input'), $_DELETE);
    $id = $_DELETE['id'];
    $delUser = new deleteUser($id);

    if($delUser->nullVerification() === 400) {
        $conn->close();

        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('error' => 'No envió toda la información necesaria')));
    }
    if($delUser->whiteSpaceId() === 422 || $delUser->verifyIdType() === 422) {
        $conn->close();
            
        header('HTTP/1.1 422 Unprocessable Entity');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('error' => 'La información fue enviada incorrectamente')));
    }

    $query = "DELETE FROM datos_usuario WHERE id = $id";
    if($conn->query($query) === false){
        $conn->close();

        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('error' => 'Fallo en la eliminación del dato')));
    }

    $conn->close();

    header('HTTP/1.1 204 No content');
?>