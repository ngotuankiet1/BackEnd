<?php

function redirect_to($url) {
    if (!empty($url)) {
        header("Location: {$url}");
    }else{
        return false;
    }
}

function get_header() {
    require 'header.php';
}

function get_footer() {
    require 'footer.php';
}
