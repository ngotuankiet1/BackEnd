<?php
get_header();
$list_product = db_fetch_array("select * from `tbl_product` order by `product_id` desc");
$list_product_pro = get_lis_product_pro($list_product);
?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <div class="item">
                        <img src="public/images/slider-01.png" alt="">
                    </div>
                    <div class="item">
                        <img src="public/images/slider-02.png" alt="">
                    </div>
                    <div class="item">
                        <img src="public/images/slider-03.png" alt="">
                    </div>
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php foreach ($list_product_pro as $product_pro) { ?>
                            <li>
                                <a href="chi-tiet/<?php echo $product_pro['slug']; ?>-<?php echo $product_pro['product_id']; ?>.html" title="" class="thumb">
                                    <img src="admin/<?php if (!empty($product_pro['images'])) {
                                                        echo $product_pro['images'];
                                                    } else {
                                                        echo "public/images/files/product/img-thumb";
                                                    } ?>">
                                </a>
                                <a href="chi-tiet/<?php echo $product_pro['slug']; ?>-<?php echo $product_pro['product_id']; ?>.html" title="" class="product-name"><?php echo $product_pro['product_name'] ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($product_pro['price_new']) ?></span>
                                    <span class="old"><?php echo currency_format($product_pro['price_old']) ?></span>
                                </div>
                                <div class="action clearfix">
                                    <a href="gio-hang-<?php echo $product_pro['product_id']; ?>-c.html" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="dat-hang-<?php echo $product_pro['product_id']; ?>-b.html" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Điện thoại</h3>
                </div>
                <div class="section-detail">
                    <?php $get_list_tell = get_product_by_parent("Điện thoại");
                    if (!empty($get_list_tell)) { ?>
                        <ul class="list-item clearfix">
                            <?php foreach ($get_list_tell as $phone) { ?>
                                <li>
                                    <a href="chi-tiet/<?php echo $phone['slug']; ?>-<?php echo $phone['product_id']; ?>.html" title="" class="thumb">
                                        <img src="admin/<?php if (!empty($phone['images'])) {
                                                            echo $phone['images'];
                                                        } else {
                                                            echo "public/images/files/product/img-thumb";
                                                        } ?>">
                                    </a>
                                    <a href="chi-tiet/<?php echo $phone['slug']; ?>-<?php echo $phone['product_id']; ?>.html" title="" class="product-name"><?php echo $phone['product_name'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($phone['price_new']) ?></span>
                                        <span class="old"><?php echo currency_format($phone['price_old']) ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="gio-hang-<?php echo $phone['product_id']; ?>-c.html" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="dat-hang-<?php echo $phone['product_id']; ?>-b.html" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <p>Không có sản phẩm</p>
                    <?php } ?>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Laptop</h3>
                </div>
                <div class="section-detail">
                    <?php $get_list_laptop = get_product_by_parent("Laptop");
                    if (!empty($get_list_laptop)) { ?>
                        <ul class="list-item clearfix">
                            <?php foreach ($get_list_laptop as $laptop) { ?>
                                <li>
                                    <a href="chi-tiet/<?php echo $laptop['slug']; ?>-<?php echo $laptop['product_id']; ?>.html" title="" class="thumb">
                                        <img src="admin/<?php if (!empty($laptop['images'])) {
                                                            echo $laptop['images'];
                                                        } else {
                                                            echo "public/images/files/product/img-thumb";
                                                        } ?>">
                                    </a>
                                    <a href="chi-tiet/<?php echo $laptop['slug']; ?>-<?php echo $laptop['product_id']; ?>.html" title="" class="product-name"><?php echo $laptop['product_name'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($laptop['price_new']) ?></span>
                                        <span class="old"><?php echo currency_format($laptop['price_old']) ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="gio-hang-<?php echo $laptop['product_id']; ?>-c.html" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="dat-hang-<?php echo $laptop['product_id']; ?>-b.html" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <p>Không có sản phẩm</p>
                    <?php } ?>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Máy tính bảng</h3>
                </div>
                <div class="section-detail">
                    <?php $get_list_ipad = get_product_by_parent(" Máy tính bảng");
                    if (!empty($get_list_ipad)) { ?>
                        <ul class="list-item clearfix">
                            <?php foreach ($get_list_ipad as $ipad) { ?>
                                <li>
                                    <a href="chi-tiet/<?php echo $ipad['slug']; ?>-<?php echo $ipad['product_id']; ?>.html" title="" class="thumb">
                                        <img src="admin/<?php if (!empty($ipad['images'])) {
                                                            echo $ipad['images'];
                                                        } else {
                                                            echo "public/images/files/product/img-thumb";
                                                        } ?>">
                                    </a>
                                    <a href="chi-tiet/<?php echo $ipad['slug']; ?>-<?php echo $ipad['product_id']; ?>.html" title="" class="product-name"><?php echo $ipad['product_name'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($ipad['price_new']) ?></span>
                                        <span class="old"><?php echo currency_format($ipad['price_old']) ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="gio-hang-<?php echo $ipad['product_id']; ?>-c.html" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="dat-hang-<?php echo $ipad['product_id']; ?>-b.html" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <p>Không có sản phẩm</p>
                    <?php } ?>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Tai nghe</h3>
                </div>
                <div class="section-detail">
                    <?php $get_list_headphone = get_product_by_parent("Tai nghe");
                    if (!empty($get_list_headphone)) { ?>
                        <ul class="list-item clearfix">
                            <?php foreach ($get_list_headphone as $headphone) { ?>
                                <li>
                                    <a href="chi-tiet/<?php echo $headphone['slug']; ?>-<?php echo $headphone['product_id']; ?>.html" title="" class="thumb">
                                        <img src="admin/<?php if (!empty($headphone['images'])) {
                                                            echo $headphone['images'];
                                                        } else {
                                                            echo "public/images/files/product/img-thumb";
                                                        } ?>">
                                    </a>
                                    <a href="chi-tiet/<?php echo $headphone['slug']; ?>-<?php echo $headphone['product_id']; ?>.html" title="" class="product-name"><?php echo $headphone['product_name'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($headphone['price_new']) ?></span>
                                        <span class="old"><?php echo currency_format($headphone['price_old']) ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="gio-hang-<?php echo $headphone['product_id']; ?>-c.html" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="dat-hang-<?php echo $headphone['product_id']; ?>-b.html" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <p>Không có sản phẩm</p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>