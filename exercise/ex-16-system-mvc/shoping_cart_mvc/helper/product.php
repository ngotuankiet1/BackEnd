<?php

function get_cat_product($cat_id) {
    global $list_product_cat;
    if (array_key_exists($cat_id, $list_product_cat)) {
        return $list_product_cat[$cat_id];
    }
}

function get_product($cat_id) {
    global $list_product;
    $temp = array();
    foreach ($list_product as $item) {
        if ($item['cat_id'] == $cat_id) {
            $item['url_product'] = "?mod=product&action=detail&id={$item['id']}";
            $temp[] = $item;
        }
    }
    return $temp;
}

function get_info_product($id) {
    global $list_product;
    if (array_key_exists($id, $list_product)) {
        $list_product[$id]['url_add_cart'] = "?mod=cart&action=add&id={$id}";
        return $list_product[$id];
    }
}
