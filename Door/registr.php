<?php
session_start();

require '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $surname = $_POST['surname'];

    // Хэширование пароля
    //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Подготовка SQL запроса
    $sql = "INSERT INTO users (surname, login, password, email) VALUES ('$surname', '$username', '$password', '$email')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['username'] = $username;
        header('Location: ../index.php');
    } else {
        echo 'Ошибка регистрации: ' . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация пользователя</title>
</head>
<body>
<h1>Регистрация</h1>
<form method="POST" action="">
    <label for="surname">Фамилия:</label>
    <input type="text" id="surname" name="surname" required><br><br>

    <label for="email">Почта:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="username">Логин:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required><br><br>

    <button type="submit">Зарегистрироваться</button>
</form>
</body>
</html>