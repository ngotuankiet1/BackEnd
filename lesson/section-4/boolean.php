<?php

//========================
//boolean
//========================

$a = 10;
if ($a % 2 == 0) {
    echo "{$a} la so chan";
}

function checkEven($n) {
    if ($n % 2 == 0) {
        return true;
    }
    return false;
}

$check = checkEven(4);
?>