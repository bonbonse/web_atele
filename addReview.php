<?php
include 'connect.php';
require 'Door/authSessionCheck.php';


date_default_timezone_set('UTC');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Оставить отзыв</title>
    <link rel="stylesheet" href="index.css">
</head>
<body class="body">
<div class="imgBack">
    <div class="mainButtons"><button class="button" onclick="window.location.href='index.php'">Главная</button></div>
    <div class="mainButtons"><button class="button" onclick="window.location.href='box.php'">Корзина</button></div>
    <div class="mainButtons"><img src="resources/logo.png"></div>
    <div class="mainButtons"><button class="button" onclick="window.location.href='contacts.php'">Контакты</button></div>
    <div class="mainButtons"><button class="button" onclick="window.location.href='profile.php'">Профиль</button></div>
</div>

<h2>Отзывы:</h2>
<?php
$id_order = $_GET['id_order'];

$sql_str = "SELECT reviews.id_review, reviews.message, users.surname
                FROM reviews
                JOIN users ON reviews.user = users.id_user
                WHERE reviews.order_r = $id_order";
$res = $conn->query($sql_str);

if ($res->num_rows > 0) {
    echo "<table class='table'>";
    echo "<tr><th>Отзыв</th><th>Код пользователя</th></tr>";
    while ($row = $res->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['message'] . "</td>";
        echo "<td>" . $row['surname'] . "<input type='submit' value='delete' class='delete' >" . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Нет отзывов";
}
?>

<div id="добавление">
    <h2>Оставить отзыв</h2>
    <?php
    //$sql_str = "SELECT Reviews.user FROM Reviews";
    $sql_str = "SELECT id_user, surname FROM users";
    $res = $conn->query($sql_str);

    echo "<form class='form' method='post' action='addReview.php?id_order=" . $id_order ."'>
        Отзыв: <input type='text' name='message'><br>
        <input type='submit' value='Отправить'>
    </form>";

    ?>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $message = $_POST['message'];
        $date = date("d.m.y");
        $user = $_SESSION['id_user'];

        $sql = "INSERT INTO Reviews (message, date_review, user, order_r) VALUES ('$message', '$date', '$user', '$id_order')";
        if ($conn->query($sql) === TRUE) {
            header('Location: addReview.php?id_order=' . $id_order);
            echo "привет";

        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
    ?>

</div>

</body>
</html>