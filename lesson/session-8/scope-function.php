<?php

//$a = 5;
//$b = 10;
//
//function sum() {
//    global $a, $b;
//    return $a + $b;
//}
//echo sum();
//==============================

$a = 5;
$b = 11;

function sum() {
    return $GLOBALS['a']+$GLOBALS['b'];
}
echo sum();
