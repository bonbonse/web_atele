<?php
include 'connect.php';
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
<h2>Оставить отзыв</h2>
<h2>Отзывы:</h2>
<?php

$sql_alb = "SELECT Review.id_review, Review.message, users.surname
                FROM Review
                JOIN users ON Review.user = users.id_user";
$res_alb = $conn->query($sql_alb);

if ($res_alb->num_rows > 0) {
    echo "<table class='table'>";
    echo "<tr><th>Код отзыва</th><th>Отзыв</th><th>Код пользователя</th></tr>";
    while ($row = $res_alb->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id_review'] . "</td>";
        echo "<td>" . $row['message'] . "</td>";
        echo "<td>" . $row['surname'] . "<input type='submit' value='delete' class='delete'>" . "</td>";
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
    $sql_groups = "SELECT * FROM Review";
    $result_groups = $conn->query($sql_groups);

    echo "<form class='form' method='post' action='submit.php'>
        Код: <input type='text' name='id_review'><br>
        Отзыв: <input type='text' name='message'><br>
        Дата: <input type='date' name='dateO'><br>
        Пользователь: <select name='user'><br>";
        while ($row = $result_groups->fetch_assoc()) {
            echo "<option value='" . $row['user'] . "'>" . $row['user'] . "</option>";
        }
        echo "</select></td></tr>
    <input type='submit' value='Отправить'>
    </form>";

    ?>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_review = $_POST['id_review'];
        $message = $_POST['message'];
        $date = $_POST['date'];
        $user = $_POST['user'];

        $sql = "INSERT INTO Review (id_review, message, dateO, user) VALUES ('$id_review', '$message', '$date', '$user')";
        echo $sql;
        if ($conn->query($sql) === TRUE) {
            echo "Добавлено";
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
    ?>

</div>
</body>
</html>

// Стиль таблицы, нав. панель +
// Фильтр по типу/виду +
// Поправить сортировку -
// удаление, обновление, добавление
// на одной странице