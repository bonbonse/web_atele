<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Ателе</title>
</head>
<body>
<button class="button" onclick="window.location.href='index.php'">Главная</button>
<button class="button" onclick="window.location.href='изменение.php'">Изменение</button>
<button class="button" onclick="window.location.href='addReview.php'">Добавление</button>
<button class="button" onclick="window.location.href='фильтр.php'">Фильтр</button>
<button class="button" onclick="window.location.href='index.php'">Главная</button>
<button class="button" onclick="window.location.href='изменение.php'">Изменение</button>
<button class="button" onclick="window.location.href='addReview.php'">Добавление</button>
<button class="button" onclick="window.location.href='фильтр.php'">Фильтр</button>
</body>
</html>

<?php


$id_review = $_POST['id_review'];
    $message = $_POST['message'];
    $date = $_POST['dateO'];
    $user = $_POST['user'];

    $sql = "INSERT INTO Review (id_review, message,date_r ,user) VALUES ('$id_review', '$message', '$date', '$user')";
    echo $sql;
    if ($conn->query($sql) === TRUE) {
        echo "Добавлено";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }

$conn->close();
?>

?>