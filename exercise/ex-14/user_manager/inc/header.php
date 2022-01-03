<html>
    <head>
        <title>Hệ thống điều hướng cơ bản</title>
        <link href="public/css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <a id="logo">UNITOP</a>
                <div id="user-login">
                    <p>Xin chào (<strong><?php echo get_info(user_login(), "fullname") ?></strong>)<a href="?page=logout"> Thoát</a></p>
                </div>
                <ul>
                    <li><a href="?page=home">Trang chủ</a></li>
                    <li><a href="?page=about">Giới thiệu</a></li>
                    <li><a href="?page=contact">Liên Lạc</a></li>
                    <li><a href="?page=news">Tin tức</a></li>
                    <li><a href="?page=product">Sản phẩm</a></li>
                </ul>
            </div>