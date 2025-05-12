<?php


function CURLrequest(string $url, string $method = 'GET', $data = null, array $headers = []): void
{
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method)); // Улучшено: метод всегда в верхнем регистре

    // Обработка данных для отправки
    if ($data !== null) {
        if (is_array($data)) {
            $data = json_encode($data);
            $headers[] = 'Content-Type: application/json'; // Добавляем заголовок, если данные в формате массива
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    // Установка заголовков
    if (!empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    // Выполнение запроса и обработка ошибок
    $response = curl_exec($ch);
    $error = curl_error($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($error) {
        echo "Ошибка запроса: $error\n";
    } elseif ($code >= 400) {
        echo "HTTP ошибка, код: $code\n Ответ: $response\n";
    } else {
        echo "Успешно\n";
        $responseData = json_decode($response, true); // декодируем ответ в массив
        print_r($responseData); // выводим массив с данными
    }

    echo "\n";
}

// Примеры использования
echo "Успешный запрос: \n"; CURLrequest('https://jsonplaceholder.typicode.com/posts/1');
echo "Ошибка 404: \n"; CURLrequest('https://jsonplaceholder.typicode.com/posts/999999');
echo "Ошибка CURL: \n"; CURLrequest('https://bad.domain.test');


