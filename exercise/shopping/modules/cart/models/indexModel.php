<?php

function get_list_users() {
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}

function add_cart($id) {
    $product = db_fetch_row("SELECT * FROM `list_product` where `id` = '{$id}'");
    $qty = 1;
    if (isset($_SESSION['cart']['buy']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        $qty = $_SESSION['cart']['buy'][$id]['qty'] + 1;
    }
    $_SESSION['cart']['buy'][$id] = array(
        'id' => $product['id'],
        'product_title' => $product['name_product'],
        'price' => $product['price'],
        'thumb' => $product['product_thump'],
//        'url' => $product['url'],
        'code' => $product['code_product'],
        'url_delete' => "?mod=cart&action=delete&id={$id}",
        'qty' => $qty,
        'sud_total' => $product['price'] * $qty,
    );
    update_info_cart();
}

function update_info_cart() {
    if (isset($_SESSION['cart']['buy'])) {
        $num_order = 0;
        $total = 0;
        foreach ($_SESSION['cart']['buy'] as $item) {
            $num_order += $item['qty'];
            $total += $item['sud_total'];
        }
    }
    $_SESSION['cart']['info'] = array(
        'num_order' => $num_order,
        'total' => $total,
    );
}

function delete_product($id="") {
    if (isset($_SESSION['cart'])) {
        if (!empty($id)) {
            unset($_SESSION['cart']['buy'][$id]);
            update_info_cart();
        } else {
            unset($_SESSION['cart']);
        }
    }
}

function update_cart($qty) {
    foreach ($qty as $id => $newqty) {
        $_SESSION['cart']['buy']["{$id}"]['qty'] = $newqty;
        $_SESSION['cart']['buy']["{$id}"]['sud_total'] = $_SESSION['cart']['buy']["{$id}"]['price'] * $newqty;
    }
    update_info_cart();
}

//function get_number_order_cart() {
//    if (isset($_SESSION['cart']))
//        return $_SESSION['cart']['info']['num_order'];
//}
//
//function get_total_cart() {
//    if (isset($_SESSION['cart']))
//        return $_SESSION['cart']['info']['total'];
//}
