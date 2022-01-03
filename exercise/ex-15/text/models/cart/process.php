<?php

$id = $_POST['id'];
$qty = $_POST['qty'];
$item = get_product_by_id($id);

if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
    $_SESSION['cart']['buy'][$id]['qty'] = $qty;
    $sub_total = $item['price'] * $qty;
    $_SESSION['cart']['buy'][$id]['sud_total'] = $sub_total;

    update_info_cart();

    $total = get_total_order_cart();
    $result = array(
        "sub_total" => arrency_format($sub_total),
        "total" => arrency_format($total),
    );
    echo json_encode($result);
}
