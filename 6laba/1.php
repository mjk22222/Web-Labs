<?php

// Функция для выполнения HTTP-запросов с использованием curl
function makeHttpRequest(string $url, string $method = 'GET', array $headers = [], array $data = null): string
{
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    if (!empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    if ($data !== null) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $response = curl_exec($ch);

    curl_close($ch);

    return $response;
}

// ------------------------------------------------------------------
// GET запрос
$getResponse = makeHttpRequest('https://jsonplaceholder.typicode.com/posts/1');
echo "GET: " . $getResponse . "\n";

// ------------------------------------------------------------------
// POST запрос
$postData = ['title' => 'Hi', 'body' => 'Test', 'userId' => 1];
$postHeaders = ['Content-Type: application/json'];
$postResponse = makeHttpRequest('https://jsonplaceholder.typicode.com/posts', 'POST', $postHeaders, $postData);
echo "POST: " . $postResponse . "\n";

// ------------------------------------------------------------------
// PUT запрос
$putData = ['id' => 1, 'title' => 'New', 'body' => 'Edit', 'userId' => 1];
$putHeaders = ['Content-Type: application/json'];
$putResponse = makeHttpRequest('https://jsonplaceholder.typicode.com/posts/1', 'PUT', $putHeaders, $putData);
echo "PUT: " . $putResponse . "\n";

// ------------------------------------------------------------------
// DELETE запрос
$deleteResponse = makeHttpRequest('https://jsonplaceholder.typicode.com/posts/1', 'DELETE');
echo "DELETE: " . $deleteResponse . "\n";

