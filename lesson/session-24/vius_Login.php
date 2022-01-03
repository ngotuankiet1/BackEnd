<?php
require 'data/connect.php';

if (isset($_POST['btn_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "select * FROM `tbl_user` WHERE `username` = '" . mysqli_real_escape_string($conn, $username) . "' AND `password` = '" .  mysqli_real_escape_string($conn, $password) . "'";
//    $sql = "select * FROM `tbl_user` WHERE `username` = '' OR '' = '' AND `password` = '' OR '' = ''";
    $result = mysqli_query($conn, $sql);
    echo $sql;
    if (mysqli_num_rows($result) > 0) {
        echo 'Login Thành Công';
    } else {
        echo 'Login Thất Bại';
    }
}
?>
<html>
    <head>
        <title>CHỐNG MÃ LỆNH ĐỌC ĐĂNG NHẬP</title>
    </head>
    <body>
        <form method="POST">
            <h3>ĐĂNG NHẬP</h3>
            Username: <input type="text" name="username" value=""/><br><br>
            Password: <input type="password" name="password" value=""/><br><br>
            <input type="submit" name="btn_login" value="Login" />
        </form>
    </body>
</html>