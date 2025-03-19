<?php

function printStringReturnNumber(): int {
    echo "Строка \n";
    return 12;
}

$my_num = printStringReturnNumber();
echo $my_num;
