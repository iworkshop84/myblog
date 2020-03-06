<?php


namespace App\Controllers;


use App\Classes\BaseException;
use App\Classes\View;
use App\Models\Articles;

class Admin
{

    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    public function actionBase()
    {
        $news = new Articles();
        $news->ordGetAll('posttime','DESC');
        if(empty($news)){
            throw new BaseException('Ничего не найдено',2);
        }

        $this->view->assign('articles', $news);
        $this->view->display('admin/main.php');

    }
}