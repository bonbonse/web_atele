
<?php
require 'connect.php';
require 'Door/authSessionCheck.php';



?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Оставить отзыв</title>
    <link rel="stylesheet" href="index.css">

    <div class="imgBack">
        <button class="button" onclick="window.location.href='index.php'">Главная</button>
        <button class="button" onclick="window.location.href='addReview.php'">Корзина</button>
        <button class="button" onclick="window.location.href='addReview.php'">Контакты</button>

        <button class="button" onclick="window.location.href='profile.php'">Профиль</button>
    </div>
    <?php echo "<form method='post' action='Door/logout.php'><button class='buttonExit' type='submit'>Выйти</button></form>" ?>

</head>
<body>


<?php
$user_id = $_SESSION['id_user'];

$sql_user = "SELECT * FROM users WHERE id_user = $user_id";
$result_user = $conn->query($sql_user);

$butChangeData = "<button type='button' onclick='window.location=`update_userdata.php`'>Изменить данные</button>";
if ($result_user->num_rows > 0) {
    $user = $result_user->fetch_assoc();
    echo "Имя пользователя: " . $user['surname'] . "<br>" . "<a>" . $butChangeData . "</a>";
} else {
    echo "Пользователь не найден";
}

// Получение истории заказов пользователя
$sql_orders = "SELECT * FROM orders WHERE user = $user_id";
$result_orders = $conn->query($sql_orders);

echo "<h2>История заказов:</h2>";
//if ($result_orders->num_rows > 0) {
//    echo "<table><th>"
//    while ($order = $result_orders->fetch_assoc()) {
//        "Дата заказа: " . $order['date_registr'] . " - ". $order['date_completion'] .
//            ", Сумма заказа: " . $order['price'] . ", Статус: " . $order['status'] .
//            "<button type='button' onclick='window.location=`addReview.php?id_order=${order['id_order']}`'>Оставить отзыв</button>
//" ."<br></table>";
//    }
//} else {
//    echo "У пользователя нет заказов";
//}


if ($result_orders->num_rows > 0) {
    echo "<table class='table'>";
    echo "<tr><th>Дата заказа</th><th>Дата готовности</th><th>Цена</th><th>Статус</th><th>Оставить отзыв</th></tr>";
    while ($order = $result_orders->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $order['date_registr'] . "</td>";
        echo "<td>" . $order['date_completion'] . "</td>";
        echo "<td>" . $order['price'];
        echo "<td>" . $order['status'] . "</td>";
        echo "<td><button type='button' onclick='window.location=`addReview.php?id_order=${order['id_order']}`'>Оставить отзыв</button></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Нет отзывов";
}


$conn->close();
?>
</body>
</html>

