<?php

function construct() {
    load_model('index');
}

function indexAction() {
    $item = get_list_user();
    $data['get_users'] = $item;
    load('helper', 'format');
    load_view('index', $data);
}

function menuAction() {
    $id = $_GET['id'];
    $item = get_id_user($id);
    show_array($item);
}
