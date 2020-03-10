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
        return !empty($_SESSION);
    }

    public static function checkVert()
    {
        if(self::logged()){
            return 1111;
        }
    }
}