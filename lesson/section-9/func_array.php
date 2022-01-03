<?php
#is_array
//function show_array($data) {
//    if (is_array($data)) {
//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";
//    }
//}

#array_key_exists
//$array1 = array("id" => 1, "name" => "kiet");
//echo array_key_exists("id", $array1);
//================================================
#array_merge
//$array1 = array(1, 2, "id" => "kiet");
//$array2 = array(2, 4, "id" => "kiet");
//$result = array_merge($array1,$array2);
//
//show_array($result);
//================================================
#count
//$a = array(1, 2, 3, 4);
//echo count($a);
//================================================
#in_array
//$array = array("color" => "red", "size" => "xl");
//if(in_array("size", $array)){
//    echo "mau do";
//}
//================================================
#array_values
//$array = array("a" => "b", "b" => "c");
//print_r(array_values($array));
//================================================
#array_search
$array = array(1 => "red", 2 => "xl");
print_r(array_search("xl", $array));
