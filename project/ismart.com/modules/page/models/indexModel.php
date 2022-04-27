<?php

function get_info_menu($field, $menu_id){
    $info_menu_id = db_fetch_row("SELECT `$field` FROM `tbl_menu` WHERE `menu_order` = '{$menu_id}'");
    return  $info_menu_id[$field];
}

function get_info_page($field, $title){
    $info_menu_id = db_fetch_row("SELECT `$field` FROM `tbl_page` WHERE `title` = '{$title}'");
    return  $info_menu_id[$field];
}

?>

