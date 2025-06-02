<?php
require 'db.php';
session_start();

$login = $_POST['login'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id, password FROM users WHERE login = ?");
$stmt->bind_param("s", $login);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $hash);
if ($stmt->num_rows > 0) {
    $stmt->fetch();
    if (password_verify($password, $hash)) {
        $_SESSION['user_id'] = $id;
        header("Location: fr.php");
        exit();
    }
}
if ($login === "admin" && $password === "gruzovik2024") {
    $_SESSION['admin'] = true;
    header("Location: admin.php");
    exit();
}
echo "Неверный логин или пароль";
?>