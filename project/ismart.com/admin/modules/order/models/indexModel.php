<?php

function get_list_users()
{
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_by_id($id)
{
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}

function update_order($data, $id)
{
    db_update("tbl_order", $data, "`id_order` = '{$id}'");
}


function convert_payment($value)
{
    if (!empty($value)) {
        if ($value == "direct-payment") {
            $value = "Thanh toán tại cửa hàng";
        }

        if ($value == "payment-home") {
            $value = "Thanh toán tại nhà";
        }
    }
    return $value;
}

# get info order
function get_info_product($field, $product_id){
    $info_product = db_fetch_row("SELECT `$field` FROM `tbl_product` WHERE `product_id` = '{$product_id}'");
    if(!empty($info_product)){
        return  $info_product[$field];
    }
}
