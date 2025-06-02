<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM requests WHERE user_id = ? ORDER BY date DESC, time DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Мои заявки – Грузовозофф</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <header class="header">
    <div class="header-inner">
      <div class="logo">Грузовозофф</div>
      <a href="logout.php" class="logout">Выйти</a>
    </div>
  </header>

  <h1>Мои заявки</h1>

  <?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="card">
        <p><strong>Дата:</strong> <?= htmlspecialchars($row['date']) ?> <?= htmlspecialchars($row['time']) ?></p>
        <p><strong>Вес:</strong> <?= htmlspecialchars($row['weight']) ?> кг</p>
        <p><strong>Габариты:</strong> <?= htmlspecialchars($row['dimensions']) ?></p>
        <p><strong>Тип:</strong> <?= htmlspecialchars($row['type']) ?></p>
        <p><strong>Откуда:</strong> <?= htmlspecialchars($row['from_address']) ?></p>
        <p><strong>Куда:</strong> <?= htmlspecialchars($row['to_address']) ?></p>
        <p><strong>Статус:</strong> <?= htmlspecialchars($row['status']) ?></p>

        <?php if ($row['status'] === 'В работе' || $row['status'] === 'Обработана'): ?>
          <form action="leave_feedback.php" method="POST">
            <input type="hidden" name="request_id" value="<?= $row['id'] ?>">
            <textarea name="feedback" placeholder="Оставьте отзыв..." required></textarea>
            <button type="submit">Отправить отзыв</button>
          </form>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>У вас пока нет заявок.</p>
  <?php endif; ?>
</div>
</body>
</html>
