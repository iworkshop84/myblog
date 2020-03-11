<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админка - Регистрация</title>
</head>
<body>
<h1>Админка - Регистрация</h1>
<p> <a href="/" title="Главная">Главная - Блог</a> |
    <a href="/admin/base/" title="Главная">Админка</a> |
    <a href="/admin/add/" title="Главная">Админка - добавить запись</a> |
    <a href="/admin/login/" title="Регистрация">Авторизация</a> |
    <a href="/admin/register/" title="Регистрация">Регистрация</a>
</p><br>

<form action="/admin/register" title="add" name="test" method="post">
    <p><input name="login" type="text" placeholder="Ваш логин" ></p>
    <p><input name="email" type="email" placeholder="Ваша почта"></p>
    <p><input name="password" type="password" placeholder="Ваш пароль"></p>
    <p><input name="passwordConf" type="password" placeholder="Повторите ваш пароль"></p>

    <button type="submit">Войти</button>
</form>

<?php

echo ($this->getData()['error']??'');
?>

</body>
</html>