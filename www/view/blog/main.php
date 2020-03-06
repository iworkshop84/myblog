<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Статьи</title>
</head>
<body>
<h1>Статьи</h1>
<p><a href="/" title="Главная">Главная</a> |
<a href="/admin/base/" title="Главная">Главная админка</a></p><br>
<?php

foreach ($this->getData('articles')->getData() as $article): ?>

    <a href="/article/one/<?= $article->id; ?>"><?= $article->title; ?></a>
    <p>Дата публикации: <?= $article->posttime; ?></p>
    <p><?= $article->text; ?></p>

<?php endforeach; ?>
</body>
</html>