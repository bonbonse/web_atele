<?php

$login = $_GET['login'];
$password = $_GET['password'];

$sql_str = "SELECT DISTINCT login, password FROM users WHERE users.login = $login AND users.password = $password";
$result = $conn->query($sql_str);

if (isset($result)){
    echo "Такой пользователь уже есть";
}
else{
    echo "Регистрируем!";
}

?>