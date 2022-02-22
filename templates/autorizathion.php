<div style="text-align: center;">
        <h1>Авторизация</h1>
        <form action="" method="post">

            <label>Логин <input type="text" name="login" value="<?=$_POST['login'] ?? ''?>"></label>
            <br><br>
            <label>Пароль <input type="password" name="password" value="<?=$_POST['password']?? ''?>"></label>
            <br><br>
            <input type="submit" value="Войти">
        </form>
    </div>