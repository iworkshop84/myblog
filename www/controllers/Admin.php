<?php


namespace App\Controllers;


use App\Classes\Auth;
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

    public function actionMain()
    {
        if(!Auth::sesLogged()){
            throw new BaseException('Ничего не найдено',2);
        }

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
        if(!Auth::sesLogged()){
            throw new BaseException('Ничего не найдено',2);
        }

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
        if(!Auth::sesLogged()){
            throw new BaseException('Ничего не найдено',2);
        }

        if(isset($_POST['delete'])){
            $article = new Article();
            $article->id = $_GET['value'];
//            var_dump($article);

            Articles::delete($article);
            header('Location: /admin/main');
            exit;

        }


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
        if(isset($_GET['value'])){
        $article->getOneByColumn('id', $_GET['value']);

            if(empty($article->getData())){
                throw new BaseException('Указанной статьи на сайте нет', 2);
            }
        }else{
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

                            $token = Users::genHashToken();
                            $logHash = password_hash($res->getData()->login, PASSWORD_DEFAULT);
//                            $idHash = password_hash($res->getData()->id, PASSWORD_DEFAULT);

                            $res->getData()->hashtoken = $token . $logHash;
                            $res->getData()->logtime = date('Y-m-d G-i-s',time());

                            Users::update($user);
                            $_SESSION['id'] = $res->getData()->id;
                            $_SESSION['login'] =$res->getData()->login;
                            $_SESSION['rools'] = $res->getData()->userrools;
                            $_SESSION['hash'] = $token;

                            //В куку пишется контакенация токена(который отправляется в Сессю) и хешированного ID пользователя
                            // В БД у нас отправляется контакенация токена и хешированного логина
                            if(isset($_POST['remember'])){
                                setcookie('remember', $token . '$2y$' . $res->getData()->id, time() + 86400 * 30, '/');
                                setcookie('vf', $logHash, time() + 86400 * 30, '/');
                            }

                            header('Location: /admin/main');
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
           if(!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['passwordConf']) && !empty($_POST['email'])){

              if($_POST['passwordConf'] == $_POST['password']){

                  if(0 != preg_match('~^[0-9A-Za-z!\\~?@/\\\\#.,$%+-]{4,80}$~', $_POST['login'])){

                        if(0 != preg_match('~^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z!\\~?@/\\\\#.,$%]{6,80}$~', $_POST['password'])){

                            if((null == (new Users())->getOneByColumn('email', $_POST['email'])) && (null == (new Users())->getOneByColumn('login', $_POST['login']))){
//                                var_dump($_POST);

                                $newUser = new User();
                                $newUser->login = $_POST['login'];
                                $newUser->email = $_POST['email'];
                                $newUser->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                                $newUser->userrools = 4;
                                $newUser->regtime = date('Y-m-d G:i:s', time());
//
                                $res = Users::insert($newUser);
                                if($res){
                                    header('Location: /admin/login');
                                    exit;
                                }else{
                                    $this->view->assign('error','Что то пошло не так, обратитесь к администратору');
                                }
                            }else{
                                $this->view->assign('error',
                                    'Указанный логин или email занят. Если вы забыли пароль вы можете его восстановить');
                            }
                        }else{
                            $this->view->assign('error',
                                'Пароль должен быть длинее 6 символов, содержать минимум одну цифру,  по одной букве в верхнем и в нижнем латинском регистре, 
                                        и не содержать ничего кроме латинских букв, цифр и символов ~!?@$%/\#.,+-');
                        }
                  }else{
                      $this->view->assign('error',
                          'Логин должен быть длинее 4 символов и не содержать ничего кроме латинских букв, цифр и символов ~!?@$%/\#.,+-');
                  }
              }else{
                  $this->view->assign('error', 'Пароли не совпадают');
              }
           }else{
               $this->view->assign('error', 'Заполните все необходимые поля');
           }
        }
        $this->view->display('admin/register.php');
    }

    public function actionLogout()
    {
        Auth::logout();
        exit;
    }

}