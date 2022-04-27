<?php

function get_list_users() {
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}

function add_menu($data){
    db_insert("tbl_menu",$data);
}

function update_menu($data,$id){
    db_update('tbl_menu', $data, "`menu_id`='{$id}'");
}