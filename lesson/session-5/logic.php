<?php

$a = false;
$b = 10;

function check_even($x) {
    if ($x % 2 == 0){
        return true;
    }
    return false;
}

if (!check_even(6)) {
    echo "OK";
}
?>