<?php


namespace App\Controllers;


use App\Classes\BaseException;
use App\Classes\View;
use App\Models\Articles;
use App\Models\Article;
use http\Env\Request;

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

    public function actionAdd()
    {

        if(!empty($_POST)){
            if('' !== $_POST['title']){

                $article = new Article();
                $article->title = $_POST['title'];
                $article->text = $_POST['text'];

                $id = Articles::insert($article);
                var_dump($id);


            }
        }
        $this->view->display('admin/add.php');
    }
}