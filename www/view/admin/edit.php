<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админка - Редактировать <?php echo $this->getData('article')->getData()->title; ?></title>
</head>
<body>
<h1>Админка - Добавить запись</h1>
<p><a href="/" title="Главная">Главная - Блог</a> |
    <a href="/admin/base/" title="Главная">Главная админка</a></p><br>


<form action="/admin/edit/<?php echo $this->getData('article')->getData()->id; ?>" title="add" name="test" method="post">
    <p><input name="title" placeholder="Название статьи" value="<?php echo $this->getData('article')->getData()->title; ?>"></p>
    <p><textarea name="text" rows="5" cols="50" placeholder="Текст статьи"><?php echo $this->getData('article')->getData()->text; ?></textarea></p>
    <button type="submit">Опубликовать</button>
</form>


</body>
</html>