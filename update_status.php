<?php
require 'db.php';
session_start();

if (!isset($_SESSION['admin'])) {
    die("Нет доступа");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'], $_POST['status'])) {
    $id = (int)$_POST['request_id'];
    $status = $conn->real_escape_string($_POST['status']);

    $conn->query("UPDATE requests SET status = '$status' WHERE id = $id");
}

header("Location: admin.php");
exit;
