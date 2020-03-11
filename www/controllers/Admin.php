<?php


namespace App\Controllers;


use App\Classes\BaseException;
use App\Classes\View;
use App\Models\Articles;
use App\Models\Article;
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
                exit;
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
                exit;
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

//                            var_dump(password_hash($res->getData()->login, PASSWORD_DEFAULT));
                            $token = Users::genHashToken();
                            $logHash = password_hash($res->getData()->login, PASSWORD_DEFAULT);

                            $res->getData()->hashtoken = $token . $logHash;
//                            var_dump( $res->getData()->hashtoken);
                            $res->getData()->logtime = date('Y-m-d G-i-s',time());

                            Users::update($user);
                            $_SESSION['login'] =$res->getData()->login;
                            $_SESSION['id'] = $res->getData()->id;
                            $_SESSION['rools'] = $res->getData()->userrools;
                            $_SESSION['hash'] = $token;

                            header('Location: /');
                            exit;
                        } else {
                            $this->view->assign('error', 'Не правльный логин или пароль');
                        }
                }
            }
        }
        $this->view->display('admin/login.php');
    }

    public function actionRegister()
    {

        if(!empty($_POST)){
           var_dump($_POST);
           if(!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['passwordConf']) && !empty($_POST['email'])){
               echo 1111;
           }else{
               $this->view->assign('error', 'Заполните все необходимые поля');
           }
        }
        $this->view->display('admin/register.php');
    }



}