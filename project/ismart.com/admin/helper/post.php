<?php  


function get_trash(){
    if(isset($_SESSION['post'])){
        return $_SESSION['post']['trash'];
    }else{
        return  false;
    }
}

function get_post(){
    if(isset($_SESSION['post'])){
        return $_SESSION['post']['info'];
    }else{
        return  false;
    }
}   

?>