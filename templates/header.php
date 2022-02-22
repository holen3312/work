<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
    <link rel="stylesheet" href="http://work/templates/Styles.css">
</head>
<body>

<table class="layout">
    <tr>
        <td colspan="2" class="header">
            <?php if (!empty($user)) {?>
                привет, <?= $user->getName();?> | <a href="http://work/exit">EXIT</a>
            <?php } else { ?>
                <a href="http://work/login"> Войдите на сайт</a>| <a href="http://work/registration">Registration</a>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td>