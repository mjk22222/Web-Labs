<?php

session_start();
if (isset($_SESSION["name"]) && isset($_SESSION["profession"]) && isset($_SESSION["experience"])) {
    $name = $_SESSION["name"];
    $profession = $_SESSION["profession"];
    $experience = $_SESSION["experience"];
    echo "Имя преподавателя: $name <br> Профессия: $profession <br> Стаж: $experience";
}

?>
