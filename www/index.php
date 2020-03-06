<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/core/autoload.php';

use \App\Classes\BaseException;


$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathParts = explode('/', $path);

$ctrl = !empty($pathParts[1]) ? $pathParts[1] : 'Article';
$act = !empty($pathParts[2]) ? $pathParts[2] : 'All';


try {



    $ctrollerClassName = 'App\\Controllers\\' . $ctrl;
    if(!class_exists($ctrollerClassName)){
        throw new BaseException ('Такой страницы на сайте нет', 2);
    }

    $controller = new $ctrollerClassName;
    $method = 'action' . $act;
    if(!method_exists($controller, $method)){
        throw new BaseException ('Такой страницы на сайте нет', 2);
    }

    $controller->$method();

} catch (BaseException $exc) {

    $view = new \App\Models\View();

    $view->message = $exc->getMessage();
        switch ($exc->getCode()){
            case 1:
                header('HTTP/1.1 403 Not Found');
                header("Status: 404 Not Found");
                break;
            case 2:
                header('HTTP/1.1 404 Not Found');
                header("Status: 404 Not Found");
                break;
        }
    $view->display('/blog/404.php');
    }
