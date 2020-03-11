<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админка - Добавить запись</title>
</head>
<body>
<h1>Админка - Добавить запись</h1>

<p> <a href="/" title="Главная">Главная - Блог</a> |
    <a href="/admin/base/" title="Главная">Админка</a> |
    <a href="/admin/add/" title="Главная">Админка - добавить запись</a> |
    <a href="/admin/login/" title="Регистрация">Авторизация</a> |
    <a href="/admin/register/" title="Регистрация">Регистрация</a>
</p><br>

<form action="/admin/add" title="add" name="test" method="post">
    <p><input name="title" placeholder="Название статьи"></p>
    <p><textarea name="text" rows="5" cols="50" placeholder="Текст статьи"></textarea></p>
    <button type="submit">Опубликовать</button>
</form>


</body>
</html>