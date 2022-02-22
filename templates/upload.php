<?php include __DIR__ . "/header.php";?>

<?php if (isset($error) && !empty($error)): ?>
    <?= $error ?>
<?php elseif (isset($result) && !empty($result)): ?>
    <?= $result ?>
<?php endif; ?>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="attachment">
        <input type="submit" value="отправить"> <br>
        <br>
        <label><textarea name="comment"></textarea> комментарий</label><br>
    </form>
<?php include __DIR__ . '/footer.php';?>