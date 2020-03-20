<?php


namespace App\Models;
/**
 * @property integer    $id
 * @property string     $login
 * @property string     $password
 * @property integer    $userrools
 * @property string     $email
 * @property integer    $regtime
 * @property integer    $logtime
 * @property string     $mailtoken
 * @property integer    $mailvertify
 */

class User extends AbsSingleModel
{


    public function genHashToken() : string
    {
        return bin2hex(openssl_random_pseudo_bytes(16));
    }
}