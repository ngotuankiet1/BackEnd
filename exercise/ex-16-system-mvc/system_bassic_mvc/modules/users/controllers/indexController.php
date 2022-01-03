<?php

function construct() {
    
}

function indexAction() {
    global $error;
    if (isset($_POST["btn-login"])) {
        $error = array();
        if (empty($_POST['username'])) {
            $error['username'] = 'Không được để trống username';
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = 'username không đúng định dang';
            } else {
                $username = $_POST['username'];
            }
        }
        if (empty($_POST['password'])) {
            $error['password'] = 'Không được để trống password';
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = 'password không đúng định dang';
            } else {
                $password = $_POST['password'];
            }
        }

        if (empty($error)) {
            if (check_login($username, $password)) {
                $_SESSION['is_login'] = true;
                $_SESSION['users_login'] = $username;
                redirect("?mod=home");
            } else {
                $error['btn-login'] = 'Tài khoản hoặc mật khẩu không chính xác';
            }
        }
    }
    load_view('login');
}

function logoutAction() {
    load_view('logout');
}

?>