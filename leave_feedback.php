<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Доступ запрещен");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $application_id = intval($_POST['application_id']);
    $comment = trim($_POST['comment']);

    if (!empty($comment)) {
        $stmt = $conn->prepare("INSERT INTO feedback (application_id, user_id, comment) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $application_id, $_SESSION['user_id'], $comment);
        $stmt->execute();
        $stmt->close();
    }
}

header("Location: view_requests.php");
exit();
?>
