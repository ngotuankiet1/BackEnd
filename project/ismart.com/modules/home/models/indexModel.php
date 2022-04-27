<?php

function get_list_users() {
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}

function get_lis_product_pro($data){
    $result = array();
    if(!empty($data)){
        foreach($data as $item){
            if(!empty($item['price_old'])){
                $result[] = $item;
            }
        }
    }
    return $result;
}

function get_list_cat_all_search($value){
    $sql = db_fetch_array("SELECT DISTINCT `parent_cat` FROM `tbl_product` WHERE CONVERT(`product_name` USING utf8) LIKE '%$value %' OR CONVERT(`product_code` USING utf8) LIKE '%$value %'");
    return $sql;
}

function list_all_products_search($value){
    $sql = db_fetch_array("SELECT * FROM `tbl_product` WHERE CONVERT(`product_name` USING utf8) LIKE '%$value %' OR CONVERT(`product_code` USING utf8) LIKE '%$value %'");
    return $sql;
}

function get_product_by_parent_cat($parent_cat,$value,$order_by = '')
{
    $list_product_by_parent_cat = db_fetch_array("SELECT* FROM `tbl_product` WHERE `parent_cat` = '{$parent_cat}' AND CONVERT(`product_name` USING utf8) LIKE '%$value %' OR CONVERT(`product_code` USING utf8) LIKE '%$value %' $order_by");
    return $list_product_by_parent_cat;
}

function get_cat_id_by_cat($cat){
    $data = db_fetch_assoc("SELECT `cat_id` FROM `tbl_product_cat` WHERE `title` = '{$cat}'");
    return $data['cat_id'];
}

function get_list_all_products_search_by_cat($parent_cat, $value, $order_by =''){
    $sql = "SELECT * FROM `tbl_product` WHERE `parent_cat` = '{$parent_cat}' AND CONVERT(`product_name` USING utf8) LIKE '%$value %' OR CONVERT(`product_code` USING utf8) LIKE '%$value %' $order_by";
    $result = db_fetch_array($sql);
    return $result;
}