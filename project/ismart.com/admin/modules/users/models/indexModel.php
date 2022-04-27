<?php

function update_password($data, $token)
{
    db_update('tbl_admin', $data, "`reset_token` = '{$token}'");
}

function check_email($email)
{
    $sql = db_num_rows("SELECT * FROM `tbl_admin` WHERE `email` = '{$email}'");
    if ($sql > 0)
        return true;
    return false;
}

function check_reset_token($reset_token)
{
    $sql = db_num_rows("SELECT * FROM `tbl_admin` WHERE `reset_token` = '{$reset_token}'");
    if ($sql > 0)
        return true;
    return false;
}

function check_reset_email($data, $email)
{
    db_update('tbl_admin', $data, "`email` = '{$email}'");
}

function users_exits($username, $email)
{
    $sql = db_num_rows("SELECT * FROM `tbl_admin` WHERE `username` = '{$username}' OR `email` = '{$email}'");
    if ($sql > 0)
        return true;
    return false;
}

function add_admin($data)
{
    return db_insert('tbl_admin', $data);
}

function get_user_by_id($id)
{
    $item = db_fetch_row("SELECT * FROM `tbl_admin` WHERE `user_id` = {$id}");
    return $item;
}

function get_user_by_username($username)
{
    $item = db_fetch_row("SELECT * FROM `tbl_admin` WHERE `username` = '{$username}' AND `is_active` = '1'");
    return $item;
}

function active_user($active_token)
{
    db_update('tbl_admin', array('is_active' => 1), "`active_token` = '{$active_token}'");
}

function check_active($active_token)
{
    $sql = db_num_rows("SELECT * FROM `tbl_admin` WHERE `active_token` = '{$active_token}' AND `is_active` = '0'");
    if ($sql > 0)
        return true;
    return false;
}

function check_date()
{
    $start = array('date' => time());
    $end = db_fetch_array("SELECT `reg_date` FROM `tbl_admin` WHERE is_active= '0'");
    $total = $start + $end;
    return $total;
}

function check_manage($manage)
{
    $username = $_SESSION['users_login'];
    $sql = db_num_rows("SELECT * FROM `tbl_admin` WHERE `username` = '{$username}' AND `manage` = '{$manage}'");
    if ($sql > 0)
        return true;
    return false;
}



function check_pass($password)
{
    $username = $_SESSION['users_login'];
    $sql = db_num_rows("select * from `tbl_admin` where `password` = '{$password}' AND `username` = '{$username}'");
    if ($sql > 0)
        return true;
    return false;
}


function update_pass($data, $pass_old)
{
    db_update('tbl_admin', $data, "`password` = '{$pass_old}'");
}

function check_username($username)
{
    $sql = db_num_rows("select * from `tbl_admin` where `username` = '{$username}'");
    if ($sql > 0)
        return true;
    return false;
}

function update_active_admin()
{
    db_update('tbl_admin', array('active' => 'Hoạt động'), "`username` = '{$_SESSION['users_login']}'");
}

function update_not_active_admin()
{
    db_update('tbl_admin', array('active' => 'Không hoạt động'), "`username` = '{$_SESSION['users_login']}'");
}

function get_admins($start, $num_pers_page, $where = '')
{
    if (!empty($where)) {
        $sql_where = "WHERE {$where}";
        $result = db_fetch_array("select * from `tbl_admin` $sql_where LIMIT {$start},{$num_pers_page}");
    } else {
        $result = db_fetch_array("select * from `tbl_admin` LIMIT {$start},{$num_pers_page}");
    }
    return $result;
}

function update_info_admin($data, $username)
{
    db_update('tbl_admin', $data, "`username` = '{$username}'");
}

function update_admin($data, $admin_id)
{
    db_update('tbl_admin', $data, "`id` = '{$admin_id}'");
}

//xóa admin trong db
function delete_admin($id)
{
    db_delete('tbl_admin', "`id` = '{$id}'");
}
