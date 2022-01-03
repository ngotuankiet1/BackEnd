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
                <input type="text" name="username" id="username" value="<?php echo set_value("username") ?>"/><br>
                <?php echo form_error("username"); ?>
                <input type="password" name="password" id="password"/><br>
                <?php if (!empty($error['password'])) echo $error['password']; ?>
                <?php echo form_error("password"); ?>
                <input type="submit" id="btn-login" name="btn-login" value="Đăng nhập">
                <?php echo form_error("btn-login"); ?>
            </form>
            <a href="">Quên mật khẩu</a>
        </div>
    </body>
</html>
