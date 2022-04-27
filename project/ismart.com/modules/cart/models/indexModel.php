<?php
function update_cart($qty)
{
    foreach ($qty as $id => $value) {
        $_SESSION['cart']['buy'][$id]['qty'] = $value;
        $_SESSION['cart']['buy'][$id]['sud_total'] = $value *  $_SESSION['cart']['buy'][$id]['price_new'];
    }
    update_info_cart();
}