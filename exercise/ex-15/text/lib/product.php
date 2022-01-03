<?php

function get_cat_id($cat_id) {
    global $list_product_cat;
    if (array_key_exists($cat_id, $list_product_cat)) {
        $list_product_cat[$cat_id]['url']="?model=product&act=main&cat_id={$cat_id}";
        return $list_product_cat[$cat_id];
    }
    return false;
}

function get_product_by_cat_id($cat_id) {
    global $list_product;
    $tam = array();
    foreach ($list_product as $item) {
        if ($cat_id == $item['cat_id']) {
            $item['url'] = "?model=product&act=details&id={$item['id']}";
            $tam[] = $item;
        }
    }
    return $tam;
}

function get_product_by_id($id) {
    global $list_product;
    if (array_key_exists($id, $list_product)) {
        $list_product[$id]['url_cart_add'] = "?model=cart&act=add&id={$id}";
        $list_product[$id]['url'] = "?model=product&act=details&id={$id}";
        return $list_product[$id];
    }
}
