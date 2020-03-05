<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Статьи</title>
</head>
<body>
<h1>Статьи</h1>

<?php
foreach ($this->getData('articles')->getData() as $article){ ?>
    <h2><?= $article->title; ?></h2>
    <p>Дата публикации: <?= $article->posttime; ?></p>
    <p><?= $article->text; ?></p>


<?php } ?>
</body>
</html>