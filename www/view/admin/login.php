<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админка - Авторизация</title>
</head>
<body>
<h1>Админка - Авторизация</h1>
<p><a href="/" title="Главная">Главная - Блог</a> |
    <a href="/admin/login/" title="Главная">Главная админка</a></p><br>

<form action="/admin/login" title="add" name="test" method="post">
    <p><input name="login" type="text" placeholder="Ваш логин"></p>
    <p><input name="password" type="password" placeholder="Ваш пароль"></p>

    <button type="submit">Войти</button>
</form>

<?php

echo ($this->getData()['error']??'');
?>

</body>
</html>