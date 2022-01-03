<?php

function construct() {
    load_model('page');
}

function indexAction() {
    $id = $_GET['id'];
    $data['info'] = get_info($id);;
    load_view('index', $data);
}
