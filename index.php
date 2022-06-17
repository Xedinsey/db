<?php
    require_once 'config/connect.php';
    $employees = mysqli_query($connect, "SELECT * FROM `employees`");
    $employees = mysqli_fetch_all($employees);
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
    <table>
        <tr>
            <th>id</th>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Дата рождения</th>
            <th>Дата приема на работу</th>
            <th>Пол</th>
        </tr>
        <?php
            foreach($employees as $item) {
                ?>
                    <tr>
                        <td><?= $item[0] ?></td>
                        <td><?= $item[1] ?></td>
                        <td><?= $item[2] ?></td>
                        <td><?= $item[3] ?></td>
                        <td><?= $item[4] ?></td>
                        <td><?= $item[5] ?></td>
                    </tr>
                <?php
            }
        ?>
    </table>
    <h2>Добавить нового работника</h2>
    <form action="vendor/create.php" method="post">
        <p>Имя</p>
        <input type="text" name="first-name">
        <p>Фамилия</p>
        <input type="text" name="last-name">
        <p>Дата рождения</p>
        <input type="date" name="date_birth">
        <p>Дата приема на работу</p>
        <input type="date" name="hire_date">
        <p>Пол</p>
        <p><input name="gender" type="radio" value="M"> Мужской</p>
        <p><input name="gender" type="radio" value="F" checked> Женский</p>
    </form>
</body>
</html>