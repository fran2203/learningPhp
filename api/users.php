<?php
    $method = $_SERVER['REQUEST_METHOD'];
    switch ($method) {
        case 'GET':
            include('get_users.php');
            break;
        case 'POST':
            include('post_user.php');
            break;
        case 'PUT':
            include('update_user.php');
            break;
    }
?>