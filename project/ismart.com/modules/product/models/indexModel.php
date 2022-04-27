<?php

function update_password($data, $token)
{
    db_update('tbl_user', $data, "`reset_token` = '{$token}'");
}

function check_email($email)
{
    $sql = db_num_rows("SELECT * FROM `tbl_user` WHERE `email` = '{$email}'");
    echo $sql;
    if ($sql > 0)
        return true;
    return false;
}

function get_cat_product_pagging($start, $num_pers_page, $where = '')
{
    if (!empty($where)) {
        $sql_where = "WHERE {$where}";
        $result = db_fetch_array("select * from `tbl_product` $sql_where LIMIT {$start},{$num_pers_page}");
    } else {
        $result = db_fetch_array("select * from `tbl_product` LIMIT {$start},{$num_pers_page}");
    }
    return $result;
}

// # get product by parent cat
function get_product_by_parent_cat($parent_cat, $order_by = '')
{
    $list_product_by_parent_cat = db_fetch_array("SELECT* FROM `tbl_product` WHERE `status` = 'Approved' AND (`parent_cat` = '{$parent_cat}' OR `select_brand` = '{$parent_cat}') $order_by");
    return $list_product_by_parent_cat;
}

function get_title($mod,$action){
    if($mod == 'product'){
        return 'Sản phẩm';
    }
}

function get_info_product($field,$product_id){
    $product = db_fetch_row("select `$field` from `tbl_product` where `product_id` = '{$product_id}'");
    if(!empty($product)){
        return $product[$field];
    }
}

function get_product_by_parent_cat_unseted($parent,$product_id,$order_by=''){
    $sql = db_fetch_array("SELECT* FROM `tbl_product` WHERE `status` = 'Approved' AND `product_id` != '{$product_id}' AND (`parent_cat` = '{$parent}' OR `select_brand` = '{$parent}') $order_by");
    return $sql;
}
?>
