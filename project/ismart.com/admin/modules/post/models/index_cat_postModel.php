<?php

function add_cat_post($data)
{
     db_insert("tbl_post_cat", $data);
}

function get_post_cat()
{
     $sql = db_fetch_array("select *  from `tbl_post_cat`");
     return $sql;
}

function get_post_cat_by_id($id){
    $sql = db_fetch_row("select * from `tbl_post_cat` where `cat_id` = '{$id}'");
    return $sql;
}

function get_cat_post($start, $num_pers_page, $where = '')
{
    if (!empty($where)) {
        $sql_where = "WHERE {$where}";
        $result = db_fetch_array("select * from `tbl_post_cat` $sql_where LIMIT {$start},{$num_pers_page}");
    } else {
        $result = db_fetch_array("select * from `tbl_post_cat` LIMIT {$start},{$num_pers_page}");
    }
    return $result;
}

//update cat post
function update_cat_post($data, $id_page)
{
    db_update('tbl_post_cat', $data, "`cat_id` = '{$id_page}'");
}

//search cat post
function db_search_all_cat_post($value){
     $sql = db_fetch_array("SELECT * FROM `tbl_post_cat` WHERE  CONVERT(`title` USING utf8) LIKE '%{$value}%' OR  CONVERT(`cretor` USING utf8) LIKE '%{$value}%'");
     return $sql;
}

 
 

