<?php

function check_login($username, $password) {
    global $list_user;
    foreach ($list_user as $users) {
        if ($username == $users['username'] && md5($password) == md5($users['password'])) {
            return true;
        }
    }
    return false;
}

function is_login() {
    if (isset($_SESSION['is_login'])) {
        return true;
    }
    return false;
}

function user_login() {
    if (isset($_SESSION['users_login'])) {
        return $_SESSION['users_login'];
    }
    return false;
}

function get_info($username, $filed) {
    global $list_user;
    if (isset($_SESSION['is_login'])) {
        foreach ($list_user as $user){
            if ($username == $user['username']) {
                if (array_key_exists($filed, $user)) {
                    return $user[$filed];
                }
            }
        }
        return false;
    }
}

?>
