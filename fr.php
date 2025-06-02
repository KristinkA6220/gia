<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Новая заявка – Грузовозофф</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <header class="header">
      <div class="header-inner">
        <div class="logo">Грузовозофф</div>
        <div class="header-actions">
          <a href="view_requests.php" class="button">Посмотреть заявки</a>
          <a href="logout.php" class="logout">Выйти</a>
        </div>
      </div>
    </header>

    <h1>Формирование заявки</h1>

    <form class="form" method="POST" action="submit_request.php">
      <label for="date">Дата перевозки</label>
      <input type="date" name="date" id="date" required />

      <label for="time">Время перевозки</label>
      <input type="time" name="time" id="time" required />

      <label for="weight">Вес груза (кг)</label>
      <input type="number" name="weight" id="weight" min="1" required />

      <label for="dimensions">Габариты груза</label>
      <input type="text" name="dimensions" id="dimensions" placeholder="Например: 1.5x1x0.5 м" required />

      <label for="type">Тип груза</label>
      <select name="type" id="type" required>
        <option value="">-- Выберите --</option>
        <option value="Хрупкое">Хрупкое</option>
        <option value="Скоропортящееся">Скоропортящееся</option>
        <option value="Требуется рефрижератор">Требуется рефрижератор</option>
        <option value="Животные">Животные</option>
        <option value="Жидкость">Жидкость</option>
        <option value="Мебель">Мебель</option>
        <option value="Мусор">Мусор</option>
      </select>

      <label for="from_address">Адрес отправления</label>
      <input type="text" name="from_address" id="from_address" required />

      <label for="to_address">Адрес доставки</label>
      <input type="text" name="to_address" id="to_address" required />

      <button type="submit">Отправить заявку</button>
    </form>
  </div>
</body>
</html>
