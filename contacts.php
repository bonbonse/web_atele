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
<?php

echo "<divclass='contacts'>
<div>Контактные данные</div>
<div>
<table>
<tr><th>Номер телефона</th><th>Почта</th><th>Соц.сети</th></tr>
<tr><td>+79964132838</td><td>cemenbond@mail.ru</td><td>@Semjon</td></tr>
</table>
</div>
</div>"

?>