<?php

function construct() {
//    load_model('product');
}

function indexAction() {
    $cat_id = $_GET['cat_id'];
    $data['product_cat'] = get_cat_product($cat_id);
    $data['get_product'] = get_product($cat_id);
    load_view('index', $data);
}

function detailAction() {
    $id = $_GET['id'];
    $data['item'] = get_info_product($id);
    load_view('detail', $data);
}
