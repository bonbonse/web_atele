<?php
session_start();
if (!$_SESSION['username'])
    header("Location: Door/auth.php");
echo $_SESSION['username'];