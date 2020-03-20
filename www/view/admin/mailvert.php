<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Подтверждение почты</title>
</head>
<body>
<h1>Подтверждение почты</h1>
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

<?= ($this->getData()['msg']??''); ?>. Теперь вы можете авторизироваться на сайте.
</body>
</html>