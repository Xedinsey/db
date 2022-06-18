<?php
require_once 'config/connect.php';
$books = mysqli_query($connect, "SELECT `books`.`title`, `books`.`year`, `writers`.`writer`, `books_genres`.`id_genres`, `genres`.`genre` FROM `books` LEFT JOIN `writers` ON `books`.`id_writer` = `writers`.`id` LEFT JOIN `books_genres` ON `books_genres`.`id_books` = `books`.`id` LEFT JOIN `genres` ON `books_genres`.`id_genres` = `genres`.`id` ORDER BY `id_writer` DESC");
$books = mysqli_fetch_all($books);
$users = mysqli_query($connect, "SELECT `users`.*FROM `users`;");
$users = mysqli_fetch_all($users);
$orders = mysqli_query($connect, "SELECT `users`.*, `orders`.`id_user`, `order_books`.`id_books`, `books`.`title` FROM `users` LEFT JOIN `orders` ON `orders`.`id_user` = `users`.`id` LEFT JOIN `order_books` ON `order_books`.`id_order` = `orders`.`id` LEFT JOIN `books` ON `order_books`.`id_books` = `books`.`id`;");
$orders = mysqli_fetch_all($orders);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сотрудники</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2>Список пользователей</h2>
<table class="table_sort">
    <thead>
    <tr>
        <th>#</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>email</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($users as $item) {
        ?>
        <tr>
            <td><?= $item[0] ?></td>
            <td><?= $item[1] ?></td>
            <td><?= $item[2] ?></td>
            <td><?= $item[3] ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
<h2>Список книг</h2>
<table class="table_sort">
    <thead>
    <tr>
        <th>#</th>
        <th>Название</th>
        <th>Год публикации</th>
        <th>Автор</th>
        <th>Жанр</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($books as $item) {
        ?>
        <tr>
            <td><?= $item[3] ?></td>
            <td><?= $item[0] ?></td>
            <td><?= $item[1] ?></td>
            <td><?= $item[2] ?></td>
            <td><?= $item[4] ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
<br>
<h2>Список заказов</h2>
<table class="table_sort">
    <thead>
    <tr>
        <th>#</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>email</th>
        <th>Название книги</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($orders as $item) {
        ?>
        <tr>
            <td><?= $item[0] ?></td>
            <td><?= $item[1] ?></td>
            <td><?= $item[2] ?></td>
            <td><?= $item[3] ?></td>
            <td><?= $item[6] ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const getSort = ({target}) => {
            const order = (target.dataset.order = -(target.dataset.order || -1));
            const index = [...target.parentNode.cells].indexOf(target);
            const collator = new Intl.Collator(['en', 'ru'], {numeric: true});
            const comparator = (index, order) => (a, b) => order * collator.compare(
                a.children[index].innerHTML,
                b.children[index].innerHTML
            );

            for (const tBody of target.closest('table').tBodies)
                tBody.append(...[...tBody.rows].sort(comparator(index, order)));

            for (const cell of target.parentNode.cells)
                cell.classList.toggle('sorted', cell === target);
        };

        document.querySelectorAll('.table_sort thead').forEach(tableTH => tableTH.addEventListener('click', () => getSort(event)));

    });
</script>
</body>
</html>