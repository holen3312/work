<?php include __DIR__ . "/header.php";?>
<form action="" method="post">
    <div class="main">
        <div>
            <span>Имя</span><input style="margin-left: 103px" type="text"  name="name" id="name">
        </div>
        <br>
        <div>
            <span>Фамилия</span><input style="margin-left: 70px" type="text" name="surname" id="surname">
        </div>
        <br>
        <div>
            <span>Логин</span><input style="margin-left: 90px" type="text" name="login" id="login">
        </div>
        <br>
        <div>
            <span>Пароль</span><input style="margin-left: 82px" type="password" name="password" id="password">
        </div>
        <br>
        <div>
            <label for="information">Краткое описание:</label>
            <textarea type="text" name="information" id="information"></textarea>
        </div>
        <br>
        <input type="submit" name="Зарегистрироваться"><br>
    </div>
</form>
<?php include __DIR__ . '/footer.php';?>

