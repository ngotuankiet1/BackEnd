<?php
function text_color_status($status){
    if(!empty($status) && $status == 'Approved'){
        echo 'text-primary';
    } else if(!empty($status) && $status == 'Waitting...'){
        echo 'text-success';
    } else{
        echo 'text-danger';
    }
}