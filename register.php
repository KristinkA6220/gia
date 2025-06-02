<?php
require 'db.php';

$login = $_POST['login'];
$password = $_POST['password'];
$fio = $_POST['fio'];
$phone = $_POST['phone'];
$email = $_POST['email'];

// Валидация и хеширование
if (mb_strlen($login) < 6 || !preg_match('/^[А-Яа-яЁё]+$/u', $login)) {
    die('Некорректный логин');
}
$hash = password_hash($password, PASSWORD_DEFAULT);

// Проверка уникальности
$stmt = $conn->prepare("SELECT id FROM users WHERE login = ?");
$stmt->bind_param("s", $login);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    die("Логин уже используется");
}

// Добавление
$stmt = $conn->prepare("INSERT INTO users (fio, phone, email, login, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $fio, $phone, $email, $login, $hash);
$stmt->execute();
header("Location: login.html");
?>