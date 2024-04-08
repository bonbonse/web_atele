<?php
require 'connect.php';
require 'Door/authSessionCheck.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
$new_name = $_POST['new_name'];
$new_email = $_POST['new_email'];

$user_id = $_SESSION['id_user']; // Здесь id пользователя, у которого меняем данные

$sql = "UPDATE users SET surname='$new_name', email='$new_email' WHERE id_user=$user_id";

if ($conn->query($sql) === TRUE) {
echo "Данные пользователя успешно обновлены";
} else {
echo "Ошибка при обновлении данных: " . $conn->error;
}
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Изменить данные пользователя</title>
</head>
<body>
<h2>Изменить данные пользователя:</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Новое имя: <input type="text" name="new_name" placeholder="Введите новое имя"><br>
    Новый email: <input type="text" name="new_email" placeholder="Введите новую почту"><br>
    <input type="submit" value="Сохранить">
</form>
</body>
</html>