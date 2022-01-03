<?php

function add_cart($id) {
    global $list_product;
    $product = get_product_by_id($id);
    $qty = 1;
    if (isset($_SESSION['cart']['buy']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        $qty = $_SESSION['cart']['buy'][$id]['qty'] + 1;
    }
    $_SESSION['cart']['buy'][$id] = array(
        'id' => $product['id'],
        'product_title' => $product['name_product'],
        'price' => $product['price'],
        'thumb' => $product['product-thump'],
        'url' => $product['url'],
        'code' => $product['code-product'],
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

function get_product_cart() {
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart']['buy'] as &$item) {
            $item['url_delete'] = "?model=cart&act=delete&id={$item['id']}";
        }
        return $_SESSION['cart']['buy'];
    } else {
        return false;
    }
}

function get_number_order_cart() {
    if (isset($_SESSION['cart']))
        return $_SESSION['cart']['info']['num_order'];
}

function get_total_cart() {
    if (isset($_SESSION['cart']))
        return $_SESSION['cart']['info']['total'];
}

function delete_cart($id) {
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

?>
