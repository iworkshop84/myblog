<?php

namespace App\Controllers;
use App\Models\Articles;
use App\Classes\View;
use App\Classes\BaseException;
use App\Classes\Paginathion;


class Article
{
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    public function actionMain()
    {
        $news = new Articles();

//            $count = $news->getCount();

            $pagin = new Paginathion();
            $pagin->setCount($news->getCount())->setNumPage();
//            var_dump($pagin);die;

            if (isset($_GET['page'])  && ('' !== $_GET['page'])) {
                $page = ($_GET['page'] -1);
            }else{
                $page = 0;
            }

            $start= abs($page);

            $news->ordGetAllArt('posttime','DESC', $start * $pagin->perPage, $pagin->perPage);
            $this->view->assign('pagin', $pagin);



        if(empty($news)){
            throw new BaseException('Ничего не найдено',2);
        }




        $this->view->assign('articles', $news);
        $this->view->display('blog/main.php');
    }

    public function actionOne()
    {

        $article = new Articles();
        $article->getOneByColumn('id', $_GET['value']);

        $this->view->assign('articles', $article);
        $this->view->display('blog/article.php');

    }

}