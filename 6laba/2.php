<?php


function getWithHeaders(string $url, array $headers): string
{
    $ch = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers
    ]);

    $output = curl_exec($ch);
    curl_close($ch);

    return "GET with headers:\n" . $output . "\n";
}


function postJsonData(string $url, array $payload): string
{
    $ch = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode($payload)
    ]);

    $result = curl_exec($ch);
    curl_close($ch);

    return "POST with JSON:\n" . $result . "\n";
}


function getWithParams(string $url, array $params): string
{
    $finalUrl = $url . '?' . http_build_query($params);
    $ch = curl_init($finalUrl);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);

    return "GET with URL params:\n" . $result . "\n";
}

// Usage examples
echo getWithHeaders("https://jsonplaceholder.typicode.com/posts/1", [
    "Accept: application/json",
    "X-Custom-Header: CustomValue"
]);

echo postJsonData("https://jsonplaceholder.typicode.com/posts", [
    'title' => 'JSON Title',
    'body' => 'This is the body sent as JSON',
    'userId' => 99
]);

echo getWithParams("https://jsonplaceholder.typicode.com/comments", [
    'postId' => 1
]);

