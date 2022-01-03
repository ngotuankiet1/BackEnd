<?php

function construct() {
    
}

function indexAction() {
    load_view('index');
}

function updateAction() {
    $id = $_POST['id'];
    echo $id;
}
