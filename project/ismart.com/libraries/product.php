<?php
function get_product_by_parent($parent_cat){
    if(!empty($parent_cat)){
        return $sql = db_fetch_array("select * from `tbl_product` where `parent_cat` = '{$parent_cat}' order by `product_id` desc LIMIT 0,4");
    }
}
?>