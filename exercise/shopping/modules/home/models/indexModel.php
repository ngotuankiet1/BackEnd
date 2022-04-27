<?php

function list_product_cat($cat_id) {
    $result = db_fetch_row("SELECT * FROM `list_product_cat` where `id` = '{$cat_id}'");
    $result['url'] = base_url("?mod=product&cat_id={$cat_id}");
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
