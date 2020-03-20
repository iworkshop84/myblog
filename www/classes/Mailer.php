<?php


namespace App\Classes;
use App\Models\User;
use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception as MailException;


class Mailer
{

    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
    }

    public function sendToken(User $obj)
    {
        try{
        //var_dump($_SERVER);die;
        //var_dump($obj->getData());
        $this->mail->CharSet = 'UTF-8';
        $this->mail->addAddress($obj->getData()['email']);
        $this->mail->setFrom('info@' . $_SERVER['HTTP_HOST'], 'Почтовый робот');

        $this->mail->isHTML(true);
        $this->mail->Subject = 'Подтверждение регистрации на сайте '. $_SERVER['HTTP_HOST'];
        $this->mail->Body = 'Для подтверждения регистрации перейдите по <a href="http://'.$_SERVER['HTTP_HOST'] .'/mail/vertify/'. $obj->getData()['mailtoken'] .' ">ссылке</a> в письме. Если вы не регистрировались, просто игнорируйте письме';
        $this->mail->AltBody = 'Для подтверждения регистрации перейдите по ссылке в письме. Если вы не регистрировались, просто игнорируйте письме';
        $this->mail->send();
        }catch (MailException $exc){
         var_dump($exc);

        }
    }
}