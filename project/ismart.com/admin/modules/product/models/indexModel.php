<?php

function get_list_users()
{
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_by_id($id)
{
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}

// ======================================DANH MỤC SẢN PHẨM=================================================

function get_cat_product()
{
    $result = db_fetch_array("SELECT * FROM `tbl_product_cat`");
    return $result;
}

function get_product_cat_by_id($id)
{
    $item = db_fetch_row("SELECT * FROM `tbl_product_cat` WHERE `cat_id` = {$id}");
    return $item;
}

function add_cat_product($data)
{
    $sql =  db_insert('tbl_product_cat', $data);
}

//update cat product
function update_cat_product($data, $id_product)
{
    db_update('tbl_product_cat', $data, "`cat_id` = '{$id_product}'");
}

function get_cat($start, $num_pers_page, $where = '')
{
    if (!empty($where)) {
        $sql_where = "WHERE {$where}";
        $result = db_fetch_array("select * from `tbl_product_cat` $sql_where LIMIT {$start},{$num_pers_page}");
    } else {
        $result = db_fetch_array("select * from `tbl_product_cat` LIMIT {$start},{$num_pers_page}");
    }
    return $result;
}

//search cat product
function db_search_all_cat_product($value){
    $sql = db_fetch_array("SELECT * FROM `tbl_product_cat` WHERE  CONVERT(`title` USING utf8) LIKE '%{$value}%' OR  CONVERT(`creator` USING utf8) LIKE '%{$value}%'");
    return $sql;
}

// ======================================SẢN PHẨM=================================================
function add_product($data)
{
    $sql =  db_insert('tbl_product', $data);
}

function get_product($start, $num_pers_page, $where = '')
{
    if (!empty($where)) {
        $sql_where = "WHERE {$where}";
        $result = db_fetch_array("select * from `tbl_product` $sql_where LIMIT {$start},{$num_pers_page}");
    } else {
        $result = db_fetch_array("select * from `tbl_product` LIMIT {$start},{$num_pers_page}");
    }
    return $result;
}

//update product
function update_product($data, $id_product)
{
    db_update('tbl_product', $data, "`product_id` = '{$id_product}'");
}

//search product
function db_search_all_product($value){
    $sql = db_fetch_array("SELECT * FROM `tbl_product` WHERE  CONVERT(`product_name` USING utf8) LIKE '%{$value}%' OR  CONVERT(`product_code` USING utf8) LIKE '%{$value}%'");
    return $sql;
}

function get_product_by_id($id)
{
    $item = db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id` = {$id}");
    return $item;
}

function info_product($data, $id)
{
    $sql = db_fetch_row("select * from `tbl_product` where `product_id` = '{$id}'");
    return $sql[$data];
}





