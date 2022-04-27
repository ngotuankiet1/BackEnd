<?php

function add_cart($product_id)
{
    $product = db_fetch_row("select * from `tbl_product` where `product_id` = '{$product_id}'");
    if (isset($_POST['num_order'])) {
        $qty = $_POST['num_order'];
        if (isset($_SESSION['cart']['buy']) && array_key_exists($product_id, $_SESSION['cart']['buy'])) {
            $qty = $_SESSION['cart']['buy'][$product_id]['qty'] + $_POST['num_order'];
        }
    } else {
        $qty = 1;
        if (isset($_SESSION['cart']['buy']) && array_key_exists($product_id, $_SESSION['cart']['buy'])) {
            $qty = $_SESSION['cart']['buy'][$product_id]['qty'] + 1;
        }
    }
    $_SESSION['cart']['buy'][$product_id] = array(
        'product_id' => $product['product_id'],
        'product_code' => $product['product_code'],
        'product_name' => $product['product_name'],
        'price_new' => $product['price_new'],
        'slug' => $product['slug'],
        'num_product' => $product['num_product'],
        'sold_product' => $product['sold_product'],
        'images' => $product['images'],
        'qty' => $qty,
        'sud_total' => $product['price_new'] * $qty,
    );
    update_info_cart();
}

function update_info_cart()
{
    if (isset($_SESSION['cart']['buy'])) {
        $num_order = 0;
        $total = 0;
        foreach ($_SESSION['cart']['buy'] as $item) {
            $num_order += $item['qty'];
            $total +=  $item['sud_total'];
        }
    }
    $_SESSION['cart']['info'] = array(
        'num_order' => $num_order,
        'total' => $total,
    );
}

function get_product_cart()
{
    if (isset($_SESSION['cart']['buy'])) {
        return $_SESSION['cart']['buy'];
    }
}

function get_number_order_cart()
{
    if (isset($_SESSION['cart']))
        return $_SESSION['cart']['info']['num_order'];
}

function get_total_cart()
{
    if (isset($_SESSION['cart']))
        return $_SESSION['cart']['info']['total'];
}

function delete_cart($product_id = '')
{
    if (!empty($product_id)) {
        unset($_SESSION['cart']['buy'][$product_id]);
        update_info_cart();
    } else {
        unset($_SESSION['cart']);
    }
}

function get_matp_by_province($name){
    $sql = db_fetch_assoc("select `matp` from `tbl_province` where `name` = '{$name}'");
    return $sql['matp'];
}

function get_matp_by_district($name){
    $sql = db_fetch_assoc("select `maqh` from `tbl_district` where `name` = '{$name}'");
    return $sql['maqh'];
}

// add order
function insert_order($data){
    db_insert('tbl_order',$data);
}

// add customer
function insert_customer($data){
    db_insert('tbl_customers',$data);
}

// update customer 
function update_customer($data,$phone){
    db_update('tbl_customers',$data,"`phone` = '{$phone}'");
}

function update_order_by_phone($data,$phone){
    db_update('tbl_order',$data,"`num_phone` = '{$phone}'");
}

# get num customer
function get_num_customer($phone){
    $num_customer = db_num_rows("SELECT* FROM `tbl_customers` WHERE `phone` = '{$phone}'");
    if(!empty($num_customer)){
        return  $num_customer;
    }
}

function insert_product_order($data){
    db_insert('tbl_product_order',$data);
}
