<?php

//add page
function add_page($data)
{
    db_insert('tbl_page', $data);
}


//list page
function get_list_page()
{
    $result = db_fetch_array("SELECT * FROM `tbl_page`");
    return $result;
}

function get_page($start, $num_pers_page, $where = '')
{
    if (!empty($where)) {
        $sql_where = "WHERE {$where}";
        $result = db_fetch_array("select * from `tbl_page` $sql_where LIMIT {$start},{$num_pers_page}");
    } else {
        $result = db_fetch_array("select * from `tbl_page` LIMIT {$start},{$num_pers_page}");
    }
    return $result;
}

//update page
function update_page($data, $id_page)
{
    db_update('tbl_page', $data, "`id_page` = '{$id_page}'");
}

function info_page($data, $id_page)
{
    $sql = db_fetch_row("select * from `tbl_page` where `id_page` = '{$id_page}'");
    return $sql[$data];
}

//delete
function delete_page($id)
{
    db_delete('tbl_page', "`id_page` = '{$id}'");
}


//tìm kiếm page
function db_search_all_pages($value){
    $sql = db_fetch_array("SELECT * FROM `tbl_page` WHERE  CONVERT(`title` USING utf8) LIKE '%{$value}%' OR `category` LIKE '%{$value}%' OR `cretor` LIKE '%{$value}%'");
    return $sql;
}


