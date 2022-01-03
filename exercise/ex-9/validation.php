<?php

function is_fullname($fullname) {
    $partten = "/^[\w\s\d_\.]{6,32}$/";
    if (preg_match($partten, $fullname))
        return true;
    return false;
}

function is_username($username) {
    $partten = "/^[\w\d_\.]{6,32}$/";
    if (preg_match($partten, $username))
        return true;
    return false;
}

//kiểm tra password
function is_password($password) {
    $parttern = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
    if (preg_match($parttern, $password))
        return true;
}

#3.Hàm is_email()

function is_email($password) {
    $parttern = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
    if (preg_match($parttern, $password))
        return true;
}

//xuất lỗi
function form_error($label_field) {
    global $error;
    if (!empty($error[$label_field])) {
        return "<p style='color: red;'>{$error[$label_field]}</p>";
    }
}

//kiểm tra giá trị
function set_value($label_field) {
    global $$label_field;
    if (!empty($$label_field))
        return $$label_field;
}

function is_number($number) {
    $parten = "/^(08|09|01[2|6|8|9])+([0-9]{8})$/";
    if (preg_match($parten, $number))
        return true;
    return false;
}
?>


