<?php

//tìm kiếm admin
function db_search_all_admins($value){
    $sql = db_fetch_array("SELECT * FROM `tbl_admin` WHERE `username` LIKE '%{$value}%' OR `fullname` LIKE '%{$value}%' OR `email` LIKE '%{$value}%'");
    return $sql;
}


function db_search_admins_by_page($value,$start, $num_pers_page, $where = '') {
    if (!empty($where)) {
        $sql_where = "WHERE {$where}";
        $result = db_fetch_array("select * from `tbl_admin` $sql_where LIMIT {$start},{$num_pers_page}");
    } else {
        $result = db_fetch_array("select * from `tbl_admin` LIMIT {$start},{$num_pers_page}");
    }
    return $result;
}
?>