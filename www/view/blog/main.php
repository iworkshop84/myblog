<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Статьи</title>
</head>
<body>
<h1>Статьи</h1>
<p><a href="/" title="Главная">Главная</a> |
    <?php if(isset($_SESSION['id'])){ ?>
        <a href="/admin/main/" title="Главная">Админка</a> |
        <a href="/admin/add/" title="Главная">Админка - добавить запись</a> |
        <a href="/admin/logout/" title="Выйти">Выйти</a>
    <?php }else{ ?>
<a href="/admin/login/" title="Авторизация">Авторизация</a> |
<a href="/admin/register/" title="Регистрация">Регистрация</a>
    <?php } ?>
</p><br>
<?php

foreach ($this->getData('articles')->getData() as $article): ?>

    <a href="/article/one/<?= $article->id; ?>"><?= $article->title; ?></a>
    <p>Дата публикации: <?= $article->posttime; ?></p>
    <p><?= $article->text; ?></p>

<?php endforeach; ?>
</body>
</html>