<?php
$product = $_GET['mod'];
$act = $_GET['act'];
echo $product.'-'.$act;
?>


<html> 
    <form method="GET">
        <a href='?mod=product&act=main'>Sản Phẩm</a>
    </form>
</html>

