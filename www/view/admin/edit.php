<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админка - Редактировать <?php echo $this->getData('article')->getData()->title; ?></title>
</head>
<body>
<h1>Админка - Добавить запись</h1>
<p><a href="/" title="Главная">Главная</a> |
    <?php if(isset($_SESSION['id'])){ ?>
        <a href="/admin/main/" title="Главная">Админка</a> |
        <a href="/admin/add/" title="Главная">Админка - добавить запись</a> |
        <a href="/admin/users/" title="Главная">Админка - Список пользователей</a> |
        <a href="/admin/logout/" title="Выйти">Выйти</a>
    <?php }else{ ?>
        <a href="/admin/login/" title="Авторизация">Авторизация</a> |
        <a href="/admin/register/" title="Регистрация">Регистрация</a>
    <?php } ?>
</p>


<form action="/admin/edit/<?php echo $this->getData('article')->getData()->id; ?>" title="add" name="test" method="post">
    <p><input name="title" placeholder="Название статьи" value="<?php echo $this->getData('article')->getData()->title; ?>"></p>
    <p><textarea name="text" rows="5" cols="50" placeholder="Текст статьи"><?php echo $this->getData('article')->getData()->text; ?></textarea></p>
    <button type="submit">Опубликовать</button>
    <button type="submit" name="delete">Удалить запись</button>
</form>


</body>
</html>