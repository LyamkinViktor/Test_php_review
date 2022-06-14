<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация</title>
</head>
<body>

    <form action="/?controller=LoginController" method="post">
        <label for="loginField">Введите логин</label>
        <div><input type="text" name="login" id="loginField"></div><br>
        <label for="pwdField">Введите пароль</label>
        <div><input type="password" name="pwd" id="pwdField"></div>
        <p><button type="submit">Вход</button></p>
    </form>

    <p>
        <a href="/">К отзывам</a>
    </p>

    <?php echo $error; ?>

</body>
</html>