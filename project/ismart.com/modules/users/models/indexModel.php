<?php

function update_password($data, $token) {
    db_update('tbl_user', $data, "`reset_token` = '{$token}'");
}

function check_email($email) {
    $sql = db_num_rows("SELECT * FROM `tbl_user` WHERE `email` = '{$email}'");
    echo $sql;
    if ($sql > 0)
        return true;
    return false;
}

function check_reset_token($reset_token){
     $sql = db_num_rows("SELECT * FROM `tbl_user` WHERE `reset_token` = '{$reset_token}'");
    echo $sql;
    if ($sql > 0)
        return true;
    return false;
}

function check_reset_email($data, $email) {
    db_update('tbl_user', $data, "`email` = '{$email}'");
}

function users_exits($username, $email) {
    $sql = db_num_rows("SELECT * FROM `tbl_user` WHERE `username` = '{$username}' OR `email` = '{$email}'");
    echo $sql;
    if ($sql > 0)
        return true;
    return false;
}

function add_user($data) {
    return db_insert('tbl_user', $data);
}

function get_list_users() {
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}

function active_user($active_token) {
    db_update('tbl_user', array('is_active' => 1), "`active_token` = '{$active_token}'");
}

function check_active($active_token) {
    $sql = db_num_rows("SELECT * FROM `tbl_user` WHERE `active_token` = '{$active_token}' AND `is_active` = '0'");
//    echo $sql;
    if ($sql > 0)
        return true;
    return false;
}

function check_date() {
    $start = array('date' => time());
    $end = db_fetch_array("SELECT `reg_date` FROM `tbl_user` WHERE is_active= '0'");
    $total = $start + $end;
    return $total;
}
