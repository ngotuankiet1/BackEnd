<?php
$get_menu = db_fetch_array("select * from `tbl_menu` ORDER BY `menu_order` ASC");
$info_cart = get_product_cart();
$total = get_total_cart();
?>
<!DOCTYPE html>
<html>

<head>
    <title>ISMART STORE</title>
    <base href="<?php echo base_url(); ?>" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/responsive.css" rel="stylesheet" type="text/css" />

    <script src="public/js/jquery-3.5.0.min.js" type="text/javascript"></script>
    <script src="public/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/carousel/owl.carousel.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
    <script src="public/js/app.js" type="text/javascript"></script>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                        <div id="main-menu-wp" class="fl-right">
                            <?php if (!empty($get_menu)) { ?>
                                <ul id="main-menu" class="clearfix">
                                    <?php foreach ($get_menu as $menu) { ?>
                                        <li>
                                            <a href="<?php echo $menu['url_static']; ?>-<?php echo $menu['menu_order']; ?>.html" title=""><?php echo $menu['title'] ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } else { ?>
                                <p> danh mục menu rỗng </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="?" title="" id="logo" class="fl-left"><img src="public/images/logo.png" /></a>
                        <div id="search-wp" class="fl-left">
                            <form method="POST" action="tim-kiem.html">
                                <input type="text" name="value" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!" value="<?php echo set_value('value'); ?>">
                                <button type="submit" name="sm-s" id="sm-s">Tìm kiếm</button>
                            </form>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0987.654.321</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="?mod=cart" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num">2</span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num"><?php echo get_number_order_cart() ?> </span>
                                </div>
                                <div id="dropdown">
                                    <p class="desc">Có <span><?php echo get_number_order_cart() ?> sản phẩm</span> trong giỏ hàng</p>
                                    <?php if (!empty($info_cart)) { ?>
                                        <ul class="list-cart">
                                            <?php foreach ($info_cart as $item) { ?>
                                                <li class="clearfix">
                                                    <a href="chi-tiet/<?php echo $item['slug']; ?>-<?php echo $item['product_id']; ?>.html" title="" class="thumb fl-left">
                                                        <img src="admin/<?php echo $item['images']; ?>" alt="">
                                                    </a>
                                                    <div class="info fl-right">
                                                        <a href="chi-tiet/<?php echo $item['slug']; ?>-<?php echo $item['product_id']; ?>.html" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                                        <p class="price"><?php echo currency_format($item['price_new']); ?></p>
                                                        <p class="qty">Số lượng: <span><?php echo $item['qty']; ?></span></p>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                    <div class="total-price clearfix">
                                        <p class="title fl-left">Tổng:</p>
                                        <p class="price fl-right"><?php echo currency_format($total); ?></p>
                                    </div>
                                    <div class="action-cart clearfix">
                                        <a href="gio-hang.html" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                        <a href="?mod=cart&action=checkout" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>