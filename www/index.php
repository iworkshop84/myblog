<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/core/autoload.php';

use \App\Classes\BaseException;
use \App\Classes\Router;
use \App\Classes\View;
use \App\Classes\Auth;

try {

    Auth::start();
    Auth::authentication();



    Router::start();





} catch (BaseException $exc) {

    $view = new View();

    $view->errMessage = $exc->getMessage();
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
