<?php

$dbHost = 'db';
$dbUser = 'root';
$dbPass = 'helloworld';
$dbName = 'web';

// Создание соединения с базой данных
$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Проверка соединения
if ($mysqli->connect_errno) {
    error_log("Ошибка подключения к MySQL: " . $mysqli->connect_error); // Логирование ошибки
    die("Невозможно подключиться к базе данных. Пожалуйста, попробуйте позже."); // Вывод сообщения об ошибке для пользователя
}

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы и их экранирование
    $email = $mysqli->real_escape_string($_POST['email']);
    $title = $mysqli->real_escape_string($_POST['title']);
    $category = $mysqli->real_escape_string($_POST['category']);
    $description = $mysqli->real_escape_string($_POST['description']);

    // Формирование SQL-запроса для добавления объявления
    $query = "INSERT INTO ad (email, title, description, category) VALUES ('$email', '$title', '$description', '$category')";

    // Выполнение запроса и обработка ошибок
    if ($mysqli->query($query)) {
       //Успешно добавили объявление
    } else {
        error_log("Ошибка при добавлении объявления: " . $mysqli->error); // Логирование ошибки
        echo "Произошла ошибка при добавлении объявления. Пожалуйста, попробуйте еще раз."; // Сообщение об ошибке для пользователя
    }
}

// Получение всех объявлений из базы данных
$advertisements = [];
$query = 'SELECT * FROM ad ORDER BY created DESC'; // SQL-запрос для получения объявлений

if ($result = $mysqli->query($query)) {
    // Преобразование результата запроса в массив
    while ($row = $result->fetch_assoc()) {
        $advertisements[] = $row;
    }
    $result->free(); // Освобождение памяти, занимаемой результатом
} else {
    error_log("Ошибка при получении объявлений: " . $mysqli->error); // Логирование ошибки
    echo "Произошла ошибка при получении списка объявлений. Пожалуйста, попробуйте позже."; // Сообщение об ошибке для пользователя
}

// Закрытие соединения с базой данных
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доска объявлений</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Добавить объявление</h2>
    <form method="post">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="title">Заголовок:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="category">Категория:</label>
            <select id="category" name="category">
                <option value="computers">Роботы</option>
                <option value="phones">Планшеты</option>
                <option value="phototechnique">Микроскопы</option>
            </select>
        </div>
        <div>
            <label for="description">Описание:</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>
        <button type="submit">Добавить объявление</button>
    </form>

    <h2>Список объявлений</h2>
    <?php if (empty($advertisements)): ?>
        <p>Нет объявлений.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Заголовок</th>
                    <th>Описание</th>
                    <th>Категория</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($advertisements as $ad): ?>
                    <tr>
                        <td><?= htmlspecialchars($ad['email']) ?></td>
                        <td><?= htmlspecialchars($ad['title']) ?></td>
                        <td><?= htmlspecialchars($ad['description']) ?></td>
                        <td><?= htmlspecialchars($ad['category']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
