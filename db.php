<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'ПОМЕНЯТЬ НАЗВАНИЕ';
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>
