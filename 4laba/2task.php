<?php
$str = "a1b2c3"; // Вариант 5 (Заменить числа на их значение плюс 10)
$regexp = "/[0-9]+/";

$result = preg_replace_callback(
    $regexp,
    function ($matches) {
        return (int)$matches[0] + 10;
    },
    $str
);

echo $result;

