<?php
get_header();
//===========================================================================
#Số lượng bản ghi trên trang
$num_pers_page = 2;

#Tổng số bản ghi
$total_row = $num_product;

#Số trang
$num_pages = ceil($total_row / $num_pers_page);
//echo "Số trang:{$num_pages}" . "<br>";

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $num_pers_page;
//echo "trang: {$page}" . "<br>";

$list_product = get_users($start, $num_pers_page, "`cat_id` = '{$cat_id}'",$cat_id);
?>
<div id="main-content-wp" class="category-product-page">
    <div class="wp-inner clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section list-cat">
                <div class="section-head">
                    <h3 class="section-title"><?php echo $cat_product['cat_title']; ?></h3>
                    <p class="section-desc">Có tất cả <?php echo count($get_product); ?> sản phẩm</p>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php foreach ($list_product as $item) { ?>
                            <li>
                                <a href="<?php echo $item['url_product']; ?>" title="" class="thumb">
                                    <?php echo $item['product_thump']; ?>
                                </a>
                                <a href="<?php echo $item['url_product']; ?>" title="" class="title"><?php echo $item['name_product'] ?></a>
                                <p class="price"><?php echo currency_format($item['price']); ?></p>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="pagenavi-wp">
                <div class="section-detail">
                    <?php
                    echo get_pagging($num_pages, $page, "?mod=product&cat_id={$cat_id}");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>