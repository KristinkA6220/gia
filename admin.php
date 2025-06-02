<?php
require 'db.php';
session_start();

if (!isset($_SESSION['admin'])) {
    die("Нет доступа");
}

$result = $conn->query("
    SELECT r.*, u.fio 
    FROM requests r 
    JOIN users u ON r.user_id = u.id 
    ORDER BY r.id DESC
");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <title>Админ-панель – Грузовозофф</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <header class="header">
      <div class="header-inner">
        <div class="logo">Грузовозофф</div>
        <a href="logout.php" class="logout">Выйти</a>
      </div>
    </header>

    <h1>Админ-панель</h1>

    <?php if ($result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="card">
          <p><strong>Клиент:</strong> <?= htmlspecialchars($row['fio']) ?></p>
          <p><strong>Дата и время:</strong> <?= date('d.m.Y', strtotime($row['date'])) ?> <?= htmlspecialchars($row['time']) ?></p>
          <p><strong>Вес (кг):</strong> <?= htmlspecialchars($row['weight']) ?></p>
          <p><strong>Габариты:</strong> <?= htmlspecialchars($row['dimensions']) ?></p>
          <p><strong>Тип груза:</strong> <?= htmlspecialchars($row['type']) ?></p>
          <p><strong>Откуда:</strong> <?= htmlspecialchars($row['from_address']) ?></p>
          <p><strong>Куда:</strong> <?= htmlspecialchars($row['to_address']) ?></p>
          <p><strong>Статус:</strong> <?= htmlspecialchars($row['status']) ?></p>

          <form action="update_status.php" method="POST">
            <input type="hidden" name="request_id" value="<?= $row['id'] ?>" />
            <select name="status" required>
              <option value="">-- Изменить статус --</option>
              <option value="Новая">Новая</option>
              <option value="В работе">В работе</option>
              <option value="Отменена">Отменена</option>
            </select>
            <button type="submit">Обновить</button>
          </form>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>Заявок пока нет.</p>
    <?php endif; ?>
  </div>
</body>
</html>
