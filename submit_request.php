<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Ошибка доступа");
}

$user_id = $_SESSION['user_id'];
$date = $_POST['date'];
$time = $_POST['time'];
$weight = $_POST['weight'];
$dimensions = $_POST['dimensions'];
$type = $_POST['type'];
$from_address = $_POST['from_address'];
$to_address = $_POST['to_address'];

$stmt = $conn->prepare("INSERT INTO requests (user_id, date, time, weight, dimensions, type, from_address, to_address, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Новая')");
$stmt->bind_param("ississss", $user_id, $date, $time, $weight, $dimensions, $type, $from_address, $to_address);

if ($stmt->execute()) {
    header("Location: view_requests.php");
    exit;
} else {
    echo "Ошибка при добавлении заявки: " . $conn->error;
}
?>
