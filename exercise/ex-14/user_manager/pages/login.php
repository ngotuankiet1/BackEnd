<?php
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
        if (!is_username($_POST['username'])) {
            $error['password'] = 'password không đúng định dang';
        } else {
            $password = md5($_POST['password']);
        }
    }

    if (empty($error)) {
        if (check_login($username, $password)) {
            if (isset($_POST['remember_me'])) {
                setcookie("login", base64_encode(true), time() + 3000);
                setcookie("users_login", $username, time() + 3000);
            }
            $_SESSION['is_login'] = true;
            $_SESSION['users_login'] = $username;
            redirect("?page=home");
        } else {
            $error['login'] = 'Tài khoản hoặc mật khẩu không chính xác';
        }
    }
}
?>
<html>
    <head>
        <title>Hệ thống điều hướng cơ bản</title>
        <link href="public/css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/style-login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="wrapper-form-login">
            <h1 class="page-title">ĐĂNG NHẬP</h1>
            <form id="form-login" method="POST">
                <input type="text" name="username" id="username" value="<?php echo set_value("username") ?>"><br>
                <?php echo form_error("username") ?>
                <input type="password" name="password" id="password"><br>
                <?php echo form_error("password") ?>
                <input type="submit" id="btn-login" name="btn-login" value="Đăng nhập">
                <?php echo form_error("login") ?>
                <input type="checkbox" id="remember_me" name="remember_me">
                <label id="remember" for="remember_me">Ghi nhớ đăng nhập</label>
            </form>
            <a href="">Quên mật khẩu</a>
        </div>
    </body>
</html>
