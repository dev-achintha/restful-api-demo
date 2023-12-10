<?php

require_once 'config/bootstrap.php';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

if ((isset($uri[1]) && $uri[1] != 'restful') || !isset($uri[2])) {
    $response = [
        'status' => 'error',
        'message' => 'Invalid or empty query.',
        'data' => [],
    ];
    
    header("HTTP/1.1 404 Not Found");
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

require_once PROJECT_ROOT_PATH."/controller/HorizonStudents.php";
$feedController = new HorizonStudents();
$feedController->performAction();
?>