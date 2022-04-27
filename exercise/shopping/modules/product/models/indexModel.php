<?php

function get_num_product($cat_id){
    $num_rows = db_num_rows("select * from `list_product` where `cat_id` = '{$cat_id}'");
    return $num_rows;
}


function list_product_cat($cat_id) {
    $result = db_fetch_row("SELECT * FROM `list_product_cat` where `id` = '{$cat_id}'");
    return $result;
}

function get_list_product($cat_id) {
    $temp = array();
    $product = db_fetch_array("SELECT * FROM `list_product`");
    foreach ($product as $item) {
        if ($item['cat_id'] == $cat_id) {
            $item['url_product'] = "?mod=product&action=detail&id={$item['id']}";
            $temp[] = $item;
        }
    }
    return $temp;
}

//function get_info_product($id) {
//    $result = db_fetch_row("select * from `list_product` where `id` = '{$id}'");
//    $result['url_add_cart'] = "?mod=cart&action=add&id={$id}";
//    return $result;
//}
