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
                    <p>Xin chào (<strong><?php echo get_info(user_login(), "fullname") ?></strong>)<a href="?mod=users&action=logout"> Thoát</a></p>
                </div>
                <ul>
                    <li><a href="?">Trang chủ</a></li>
                    <li><a href="?mod=page&action=about">Giới thiệu</a></li>
                    <li><a href="?mod=page&action=contach">Liên Lạc</a></li>
                    <li><a href="?mod=post&action=index">Tin tức</a></li>
                    <li><a href="?mod=product&action=index">Sản phẩm</a></li>
                </ul>
            </div>