<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .hide {
            display:none;
        }
    </style>
    <title>Отзывы</title>
</head>
    <body>
<!--Sorting by date-->
        <?php if ($reviewsCount > 0) : ?>
            <p>
                <?php if (null != $user) : ?>
                <a href="/?controller=AdminController&column=created_at&sort=<?php echo $sort; ?>">Сортировка по дате</a>
                <?php else: ?>
                <a href="/?column=created_at&sort=<?php echo $sort; ?>">Сортировка по дате</a>
                <?php endif ?>
            </p>
        <?php endif ?>
<!--End Sorting by date-->

<!--Reviews-->
        <?php foreach ($reviews as $review) : ?>
            <p> <b>Имя:</b> <?php echo $review->getName() ?> </p>
            <p> <b>Отзыв:</b> <br> <?php echo $review->getText() ?> </p>
            <p> <b>Дата:</b> <?php echo $review->getCreatedAt()->format('Y-m-d H:i:s'); ?> </p>

            <?php if (null != $user) : ?>
                <form action="/?controller=ReviewDeleteController" method="post">
                    <button type="submit" name="delete" value="<?php echo $review->getId() ?>">Удалить</button>
                </form>
            <?php endif ?>
            <hr>
        <?php endforeach; ?>
<!--End Reviews-->

<!--Pagination-->
        <?php if ($reviewsCount > 0) : ?>
            <ul>
                <li class="<?php if ($paginate == 1) { echo 'hide'; } ?>">
                    <?php if (null != $user) : ?>
                        <a href="?controller=AdminController&paginate=1">First</a>
                    <?php else: ?>
                        <a href="?paginate=1">First</a>
                    <?php endif ?>
                </li>
                <li class="<?php if ($paginate <= 1) { echo 'hide'; } ?>">
                    <?php if (null != $user) : ?>
                        <a href="<?php echo "?controller=AdminController&paginate=" . ($paginate - 1); ?>">Prev</a>
                    <?php else: ?>
                        <a href="<?php echo "?paginate=" . ($paginate - 1); ?>">Prev</a>
                    <?php endif ?>
                </li>
                <li class="<?php if ($paginate >= $totalPages) { echo 'hide'; } ?>">
                    <?php if (null != $user) : ?>
                        <a href="<?php echo "?controller=AdminController&paginate=" . ($paginate + 1); ?>">Next</a>
                    <?php else: ?>
                        <a href="<?php echo "?paginate=" . ($paginate + 1); ?>">Next</a>
                    <?php endif ?>
                </li>
                <li class="<?php if ($paginate == $totalPages) { echo 'hide'; } ?>">
                    <?php if (null != $user) : ?>
                        <a href="?controller=AdminController&paginate=<?php echo $totalPages; ?>">Last</a>
                    <?php else: ?>
                        <a href="?paginate=<?php echo $totalPages; ?>">Last</a>
                    <?php endif ?>
                </li>
            </ul>
        <?php endif ?>
<!--End Pagination-->
    </body>
</html>
