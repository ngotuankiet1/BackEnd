<?php

function construct() {
    load_model('index');
}

function indexAction() {
    $id = $_GET['id'];
    $data['info'] = get_list_page($id);
    load_view('index', $data);
}
