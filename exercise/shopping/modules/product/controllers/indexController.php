<?php

function construct() {
    load_model('index');
}

function indexAction() {
    $cat_id = $_GET['cat_id'];
    $data['cat_id'] = $cat_id;
    $data['num_product'] = get_num_product($cat_id);
    $data['get_product'] = get_list_product($cat_id);
    $data['cat_product'] = list_product_cat($cat_id);
    load_view("index", $data);
}

function detailAction() {
    $id = $_GET['id'];
    $data['item'] = get_info_product($id);
    load_view("detail", $data);
}
