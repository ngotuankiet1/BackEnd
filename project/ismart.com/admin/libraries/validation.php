<?php

//kiểm tra username
function is_username($username) {
    $parttern = "/^[A-Za-z0-9_\.]{6,32}$/";
    if (preg_match($parttern, $username))
        return true;
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

//images
function is_images($file_type, $file_size) {

    $type_allow = array('png', 'jpg', 'gif', 'jpeg');

    if (!in_array(strtolower($file_type), $type_allow)) {
        return false;
    } else {
        if ($file_size > 21000000) {
            return false;
        }
    }
    return true;
}

//check key
function is_exist($table, $key, $value)
{
    $sql = db_num_rows("select * from `{$table}` where `$key`= '$value'");
    if ($sql > 0) {
        return true;
    }
}

?>

