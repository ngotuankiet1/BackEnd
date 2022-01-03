<?php
if (isset($_POST["btn_login"])) {
    $info = array(
        'username' => 'admin',
        'password' => 'admin',
    );
    $error = array();
    if (empty($_POST['username'])) {
        $error['username'] = 'vui long nhap usrname';
    } else {
        $username = $_POST['username'];
    }

    if (empty($_POST['password'])) {
        $error['password'] = 'vui long nhap password';
    } else {
        $password = $_POST['password'];
    }

    if (empty($error)) {
        if ($username == $info['username'] && $password == $info['password']) {
            $redirect = $_POST['redirect_to'];
            header("Location: {$redirect}");
        } else {
            $error['login'] = "tai khoan hoac mat khau khong chinh xac";
        }
    }

    if (!empty($error)) {
        echo '<pre>';
        print_r($error);
        echo '</pre>';
    }
}
?>

<html>
    <head>
        <title>tieu de</title>
    </head>
    <body>
        <form action="" method="POST">
            Username:<input type="text" name="username"/> <br><br>
            Password:<input type="password" name="password"/>
            <input type="hidden" name="redirect_to" value="cart.php"/>
            <input type="submit" name="btn_login" value="Login">
        </form>
    </body>
</html>