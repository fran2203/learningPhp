<?php
    include('../db_config.php');

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if($conn->connect_errno) {
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('error' => $conn->connect_error)));
    }

    $conn->set_charset('utf8');

    $query = 'SELECT * FROM datos_usuario';
    $res = $conn->query($query);
    
    $arr = array();

    for($i=0;$i < $res->num_rows;$i++){
        array_push($arr, $res->fetch_assoc());
    }

    //Una vez ya obtuve los datos, cierro la conexión
    $conn->close();

    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($arr);
?>