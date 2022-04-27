<html>
    <head>
        <title>Hệ thống điều hướng cơ bản</title>
        <link href="public/css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/style-reg.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="wrapper-form-reg">
            <h1 class="page-title">XÁC NHẬN EMAIL</h1>
            <form id="form-reg" method="POST">
                <input type="email" name="email" id="email" placeholder="Email">
                <?php echo form_error("email"); ?>
                <input type="submit" id="btn-reg" name="btn_reset" value="GỬI YÊU CẦU">
                   <?php echo form_error("reset_email"); ?>
            </form>
            <a href="?mod=users&action=login">Đăng nhập</a>.<span>|</span>
            <a href="?mod=users&action=reg">Đăng kí</a>
        </div>
    </body>
</html>
