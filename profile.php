<?php
require 'connect.php';
require 'Door/authSessionCheck.php';

$user_id = $_SESSION['id_user'];
echo "User_id =" . $user_id;

$sql_user = "SELECT * FROM users WHERE id_user = $user_id";
$result_user = $conn->query($sql_user);

if ($result_user->num_rows > 0) {
    $user = $result_user->fetch_assoc();
    echo "Имя пользователя: " . $user['surname'] . "<br>";
} else {
    echo "Пользователь не найден";
}

// Получение истории заказов пользователя
$sql_orders = "SELECT * FROM orders WHERE user = $user_id";
$result_orders = $conn->query($sql_orders);

echo "<h2>История заказов:</h2>";
if ($result_orders->num_rows > 0) {
    while ($order = $result_orders->fetch_assoc()) {
        echo "Дата заказа: " . $order['date_registr'] . " - ". $order['date_completion'] .
            ", Сумма заказа: " . $order['price'] . ", Статус: " . $order['status'] .
            "<button type='button' onclick='window.location=`addReview.php?id_order=${order['id_order']}`'>Оставить отзыв</button>" ."<br>";
    }
} else {
    echo "У пользователя нет заказов";
}

echo "<button type='button' onclick='window.location=`update_userdata.php`'>Изменить данные</button>";

$conn->close();
?>