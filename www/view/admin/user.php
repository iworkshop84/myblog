<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админка - Профиль пользователя <?php echo $this->getData('user')->getData()->login; ?></title>
</head>
<body>
<h1>Пользователь: <?php echo $this->getData('user')->getData()->login; ?></h1>

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



<form action="/admin/user/<?php echo $this->getData('user')->getData()->id; ?>" title="add" name="useredit" method="post">
    <p>Дата регистрации: <?php echo $this->getData('user')->getData()->regtime; ?></p>
    <p>Логин: <input name="login" placeholder="Логин пользователя" value="<?php echo $this->getData('user')->getData()->login; ?>" readonly disabled></p>
    <p>Email: <input name="email" placeholder="Email пользователя" value="<?php echo $this->getData('user')->getData()->email; ?>"></p>
    <p>Уровень доступа:
        <select name="userrools">
            <?php  foreach ($this->getData('userrools') as $key=>$val) { ?>

                            <option value="<?= $val['id']; ?>" <?php if($val['id'] == $this->getData('user')->getData()->userrools){echo 'selected';}?>>
                                <?= $val['roolsname'];; ?></option>

            <?php }?>
        </select>
    <p>Новый пароль: <input name="password[]" placeholder="Пароль пользователя"></p>
    <p>Новый пароль: <input name="password[]" placeholder="Подтверждение пароля пользователя"></p>
    </p>
    <button type="submit">Отправить</button>
</form>

<?php
echo ($this->getData()['error']??'');
?>
</body>
</html>