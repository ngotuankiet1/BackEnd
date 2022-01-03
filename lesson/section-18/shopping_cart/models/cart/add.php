<?php

$id = $_GET['id'];
add_cart($id);
//unset($_SESSION['cart']);
redirect("?model=cart&act=show");
?>
