<html>
    <head>
        <title>Hệ thống điều hướng cơ bản</title>
        <link href="public/css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/import/style-reg.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="wrapper-form-reg">
            <h1 class="page-title">MẬT KHẨU MỚI</h1>
            <form id="form-reg" method="POST">
                <input type="password" name="password" id="password"  placeholder="Password"><br>
                <?php echo form_error("password") ?>
                <input type="submit" id="btn-reg" name="btn_changle" value="LƯU">
                <?php echo form_error("btn_changle"); ?>
            </form>
            <a href="?mod=users&action=login">Đăng nhập</a>.<span>|</span>
            <a href="?mod=users&action=reg">Đăng kí</a>
        </div>
    </body>
</html>
