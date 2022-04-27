<?php

function show_array($data) {
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}

if (isset($_GET['search'])) {
    $q = $_GET['q'];
    $search = $_GET['search'];
}

$mod = $_GET['mod'];
$act = $_GET['act'];
$id = $_GET['id'];
echo "$mod - $act -$id";
?>
<html>
    <body>
        <a href = "?mod=product&act=detail&id=1234">Product</a>
        <h1>tìm kiếm</h1>
        <form action = "" method = "GET">
            Search:<input type = "text" name = "q"/>
            <input type = "submit" name = "search" value = "search"/>
        </form>
    </body>
</html>

