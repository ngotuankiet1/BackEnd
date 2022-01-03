<?php get_header(); ?>
<?php
$cat_id = $_GET['cat_id'];
//============================
#Láy tiêu đề trang sản phẩm
$product_cat = get_cat_id($cat_id);
//============================
#Láy danh sách sản phẩm
$list_item = get_product_by_cat_id($cat_id);
//show_array($list_item);
?>
<div id="main-content-wp" class="category-product-page">
    <div class="wp-inner clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section list-cat">
                <div class="section-head">
                    <h3 class="section-title"><?php echo $product_cat['cat_title'] ?></h3>
                    <p class="section-desc">Có <?php echo count($list_item); ?> sản phẩm trong mục này</p>
                </div>
                <div class="section-detail">
                    <?php if (!empty($list_item)) {
                        ?>
                        <ul class="list-item clearfix">
                            <?php foreach ($list_item as $item) { ?>
                                <li>
                                    <a href="<?php echo $item['url'] ?>" title="" class="thumb">
                                        <?php echo $item['product-thump']; ?>
                                    </a>
                                    <a href="<?php echo $item['url'] ?>" title="" class="title"><?php echo $item['name_product']; ?></a>
                                    <p class="price"><?php echo arrency_format($item['price']); ?></p>
                                </li>  
                            <?php } ?>                  
                        </ul>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>

