<?php
require 'connect.php';
require 'Door/authSessionCheck.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
    <title>Ателе</title>
</head>
<body class="body">
<div class="imgBack">
    <button class="button" onclick="window.location.href='index.php'">Главная</button>
    <button class="button" onclick="window.location.href='addReview.php'">Корзина</button>
    <button class="button" onclick="window.location.href='addReview.php'">Контакты</button>

    <button class="button" onclick="window.location.href='profile.php'">Профиль</button>
</div>

<?php
$id_service = $_GET['id_service'];

$sql_str = "SELECT services.id_service, services.info, types.type_name, kinds.kind_name
            FROM services  
            JOIN types ON services.type = types.id_type
            JOIN kinds ON services.kind = kinds.id_kind";

$service = $conn->query($sql_str);
$service = $service->fetch_assoc();

echo '<form method="post" action="process_order.php">
    
    <table class="table">
        <tr><th>Информация</th><th>Тип</th><th>Вид одежды</th></tr>
        <tr><td>'. $service["info"] .'</td><td>'. $service["type_name"] .'</td><td>'. $service["kind_name"] .'</td></tr>
    </table>

    <button type="submit">Кинуть в корзину</button>
</form>';