<html>
    <head>
        <title>Hệ thống điều hướng cơ bản</title>
        <link href="public/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/style-login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="wrapper-form-login">
            <h1 class="page-title">ĐĂNG NHẬP</h1>
            <form id="form-login" method="POST">
                <input type="text" name="username" id="username" value="<?php echo set_value("username") ?>" placeholder="Username"><br>
                <?php echo form_error("username") ?>
                <input type="password" name="password" id="password" placeholder="Password"><br>
                <?php echo form_error("password") ?>
                <input type="submit" id="btn-login" name="btn-login" value="Đăng nhập">
                <?php echo form_error("login") ?>
            </form>
            <a href="?mod=users&action=resetpass">Quên mật khẩu</a>
            <a class="reg" href="?mod=users&action=reg">Đăng ký</a>
        </div>
    </body>
</html>
