<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/core/autoload.php';


use App\Models\Article;
use App\Models\Articles;


try {



    $res = Articles::orderGetAll('id', 'TESsssT');
    var_dump($res);




} catch (\App\Classes\BaseException $exc) {
    var_dump($exc);
}

