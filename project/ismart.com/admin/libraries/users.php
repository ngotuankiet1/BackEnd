<?php

function check_role($username)
{
    $sql = db_fetch_row("select * from `tbl_admin` where `username` = '{$username}'");
    return $sql['role'];
}

function get_admin_info($username)
{
    $sql = db_fetch_row("select * from `tbl_admin` where `username` = '{$username}'");
    return $sql['fullname'];
}


function info_admin($data, $id)
{
    $sql = db_fetch_row("select * from `tbl_admin` where `id` = '{$id}'");
    return $sql[$data];
}

function get_list_admins()
{
    $result = db_fetch_array("SELECT * FROM `tbl_admin`");
    return $result;
}

function info_user($field)
{
    $list_users = get_list_admins();
    if (isset($_SESSION['is_login'])) {
        foreach ($list_users as $user) {
            if ($_SESSION['users_login'] == $user['username']) {
                if (array_key_exists($field, $user))
                    return $user[$field];
            }
        }
    }
}
