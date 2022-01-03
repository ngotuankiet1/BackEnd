<?php
get_header();
//show_array($get_product);
?>
<div id="main-content-wp" class="category-product-page">
    <div class="wp-inner clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section list-cat">
                <div class="section-head">
                    <h3 class="section-title"><?php echo $product_cat['cat_title']; ?></h3>
                    <p class="section-desc">Có <?php echo count($get_product); ?> sản phẩm trong mục này</p>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php foreach ($get_product as $item){ ?>
                        <li>
                            <a href="<?php echo $item['url_product']; ?>" title="" class="thumb">
                                <?php echo $item['product-thump']; ?>
                            </a>
                            <a href="<?php echo $item['url_product'] ?>" title="" class="title"><?php echo $item['name_product']; ?></a>
                            <p class="price"><?php echo currency_format($item['price']); ?></p>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="pagenavi-wp">
                <div class="section-detail">
                    <ul id="list-pagenavi">
                        <li class="active">
                            <a href="" title="">1</a>
                        </li>
                        <li>
                            <a href="" title="">2</a>
                        </li>
                        <li>
                            <a href="" title="">3</a>
                        </li>
                    </ul>
                    <a href="" title="" class="next-page"><i class="fa fa-angle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>