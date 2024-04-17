<?php
require 'connect.php';
require 'Door/authSessionCheck.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_SESSION['id_user'];
    $id_service = $_GET['id_service'];

    $sql = "INSERT INTO box (id_service, id_user) VALUES ('$id_service', '$user')";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
        echo "привет";

    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}
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
    <div class="mainButtons"><button class="button" onclick="window.location.href='index.php'">Главная</button></div>
    <div class="mainButtons"><button class="button" onclick="window.location.href='box.php'">Корзина</button></div>
    <div class="mainButtons"><img src="resources/logo.png"></div>
    <div class="mainButtons"><button class="button" onclick="window.location.href='contacts.php'">Контакты</button></div>
    <div class="mainButtons"><button class="button" onclick="window.location.href='profile.php'">Профиль</button></div>
</div>
<?php
$id_service = $_GET['id_service'];

$sql_str = "SELECT services.id_service, services.info, types.type_name, kinds.kind_name
            FROM services  
            JOIN types ON services.type = types.id_type
            JOIN kinds ON services.kind = kinds.id_kind
            WHERE id_service = $id_service";

$service = $conn->query($sql_str);
$service = $service->fetch_assoc();

echo '<form method="post">
    
    <table class="table">
        <tr><th>Информация</th><th>Тип</th><th>Вид одежды</th></tr>
        <tr><td>'. $service["info"] .'</td><td>'. $service["type_name"] .'</td><td>'. $service["kind_name"] .'</td></tr>
    </table>

    <button type="submit">Кинуть в корзину</button>
</form>';