<?php

$login = $_GET['username'];
$password = $_GET['password'];

echo $login;
echo $password;

$sql_str = "SELECT login, password FROM users WHERE users.login = $login AND users.password = $password";
$result = $conn->query($sql_str);

if (isset($result)){
    echo "Такой пользователь уже есть";
}
else{
    echo "Регистрируем!";
}

?>