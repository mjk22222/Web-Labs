<?php

session_start();
$_SESSION["name"] = $_POST["name"];
$_SESSION["proffesion"] = $_POST["profession"];
$_SESSION["experience"] = $_POST["experience"];
echo "Данные сохранены в сессии";

?>
