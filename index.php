<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$restfulIndex = array_search('restful', $uri);
if ($restfulIndex === false || !isset($uri[$restfulIndex + 1])) {
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

require_once "controller/HorizonStudents.php";

$feedController = new HorizonStudents();
$feedController->performAction();
?>
