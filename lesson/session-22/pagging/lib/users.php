<?php

function show_gender($gender) {
    $list_gender = array(
        'male' => 'Nam',
        'female' => 'Nữ',
    );
    if (array_key_exists($gender, $list_gender)) {
        return $list_gender[$gender];
    }
}

function get_users($start, $num_pers_page, $where = '') {
    if (!empty($where)) {
        $sql_where = "WHERE {$where}";
        $result = db_fetch_array("select * from `tbl_user` $sql_where LIMIT {$start},{$num_pers_page}");
    } else {
        $result = db_fetch_array("select * from `tbl_user` LIMIT {$start},{$num_pers_page}");
    }
    return $result;
}
