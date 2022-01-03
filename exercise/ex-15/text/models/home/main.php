<?php
get_header();
?>
<?php
$list_phone = get_product_by_cat_id(1);
$list_macbook = get_product_by_cat_id(2);
#=============================================
$phone = get_cat_id(1);
$macbook = get_cat_id(2);
?>
<div id="main-content-wp" class="home-page">
    <div class="wp-inner clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section list-cat">
                <div class="section-head">
                    <a class="section-title" href="<?php echo $phone['url'] ?>"><?php echo $phone['cat_title']; ?></a>
                </div>
                <div class="section-detail">
                    <?php if (!empty($list_phone)) {
                        ?>
                        <ul class="list-item clearfix">
                            <?php foreach ($list_phone as $item) { ?>
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
            <div class="section list-cat">
                <div class="section-head">
                    <a class="section-title" href="<?php echo $macbook['url'] ?>"><?php echo $macbook['cat_title']; ?></a>
                </div>
                <div class="section-detail">
                    <?php if (!empty($list_macbook)) {
                        ?>
                        <ul class="list-item clearfix">
                            <?php foreach ($list_macbook as $item) { ?>
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