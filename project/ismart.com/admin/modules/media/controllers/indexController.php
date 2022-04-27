<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    load_view('index');
}

function seach_mediaAction()
{
    if (!empty($_GET['value'])) {
        load_view("search");
    } else {
        load_view("index");
    }
}
