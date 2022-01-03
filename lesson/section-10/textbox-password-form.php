<?php
if (isset($_POST['btn-login'])) {
    if (empty($_POST['usename'])) {
        echo 'không được để trống tên đăng nhập';
    } else {
        $usename = $_POST['usename'];
        echo "$usename-";
    }
    if (empty($_POST['password'])) {
        echo '-không được để trống mật khẩu';
    } else {
        $password = $_POST['password'];
        echo "$password";
    }
}
?>

<html>
    <body>
        <form action="" method="post">
            usename:<input type="text" name="usename"/><br>
            password:<input type="password" name="password"/><br>
            <input type="submit" name="btn-login" value="Login"/>
        </form>
    </body>
</html>

