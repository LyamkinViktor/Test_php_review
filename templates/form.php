<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Отзывы</title>
</head>
    <body>

    <a href="/?controller=LoginController"><div>Админ-панель</div></a>

    <form action="/" method="post">
        <p><input type="text" name="author" placeholder="Имя" required></p>
        <p><textarea name="text" placeholder="Отзыв" required></textarea></p>
        <p><input type="submit" value="Добавить"></p>
    </form>

    </body>
</html>
