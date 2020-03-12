<?php


namespace App\Classes;

use App\Models\Users;
use App\Models\User;

class Auth
{
    public static function start()
    {
        session_start();
    }

    public static function logged()
    {
        return isset($_SESSION['id']);
    }

    public static function logout()
    {
        unset($_SESSION['id']);
        unset($_SESSION['login']);
        unset($_SESSION['rools']);
        unset($_SESSION['hash']);
        session_destroy();
        header('Location: /');
        exit;
    }

    public static function authentication()
    {
        if(self::logged()){
            if(isset($_SESSION['login'], $_SESSION['id'], $_SESSION['rools'], $_SESSION['hash'])){

                $user = new Users();
                $user->getOneByColumn('id', $_SESSION['id']);
//                var_dump($user->getData()->hashtoken);
                $hashToken = substr($user->getData()->hashtoken, 0, 64);
                $logHash =substr($user->getData()->hashtoken, 64);


                if($hashToken != $_SESSION['hash']){
                    self::logout();
                }
                if($_SESSION['login'] != $user->getData()->login){
                    self::logout();
                }
                if(!password_verify($_SESSION['login'], $logHash)){
                    self::logout();
                }
                //var_dump($user->getData());
                if($_SESSION['rools'] != $user->getData()->userrools){
                    self::logout();
                }



            }else{
               self::logout();
               header('Location: /');
               exit;
            }

        }
    }
}