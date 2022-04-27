<?php

function check_login($username, $password) {
    global $conn;
    $sql = "select * FROM `tbl_user` WHERE `username` = '" . mysqli_real_escape_string($conn, $username) . "' AND `password` = '" . mysqli_real_escape_string($conn, $password) . "'";
    if (db_num_rows($sql) > 0) {
        return true;
    } else {
        return false;
    }
}


function is_login() {
    if (isset($_SESSION['is_login'])) {
        return true;
    }
    return false;
}

