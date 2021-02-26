<?php
    include('../db_config.php');

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if($conn->connect_errno) {
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('error' => $conn->connect_error)));
    }

    $conn->set_charset('utf8');

    if (isset($_GET['lastName'])) { //Si recibe un parámetro por el metodo GET hace lo siguiente
        $apellido = $_GET['lastName'];
        $query = "SELECT * FROM datos_usuario WHERE apellido = '$apellido'";
        $res = $conn->query($query);

        $arr = array();
    
        for($i=0;$i < $res->num_rows;$i++){
            array_push($arr, $res->fetch_assoc());
        }

        $conn->close();

        if(count($arr) === 0) {
            header('HTTP/1.0 404 Not Found');
            die();
        }

        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($arr);

    } else {
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
    }


?>