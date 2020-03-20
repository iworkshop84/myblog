<?php

require __DIR__ . '/../vendor/autoload.php';

function myAutoload($class)
{

    $classParts = explode('\\', $class);

    $classParts[0] = dirname(__DIR__);
    $classParts[1] = lcfirst($classParts[1]);

    $path = implode(DIRECTORY_SEPARATOR, $classParts) . '.php';
    if(file_exists($path)){
        require_once $path;
    }

}

spl_autoload_register('myAutoload');