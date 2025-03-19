<?php

$myNum = 111;
$answer = $myNum;

$answer += 2;
$answer *= 2;
$answer -= 2;
$answer /= 2;

$answer -= $myNum;
echo 'Значение перменной answer: ', $answer, "\n";
