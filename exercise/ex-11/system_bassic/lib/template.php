<?php

function get_header() {
    $header = "inc/header.php";
    if (file_exists($header)) {
        require $header;
    } else {
        echo 'file header không tồn tại';
    }
}

function get_footer() {
    $footer = "inc/footer.php";
    if (file_exists($footer)) {
        require $footer;
    } else {
        echo 'file footer không tồn tại';
    }
}
