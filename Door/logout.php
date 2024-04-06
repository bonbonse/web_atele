<?php
session_start();

// Удаляем все данные сессии
session_unset();

// Удаляем сессию
session_destroy();

// Перенаправляем пользователя на страницу авторизации
header('Location: auth.php');
exit;
?>