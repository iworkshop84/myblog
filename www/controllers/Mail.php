<?php


namespace App\Controllers;

use App\Classes\View;
use App\Classes\BaseException;
use App\Models\Users;

class Mail
{

    public $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function actionVertify()
    {


        if(!empty($_GET['value']) && isset($_GET['value'])){

            $user = new Users();
            $singleUser = $user->getOneByColumn('mailtoken', $_GET['value']);

            if(!empty($singleUser)){
                $singleUser->getData()->mailvertify = 1;

                Users::update($singleUser);
                $this->view->assign('msg', 'Ваша почта активирована');
            }else{
                $this->view->assign('msg', 'Что то пошло не так, обратитесь к администратору');
            }
        }

        $this->view->display('admin/mailvert.php');
    }

}