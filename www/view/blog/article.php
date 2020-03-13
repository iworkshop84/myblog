<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $this->getData('articles')->getData()->title; ?></title>
</head>
<body>

<p><a href="/" title="Главная">Главная</a> |
    <?php if(isset($_SESSION['id'])){ ?>
        <a href="/admin/main/" title="Главная">Админка</a> |
        <a href="/admin/add/" title="Главная">Админка - добавить запись</a> |
        <a href="/admin/logout/" title="Выйти">Выйти</a>
    <?php }else{ ?>
        <a href="/admin/login/" title="Авторизация">Авторизация</a> |
        <a href="/admin/register/" title="Регистрация">Регистрация</a>
    <?php } ?>
</p>




<h1><?= $this->getData('articles')->getData()->title; ?></h1>

<p>Дата публикации: <?= $this->getData('articles')->getData()->posttime; ?></p>
<p><?= $this->getData('articles')->getData()->text; ?></p>


</body>
</html>