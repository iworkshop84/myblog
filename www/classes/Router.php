<?php


namespace App\Classes;

use App\Classes\BaseException;

class Router
{


    public static function start()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $routes = explode('/', $path);

        $ctrl = !empty($routes[1]) ? $routes[1] : 'Article';
        $act = !empty($routes[2]) ? $routes[2] : 'Main';

        $ctrollerClassName = 'App\\Controllers\\' . ucfirst($ctrl);
        if(!class_exists($ctrollerClassName)){
            throw new BaseException ('Такой страницы на сайте нет', 2);
        }

        $controller = new $ctrollerClassName;

        $method = 'action' . ucfirst($act);
        if(!method_exists($controller, $method)){
            throw new BaseException ('Такой страницы на сайте нет', 2);
        }

        $controller->$method();
    }
}