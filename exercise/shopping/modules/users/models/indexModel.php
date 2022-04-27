<?php

function check_logins($username, $password) {
    $sql = db_num_rows("select * from `user` where `username` = '{$username}' AND `password` = '{$password}'");
    if ($sql > 0)
        return true;
    return false;
}

function users_exits($username, $email) {
    $sql = db_num_rows("select * from `user` where `username` = '{$username}' OR `email` = '{$email}'");
    if ($sql > 0) {
        return true;
    }
    return false;
}

function check_email($email) {
    $sql = db_num_rows("select * from `user` where `email` = '{$email}'");
    echo $sql;
    if ($sql > 0) {
        return true;
    }
    return false;
}

function add_users($data) {
    return db_insert('user', $data);
}

function check_active($active_token) {
    $sql = db_num_rows("select * from `user` where `token_active` = '{$active_token}' AND `is_active` = '0'");
    if ($sql > 0) {
        return true;
    }
    return false;
}

function active_users($active_token) {
    db_update('user', array('is_active' => 1), "`token_active` = '{$active_token}'");
}

function check_reset_email($data, $email) {
    db_update('user', $data, "`email` = '{$email}'");
}

function update_password($data, $reset_token) {
    db_update('user', $data, "`reset_token` = '{$reset_token}'");
}

function check_reset_token($reset_token) {
    $sql = db_num_rows("select * from `user` where `reset_token` = '{$reset_token}'");
    if ($sql > 0) {
        return true;
    }
    return false;
}
