<?php

require_once 'ApiClient.php';

// Пример использования класса ApiClient с JSONPlaceholder
$client = new ApiClient('https://jsonplaceholder.typicode.com', 'username', 'password'); 
try {
    // Получить все посты
    $posts = $client->get('/posts');
    echo "GET Response:\n";
    print_r($posts); // Выводим сразу весь массив, а не только первый элемент

    // Создать новый пост
    $newPost = $client->post('/posts', [
        'title' => 'Пример поста',
        'body' => 'Тело поста',
        'userId' => 1,
    ]);
    echo "POST Response:\n";
    print_r($newPost);

    // Обновить пост с ID=1
    $updatedPost = $client->put('/posts/1', [
        'title' => 'Обновленный заголовок',
    ]);
    echo "PUT Response:\n";
    print_r($updatedPost);

    // Удалить пост с ID=1
    $deleteResponse = $client->delete('/posts/1');
    echo "DELETE Response:\n";
    print_r($deleteResponse);

} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage() . "\n";
}

