<?php
get_header();
if (!empty($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $parent = get_info_product('parent_cat', $product_id);
    $lis_products_by_cat = get_product_by_parent_cat_unseted($parent, $product_id);
    $num_product = get_info_product('num_product',$product_id);
    $sold_product = get_info_product('sold_product',$product_id);
}
// show_array($num_product);
// echo $num_product.'-'.$sold_product;
?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb">
                            <img id="zoom" width="350px" height="280px" src="admin/<?php echo get_info_product('images', $product_id); ?>" data-zoom-image="admin/<?php echo get_info_product('images', $product_id); ?>" />
                        </a>
                        <!-- <div id="list-thumb">
                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                            </a>
                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                            </a>
                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                            </a>
                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                            </a>
                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                            </a>
                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                            </a>
                        </div> -->
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="public/images/img-pro-01.png" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name"><?php echo get_info_product('product_name', $product_id); ?></h3>
                        <div class="desc">
                            <?php echo get_info_product('product_desc', $product_id); ?>
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status"><?php if($sold_product >= $num_product){echo 'hết hàng';}else{echo 'còn hàng';}; ?></span>
                        </div>
                        <p class="price"><?php echo currency_format(get_info_product('price_new', $product_id)); ?></p>
                        <form method="POST"  id="num-order-wp" action="?mod=cart&action=add_cart&product_id=<?php echo get_info_product('product_id', $product_id); ?>">
                            <a title="" id="minus"><i class="fa fa-minus"></i></a>
                            <input type="text" name="num_order" value="1" id="num-order">
                            <a title="" id="plus"><i class="fa fa-plus"></i></a><hr>
                            <button type="submit" value="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <?php echo get_info_product('product_content', $product_id); ?>
                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <?php if (!empty($lis_products_by_cat)) { ?>
                        <ul class="list-item">
                            <?php foreach ($lis_products_by_cat as $product){ ?>
                            <li>
                                <a href="chi-tiet/<?php echo $product['slug']; ?>-<?php echo $product['product_id']; ?>.html" title="" class="thumb">
                                    <img src="admin/<?php if (!empty($product['images'])) {
                                                        echo $product['images'];
                                                    } else {
                                                        echo "public/images/files/product/img-thumb";
                                                    } ?>">
                                </a>
                                <a href="chi-tiet/<?php echo $product['slug']; ?>-<?php echo $product['product_id']; ?>.html" title="" class="product-name"><?php echo $product['product_name'] ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($product['price_new']) ?></span>
                                    <span class="old"><?php echo currency_format($product['price_old']) ?></span>
                                </div>
                                <div class="action clearfix">
                                    <a href="gio-hang-<?php echo $product['product_id']; ?>-c.html" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="dat-hang-<?php echo $product['product_id']; ?>-b.html" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>