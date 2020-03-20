<?php


namespace App\Classes;

use App\Models\Users;
//use App\Models\User;

class Auth
{
    public static function start()
    {
        if (isset($_COOKIE[session_name()]) || (isset($_COOKIE['remember']))) {
            session_start();
        }
    }


    public static function sesLogged()
    {
       return isset($_SESSION['id']);
    }

    public static function cookieExist()
    {
        if(isset($_COOKIE['remember']) && isset($_COOKIE['vf'])){
           return true;
        }else{
            return false;
        }
    }

    public static function logout()
    {
        unset($_SESSION['id']);
        unset($_SESSION['login']);
        unset($_SESSION['rools']);
        unset($_SESSION['hash']);
        unset($_COOKIE['remember']);
        unset($_COOKIE['vf']);

        session_destroy();
        setcookie('remember', '', time() - 86400 , '/');
        setcookie('PHPSESSID', '', time() - 86400 , '/');
        setcookie('vf', '', time() - 86400 , '/');
        header('Location: /');
        exit;
    }

    public static function authentication()
    {
        if(self::cookieExist()){
            $hashToken = substr($_COOKIE['remember'], 0, 64);
            $id =substr($_COOKIE['remember'], 68);
            $logHash =$_COOKIE['vf'];

            $cookieuser = new Users();
            $cookieuser->getOneByColumn('id', $id);

            if( (substr($cookieuser->getData()->hashtoken, 0, 64) == $hashToken)
                    && (password_verify( $cookieuser->getData()->login, $logHash))){

                $_SESSION['id'] = $id;
                $_SESSION['login'] = $cookieuser->getData()->login;
                $_SESSION['rools'] = $cookieuser->getData()->userrools;
                $_SESSION['hash'] = $hashToken;
            }
        }

        if(self::sesLogged()){
            if(isset($_SESSION['login'], $_SESSION['id'], $_SESSION['rools'], $_SESSION['hash'])){

                $user = new Users();
                $user->getOneByColumn('id', $_SESSION['id']);

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