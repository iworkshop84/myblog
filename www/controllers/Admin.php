<?php


namespace App\Controllers;


use App\Classes\BaseException;
use App\Classes\View;
use App\Models\Articles;
use App\Models\Article;
//use http\Env\Request;
use App\Models\Users;
use App\Models\User;

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

                $id = Articles::save($article);
                header('Location: /admin/edit/' . $id);
            }
        }

        $this->view->display('admin/add.php');
    }

    public function actionEdit()
    {

        if(!empty($_POST)){
            if('' !== $_POST['title']){

                $article = new Article();
                $article->id = $_GET['value'];
                $article->title = $_POST['title'];
                $article->text = $_POST['text'];

                $id = Articles::save($article);
                header('Location: /admin/edit/' . $article->id);
            }
        }

        $article = new Articles();
        $article->getOneByColumn('id', $_GET['value']);

            if(empty($article->getData())){
                throw new BaseException('Указанной статьи на сайте нет', 2);
            }

        $this->view->assign('article', $article);
        $this->view->display('admin/edit.php');

    }


    public function actionLogin()
    {
        if(!empty($_POST)){
            if(('' !== $_POST['login']) && ('' !== $_POST['password'])) {

                $user = new Users();
                $res = $user->getOneByColumn('login', $_POST['login']);
                if (null == $res) {
                    $this->view->assign('error', 'Нет такого пользователя');
                } else {
                       if ($user->vertify($_POST['password'], $res)) {
                           $res->getData()->hashtoken = Users::genHashToken();
                           $res->getData()->logtime = date('Y-m-d G-i-s',time());

                           Users::update($user);


                        } else {
                            $this->view->assign('error', 'Не правльный логин или пароль');
                        }
                }
            }
        }

        $this->view->display('admin/login.php');

    }
}