<html>
    <head>
        <title>Hệ thống điều hướng cơ bản</title>
        <link href="public/css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/style-reg.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="wrapper-form-reg">
            <h1 class="page-title">ĐĂNG KÝ</h1>
            <form id="form-reg" method="POST">
                <input type="text" name="fullname" id="fullname" value="<?php echo set_value("fullname") ?>" placeholder="Fullname"><br>
                <?php echo form_error("fullname") ?>
                <input type="email" name="email" id="email" value="<?php echo set_value("email") ?>"  placeholder="Email"><br>
                <?php echo form_error("email") ?>
                <input type="username" name="username" id="username" value="<?php echo set_value("username") ?>"  placeholder="Username"><br>
                <?php echo form_error("username") ?>
                <input type="password" name="password" id="password"  placeholder="Password"><br>
                <?php echo form_error("password") ?>
                <input type="submit" id="btn-reg" name="btn-reg" value="Đăng ký">
                <?php echo form_error("btn-reg") ?>
            </form>
            <a href="?mod=users&action=login">Đăng nhập</a>
        </div>
    </body>
</html>
