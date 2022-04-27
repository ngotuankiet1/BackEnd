<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function indexAction() {
    $data['cat_phone'] = list_product_cat(1);
    $data['cat_macbook'] = list_product_cat(2);
    $data['get_phone'] = get_list_product(1);
    $data['get_macbook'] = get_list_product(2);
    load_view('index',$data);
}
