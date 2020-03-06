<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админка - Главная</title>
</head>
<body>
<h1>Админская панель</h1>
<p><a href="/" title="Главная">Главная - Блог</a> |
    <a href="/admin/base/" title="Главная">Главная админка</a></p><br>

<?php

foreach ($this->getData('articles')->getData() as $article): ?>

    <p>Дата: <?= $article->posttime; ?> | <a href="/article/one/<?= $article->id; ?>"><?= $article->title; ?></a></p>


<?php endforeach; ?>
</body>
</html>