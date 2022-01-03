<?php

#1 tham số
//function check_even($n) {
//    if ($n % 2 == 0) {
//        echo "{$n} là số chẵn";
//    } else {
//        echo "{$n} là số lẻ";
//    }
//}
#2 nhiều tham số

function show_array($data) {
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}

//===================================
#func_num_args
//sum_multi_number1(1, 2, 3, 4, 5);
//function sum_multi_number1() {
//    $count = func_num_args();
//    echo "{$count}";
//}
//===================================
#func_num_args
//function sum_multi_number2() {
//    $a = func_get_arg(0);
//    $b = func_get_arg(4);
//    echo "$a <br> $b";
//}
//
//sum_multi_number2(1, 2, 3, 4, 5);
//===================================
#func_num_args
//function sum_multi_number3() {
//    $agr = func_get_args();
//    show_array($agr);
//    $t = 0;
//    foreach ($agr as $value) {
//        $t += $value;
//    }
//    echo $t;
//}

//sum_multi_number3(1, 2, 3, 4, 5);
//$list_numbers = array(1, 2, 3, 4,10);
//
//function sum_milti_number($data) {
//    if (is_array($data)) {
//        $t = 0;
//        foreach ($data as $value) {
//            $t += $value;
//        }
//    }
//    echo $t;
//}
//sum_milti_number($list_numbers);
//===================================
#input_text
function input_text($name, $value, $option = array()) {
    $name = func_get_arg(0);
    $value = func_get_arg(1);
    $option = func_get_arg(2);
    if (!empty($option)) {
        $id = $option["id"];
        $class = $option["class"];
    }
    $html_input = "<input type='text' name='{$name}' value='{$value}' id='{$id}' class = '{$class}'>";
    echo $html_input;
}

input_text("usename", "", $option = array("id"=>"","class"=>""));
