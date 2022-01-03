<?php

function construct() {
//    load_model('product');
}

function indexAction() {
    $data['phone'] = get_cat_product(1);
    $data['laptop'] = get_cat_product(2);
    $data['list_phone'] = get_product(1);
    $data['list_laptop'] = get_product(2);
    load_view('index', $data);
}
