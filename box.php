<?php
require 'connect.php';
require 'Door/authSessionCheck.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = $_POST['comment'];
    $status = "Заказ в обработке";
    $price = 2000;
    $date_comp = NULL;
    $date_registr = date("d.m.y");
    $user = $_SESSION['id_user'];

    $sql = "INSERT INTO orders (comment, price, date_completion, user, status, date_registr) VALUES ('$comment', '$price', '$date_comp', '$user', '$status', '$date_registr')";
    if ($conn->query($sql) === TRUE) {
        //id_order
        $sql_last_order = "SELECT id_order FROM orders ORDER BY id_order DESC LIMIT 1";
        $res = $conn->query($sql_last_order);
        $row = $res->fetch_assoc();
        $id_order = $row['id_order'];
        //id_service
        $sql_services = "SELECT id_service FROM box";
        $res = $conn->query($sql_services);
        while ($row = $res->fetch_assoc()){
            $sql_insert_orders_services = "INSERT INTO orders_services(id_service, id_order) VALUES (" . $row['id_service'] . ", '$id_order')";
            $conn->query($sql_insert_orders_services);
        }
        header('Location: profile.php');
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
    <title>Корзина</title>
    <style>
        body {
            text-align: center;
        }
        form {
            display: inline-block;
            margin-top: 20px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
    </style>
</head>
<body>

<button class="button" onclick="window.location.href='index.php'">Главная</button>
<button class="button" onclick="window.location.href='box.php'">Корзина</button>
<button class="button" onclick="window.location.href='addReview.php'">Контакты</button>

<button class="button" onclick="window.location.href='profile.php'">Профиль</button>

<h1>Корзина</h1>
<ul>

</ul>


<?php
// Данные приходят с таблицы М:М
//
$id_user = $_SESSION['id_user'];
$sql_str = "SELECT services.id_service, services.info, types.type_name, kinds.kind_name FROM box 
            JOIN services ON services.id_service = box.id_service
            JOIN types ON services.type = types.id_type
            JOIN kinds ON services.kind = kinds.id_kind
            WHERE box.id_user = $id_user";

$res = $conn->query($sql_str);

while ($row = $res->fetch_assoc()) {
    echo "<table class='table'>
        <tr><th>Информация</th><th>Тип</th><th>Вид одежды</th></tr>
        <tr><td>'". $row["info"] . "</td><td>". $row["type_name"] . "</td><td>". $row["kind_name"] ."</td></tr>
    </table>";
}

echo "<form method='post'>
    <input type='text' name='comment' placeholder='Оставьте комментарий к заказу' />
    <button>Заказать</button>
</form>";

$service = $conn->query($sql_str);
$service = $service->fetch_assoc();


$conn->close();
?>

</body>
</html>