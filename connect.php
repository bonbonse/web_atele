<?php
$host = '127.0.0.1';
$database = 'atelier';
$username = 'root';
$password = '';
$conn = mysqli_connect($host,$username,$password,$database);
if(!$conn) die("������ ���������� � ����� ������". mysqli_connect_error());
?>