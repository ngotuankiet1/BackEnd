<?php
//===========================
//danh sách biến hệ thống
//===========================


#$_SERVER
//echo "<pre>";
//print_r($_SERVER);
//echo "</pre>";

//echo "<pre>";
//print_r($_SERVER ["SERVER_SOFTWARE"]);
//echo "</pre>";


#$GLOBALS
function test() {
    $foo = "biến cục bộ";

    echo '$foo in global scope: ' . $GLOBALS["foo"] . "<br>";
    echo '$foo in current scope: ' . $foo ;
}

$foo = "noi dung mau";
test();

?>