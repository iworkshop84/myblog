<?php


namespace App\Classes;


class Auth
{
    public static function start()
    {
        session_start();
    }
}