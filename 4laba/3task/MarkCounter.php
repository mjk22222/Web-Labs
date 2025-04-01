<?php
$text = $_POST["textarea"];
$regexp = "/[[:punct:]0-9]/"; 
$matches = [];

$count = preg_match_all($regexp, $text, $matches);
echo "There are <b>$count punctuation marks and digits</b> in the text!";
?>



