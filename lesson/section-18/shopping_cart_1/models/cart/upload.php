<?php

if (isset($_POST['btn_update'])) {
    $qty = $_POST['qty'];
    update_cart($qty);
    redirect("?model=cart&act=show");
}

