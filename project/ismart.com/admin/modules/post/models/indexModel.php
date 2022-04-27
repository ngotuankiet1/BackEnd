<?php

//add post
function add_post($data)
{
    db_insert("tbl_post", $data);
}

//list post
// function get_posts(){
//     $sql = db_fetch_array("select * from `tbl_post`");
//     return $sql;
// }

function get_post_by_id($id_post)
{
    $sql = db_fetch_row("select * from `tbl_post` where `id` = '{$id_post}'");
    return $sql;
}


//update  post
function update_post($data, $id)
{
    db_update('tbl_post', $data, "`id` = '{$id}'");
}

function get_post_paging($start, $num_pers_page, $where = '')
{
    if (!empty($where)) {
        $sql_where = "WHERE {$where}";
        $result = db_fetch_array("select * from `tbl_post` $sql_where LIMIT {$start},{$num_pers_page}");
    } else {
        $result = db_fetch_array("select * from `tbl_post` LIMIT {$start},{$num_pers_page}");
    }
    return $result;
}


function info_post($data, $id)
{
    $sql = db_fetch_row("select * from `tbl_post` where `id` = '{$id}'");
    return $sql[$data];
}

//search  post
function db_search_all_post($value){
    $sql = db_fetch_array("SELECT * FROM `tbl_post` WHERE  CONVERT(`post_title` USING utf8) LIKE '%{$value}%' OR  CONVERT(`creator` USING utf8) LIKE '%{$value}%'");
    return $sql;
}
