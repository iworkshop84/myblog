<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/core/autoload.php';


$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathParts = explode('/', $path);

$ctrl = !empty($pathParts[1]) ? $pathParts[1] : 'Article';
$act = !empty($pathParts[2]) ? $pathParts[2] : 'All';





    $ctrollerClassName = 'App\\Controllers\\' . $ctrl;

    $controller = new $ctrollerClassName;
    $method = 'action' . $act;
    $controller->$method();
