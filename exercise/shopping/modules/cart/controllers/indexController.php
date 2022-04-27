<?php

function construct() {
    load_model('index');
}

function indexAction() {
    load_view('index');
}

function addAction() {
    $id = $_GET['id'];
    add_cart($id);
    redirect("?mod=cart");
}

function deleteAction() {
    $id = $_GET['id'];
    delete_product($id);
    redirect("?mod=cart");
}

function delete_allAction() {
    $id = $_GET['id'];
    delete_product();
    redirect("?mod=cart");
}

function updateAction() {
    if (isset($_POST['update_cart'])) {
        update_cart($_POST['qty']);
        redirect("?mod=cart");
    }
}

function update_ajaxAction() {
    $id = $_POST['id'];
    $qty = $_POST['qty'];

    $item = get_info_product($id);

    if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        $_SESSION['cart']['buy'][$id]['qty'] = $qty;

        $sub_total = $item['price'] * $qty;
        $_SESSION['cart']['buy'][$id]['sud_total'] = $sub_total; //để ý dễ sai chỗ [sud_total] vì ghi sai chữ d thành b

        update_info_cart();

        $number = get_number_order_cart();
        $total = get_total_cart();

        $result = array(
            'sub_total' => currency_format($sub_total),
            'total' => currency_format($total),
            'number' => $number,
        );

        echo json_encode($result);
    }
}
