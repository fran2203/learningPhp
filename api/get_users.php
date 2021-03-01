<?php
    include('../db_config.php');

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if($conn->connect_errno) {
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('error' => $conn->connect_error)));
    }

    $conn->set_charset('utf8');

    if ($_GET['search'] === 'true' ) { //Si parámetro search por metodo GET es true hace lo siguiente
        if(isset($_GET['apellido'])) { //Entra en el condicional si se pasa lastName por parámetros
            $apellido = $_GET['apellido'];
            $query = "SELECT * FROM datos_usuario WHERE apellido LIKE '%$apellido%'";
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
            die(json_encode($arr));
        }

        if(isset($_GET['nombre'])){ //Entra en el condicional si se pasa name por parámetros
            $nombre = $_GET['nombre'];
            $query = "SELECT * FROM datos_usuario WHERE nombre LIKE '%$nombre%'";
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
            die(json_encode($arr));
        }

        if(isset($_GET['edad'])){
            $edad = $_GET['edad'];
            $query = "SELECT * FROM datos_usuario WHERE edad = $edad";
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
            die(json_encode($arr));
        }

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = "SELECT * FROM datos_usuario WHERE id = $id";
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
            die(json_encode($arr));
        }
    }
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