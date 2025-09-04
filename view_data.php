<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['password'] === 'diplom2025') {
        $_SESSION['logged_in'] = true;
    } else {
        echo '<form method="post"><input type="password" name="password"><button type="submit">Войти</button></form>';
        exit;
    }
}
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Просмотр данных</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4b0082; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Сохраненные данные</h1>
    <table>
        <tr>
            <th>ФИО</th>
            <th>Номер телефона</th>
            <th>Тип документа</th>
            <th>Номер документа</th>
            <th>Время</th>
        </tr>
        <?php
        if (file_exists('user_data.txt')) {
            $lines = file('user_data.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                $data = json_decode($line, true);
                echo "<tr>";
                echo "<td>" . htmlspecialchars($data['fullname']) . "</td>";
                echo "<td>" . htmlspecialchars($data['phone']) . "</td>";
                echo "<td>" . htmlspecialchars($data['document_type']) . "</td>";
                echo "<td>" . htmlspecialchars($data['document_number']) . "</td>";
                echo "<td>" . htmlspecialchars($data['timestamp']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Нет данных</td></tr>";
        }
        ?>
    </table>
</body>
</html>
