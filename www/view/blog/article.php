<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $this->getData('articles')->getData()->title; ?></title>
</head>
<body>
<a href="/index.php" title="Главная">Главная</a>
<h1><?= $this->getData('articles')->getData()->title; ?></h1>


<p>Дата публикации: <?= $this->getData('articles')->getData()->posttime; ?></p>
<p><?= $this->getData('articles')->getData()->text; ?></p>


</body>
</html>