<?php
function get_header($version='') {
    if(!empty($version)){
        $path_header="inc/header_{$version}.php";
    }
    else{
        $path_header="inc/header.php";
    }
    
    if(file_exists($path_header)){
        require $path_header;
    }else{
        echo "Đường dẫn không đúng :{$path_header}";
    }
}

function get_footer() {
    require 'inc/footer.php';
}

