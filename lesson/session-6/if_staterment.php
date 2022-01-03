<?php

//=========================
//cấu trúc if-else
//=========================
#cấu trúc IF
//$a = 4;
//if ($a % 2 == 0) {
//    echo "a là số chẵn";
//}
#cấu trúc IF
//$a = 5;
//if ($a % 2 == 0) {
//    echo "a là số chẵn";
//} else {
//    echo "a là số lẻ";
//}
# cấu trúc if-else..if-else
//$point = 7;
//if ($point < 4) {
//    echo 'F';
//} elseif ($point < 5.5) {
//    echo 'D';
//} elseif ($point < 7) {
//    echo 'C';
//} elseif ($point < 8.5) {
//    echo 'B';
//} else {
//    echo 'A';
//}
#cấu trúc lồng
$point = 9;
if ($point >= 0 && $point <= 10) {
    if ($point < 4) {
        echo 'F';
    } elseif ($point < 5.5) {
        echo 'D';
    } elseif ($point < 7) {
        echo 'C';
    } elseif ($point < 8.5) {
        echo 'B';
    } else {
        echo 'A';
    }
} else {
    echo "point không đúng";
}
?>
