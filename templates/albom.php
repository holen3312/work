<?php include __DIR__ . "/header.php";?>
<?php foreach ($links as $link):?>
<img src="<?= $link ?>" height="400px">
    <?= str_replace('/', '', strstr($link, '/')); ?>
    <?php foreach ($comments as $comment) : ?>
        <?php if ($comment['name'] == str_replace('/', '', strstr($link, '/'))) : ?>
            <?= $comment['comment']; ?>
            <?php if ($comment['user_id'] == $user_id && !$is_admin): ?>
                <?php if ($comment['name'] == str_replace('/', '', strstr($link, '/'))) : ?>
                <a href="edit/<?=$comment['id'] ?>">Редактировать</a>
                <?php endif; ?>

            <?php endif; ?>
            <?php if ($is_admin): ?>
                <a href="edit/<?=$comment['id'] ?>">Редактировать</a>
                <a href="delete/<?=$comment['id'] ?>">Удалить</a>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endforeach; ?>
<?php include __DIR__ . '/footer.php';?>