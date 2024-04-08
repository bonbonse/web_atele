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
<button class="button" onclick="window.location.href='index.php'">Главная</button>
<button class="button" onclick="window.location.href='addReview.php'">Оставить отзыв</button>
<button class="button" onclick="window.location.href='addReview.php'">Корзина</button>
<button class="button" onclick="window.location.href='addReview.php'">Акции</button>
<button class="button" onclick="window.location.href='addReview.php'">Ткани</button>
<button class="button" onclick="window.location.href='addReview.php'">Подарки</button>
<?php echo "<form method='post' action='Door/logout.php'><button class='button' type='submit'>Выйти</button></form>" ?>
<h2>Отзывы:</h2>
<?php

$sql_str = "SELECT reviews.id_review, reviews.message, users.surname
                FROM reviews
                JOIN users ON reviews.user = users.id_user";
$res = $conn->query($sql_str);

function delete_review(){
    echo "hi";
}

if ($res->num_rows > 0) {
    echo "<table class='table'>";
    echo "<tr><th>Код отзыва</th><th>Отзыв</th><th>Код пользователя</th></tr>";
    while ($row = $res->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id_review'] . "</td>";
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

    echo "<form class='form' method='post' action='addReview.php'>
        Отзыв: <input type='text' name='message'><br>
        <input type='submit' value='Отправить'>
    </form>";

    ?>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $message = $_POST['message'];
        $date = date("d.m.y");
        $user = $_SESSION['id_user'];
        $user_order = 1;

        $sql = "INSERT INTO Reviews (message, date_review, user, order_r) VALUES ('$message', '$date', '$user', '$user_order')";
        if ($conn->query($sql) === TRUE) {
            header('Location: addReview.php');
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
    ?>

</div>

</body>
</html>