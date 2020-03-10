<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $this->getData('articles')->getData()->title; ?></title>
</head>
<body>
<p><a href="/" title="Главная">Главная</a> |
    <a href="/admin/base/" title="Главная">Главная админка</a> |
    <a href="/admin/login/" title="Авторизация">Авторизация</a> |
    <a href="/admin/register/" title="Регистрация">Регистрация</a>
</p><br>


<p>Дата публикации: <?= $this->getData('articles')->getData()->posttime; ?></p>
<p><?= $this->getData('articles')->getData()->text; ?></p>


</body>
</html>