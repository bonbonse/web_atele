<?php
session_start();

require '../connect.php';

if (isset($_SESSION['username']))
    header("Location: ../index.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    echo "В сессии user: " . $_SESSION['username'];

    // Подготовка SQL запроса
    $sql = "SELECT * FROM users WHERE login = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($row['password'] == $_POST['password']) {
            $_SESSION['username'] = $row['login'];
            $_SESSION['id_user'] = $row['id_user'];
            header('Location: ../index.php');
        } else {
            echo 'Неверный логин или пароль';
        }
    } else {
        echo 'Пользователь не найден';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация пользователя</title>
    <link rel="stylesheet" href="../index.css">
</head>
<body>
<h1 class="center">Авторизация</h1>
<form method="POST" action="" class="center">
    <label for="username"></label>
    <input type="text" id="username" name="username" placeholder="Login" required><br><br>

    <label for="password"></label>
    <input type="password" id="password" name="password" placeholder="Password" required><br><br>

    <button type="submit">Войти</button>
    <form><button type="button" onclick="window.location='registr.php'">Регистрация</button></form>
</form>

</body>
</html>