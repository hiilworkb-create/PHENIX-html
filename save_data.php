<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if ($input && isset($input['fullname'], $input['phone'], $input['document_type'], $input['document_number'])) {
        // Валидация телефона (формат +7 и 10 цифр)
        if (!preg_match('/^\+7\d{10}$/', $input['phone'])) {
            echo json_encode(['result' => 'error', 'message' => 'Неверный формат телефона']);
            exit;
        }

        $data = [
            'fullname' => $input['fullname'],
            'phone' => $input['phone'],
            'document_type' => $input['document_type'],
            'document_number' => $input['document_number'],
            'timestamp' => date('Y-m-d H:i:s')
        ];

        // Сохранение данных в текстовый файл
        $file = fopen('user_data.txt', 'a');
        fwrite($file, json_encode($data) . "\n");
        fclose($file);

        echo json_encode(['result' => 'success']);
    } else {
        echo json_encode(['result' => 'error', 'message' => 'Некорректные данные']);
    }
} else {
    echo json_encode(['result' => 'error', 'message' => 'Неверный метод запроса']);
}
?>
