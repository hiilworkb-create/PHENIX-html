<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = trim($_POST['fullname'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $document_type = trim($_POST['document_type'] ?? '');
    $document_number = trim($_POST['document_number'] ?? '');

    $line = date("Y-m-d H:i:s") . " | $fullname | $phone | $document_type | $document_number\n";
    file_put_contents("data.txt", $line, FILE_APPEND);

    echo "<p>✅ Данные сохранены!</p>";
    echo "<p><a href='index.html'>⬅️ Назад</a></p>";
    echo "<p><a href='view_data.php'>📑 Посмотреть все данные</a></p>";
}
?>
