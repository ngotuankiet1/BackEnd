<?php

function get_list_users() {
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}

//add
function add_slider($data){
    db_insert('tbl_slider',$data);
}

function get_slider($start, $num_pers_page, $where = '')
{
    if (!empty($where)) {
        $sql_where = "WHERE {$where}";
        $result = db_fetch_array("select * from `tbl_slider` $sql_where LIMIT {$start},{$num_pers_page}");
    } else {
        $result = db_fetch_array("select * from `tbl_slider` LIMIT {$start},{$num_pers_page}");
    }
    return $result;
}

//update cat product
function update_slider($data, $id)
{
    db_update('tbl_slider', $data, "`slider_id` = '{$id}'");
}

//search
function db_search_all_slider($value){
    $sql = db_fetch_array("SELECT * FROM `tbl_slider` WHERE  CONVERT(`slider_link` USING utf8) LIKE '%{$value}%' OR  CONVERT(`num_order` USING utf8) LIKE '%{$value}%'");
    return $sql;
}


function get_slider_by_id($id){
    $sql =db_fetch_row("SELECT * FROM `tbl_slider` WHERE `slider_id` = $id");
    return $sql;
}


function info_slider($data, $id)
{
    $sql = db_fetch_row("select * from `tbl_slider` where `slider_id` = '{$id}'");
    return $sql[$data];
}

