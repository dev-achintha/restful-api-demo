<?php

use Dotenv\Dotenv;

ini_set('display_errors', 1);
error_reporting(E_ALL);

$dotenv = Dotenv::createImmutable(__DIR__);

try {
    $dotenv->safeLoad();
} catch (Exception $e) {
    error_log('Error loading environment variables: ' . $e->getMessage());
}

?>