<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/core/autoload.php';

use \App\Classes\BaseException;
use \App\Classes\Router;
use \App\Classes\View;
use \App\Classes\Auth;

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

/*
try {
    $mail = new PHPMailer(true);


    $mail->CharSet = "UTF-8";



// Получатель письма
    $mail->setFrom('admin@example.com', 'Mailer');
    $mail->addAddress('iworkshop@ya.ru');
//    $mail->addReplyTo('iworkshop@ya.ru', 'Information');

// Content
    $mail->isHTML(true);                                 // Set email format to HTML
    $mail->Subject = 'Тут будет тема письма';
    $mail->Body = 'Это тело письма и тут будут <b>html</b> теги';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
}catch (Exception $e){
    var_dump($e);
}


exit;
*/


try {

    Auth::start();
    Auth::authentication();
    Router::start();

} catch (BaseException $exc) {

    $view = new View();
    $view->errMessage = $exc->getMessage();
        switch ($exc->getCode()){
            case 1:
                header('HTTP/1.1 403 Not Found');
                header("Status: 403 Not Found");
                break;
            case 2:
                header('HTTP/1.1 404 Not Found');
                header("Status: 404 Not Found");
                break;
        }
    $view->display('/blog/404.php');
}