<?php

namespace App\Controllers;
use App\Models\Articles;
use App\Models\View;
use App\Classes\BaseException;


class Article
{
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    public function actionAll()
    {
        $news = new Articles();
        $news->ordGetAll('posttime','DESC');
        if(empty($news)){
            throw new BaseException('Ничего не найдено',2);
        }

        $this->view->assign('articles', $news);
        $this->view->display('blog/main.php');
    }
}