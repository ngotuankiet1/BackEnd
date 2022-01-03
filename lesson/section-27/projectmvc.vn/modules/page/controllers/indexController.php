<?php

function construct() {
}

function indexAction() {
    load_view('index');
}

function detailAction(){
    echo $_GET['slug']."<br>";
    echo $_GET['id'];
    load_view('index');
}

